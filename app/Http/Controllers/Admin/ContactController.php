<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ContactsImport;
use App\Models\Contact;
use App\Models\MailSchedule;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Contact::create(array_merge($request->only(
            "name",
            "country",
            "phone",
            "email",
            "address",
            "is_newsletter_active"
        )));

        return redirect()->route('contact.index')
            ->withSuccess(__('Contact created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
        return view('admin.contact.edit', [
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
        $contact->update($request->only(
            "name",
            "country",
            "phone",
            "email",
            "address",
            "is_newsletter_active"
        ));

        return redirect()->route('contact.index')
            ->withSuccess(__('Contact updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
        $contact->delete();

        return redirect()->route('contact.index')
            ->withSuccess(__('Contact deleted successfully.'));
    }

    public function import(Request $request)
    {
        try {
            \Maatwebsite\Excel\Facades\Excel::import(new ContactsImport, request()->file('file'));
            return response()->json([
                "status" => 200,
                'message' => 'Successfully imported file',
            ]);
        } catch (Exception $err) {
            return response()->json([
                "status" => 400,
                'message' => 'Please upload correct file',
                'exception' => $err->getMessage()
            ], 400);
        }
    }

    public function whatsappCampaign(Request $request)
    {
        try {
            $message = $request->message;
            $receipt = $request->receipt;
            $receipts = [];
            if (!$receipt || $receipt == "") {
                //if contacts
                if ($request->has("to_contacts")) {
                    $contacts = Contact::get()->unique("phone");
                    foreach ($contacts as $contact) {
                        if ($contact->phone == null || $contact->phone == "") continue;
                        $receipts[$contact->phone] = [
                            "name" => $contact->name,
                            "email" => $contact->email,
                            "phone" => $contact->phone,
                        ];
                    }
                }

                if ($request->has("to_registered_users")) {
                    $users = User::get()->unique("mobile");
                    foreach ($users as $user) {
                        if ($user->mobile == null || $user->mobile == "") continue;
                        $receipts[$user->mobile] = [
                            "name" => $user->name,
                            "email" => $user->email,
                            "phone" => $user->mobile,
                        ];
                    }
                }

                //to_ordered_users
                if ($request->has("to_ordered_users")) {
                    $orders = Order::get()->unique("mobile");
                    foreach ($orders as $order) {
                        if ($order->mobile == null || $order->mobile == "") continue;
                        $receipts[$order->mobile] = [
                            "name" => $order->name,
                            "email" => $order->email,
                            "phone" => $order->mobile,
                        ];
                    }
                }
            } else {
                $receipts[$receipt] = [
                    "phone" => $receipt,
                    "name" => "",
                    "email" => ""
                ];
            }
            $responses = [];
            foreach ($receipts as $phone => $receipt) {
                $text = Str::replace("{{name}}", $receipt["name"], $message);
                $text = Str::replace("{{email}}", $receipt["email"], $text);
                $responses[$phone] = Http::withToken(env('WHATSAPP_ACCESS_TOKEN'))
                    ->post('https://graph.facebook.com/v15.0/' . env('WHATSAPP_PHONE_NUMBER_ID') . '/messages',  [
                        "messaging_product" => "whatsapp",
                        "to" => "91" . $receipt["phone"],
                        "recipient_type" => "individual",
                        // "type" => "text",
                        // "text" => [
                        //     "preview_url" => true,
                        //     "body" => $text
                        // ]
                        "type" => "template",
                        "template" => [
                            "name" => "colorland_1_0_earlybird",
                            "language" => ["code" => "en"],
                            "components" => [
                                [
                                    "type" => "header",
                                    "parameters" => [
                                        [
                                            "type" => "image",
                                            "image" => [
                                                "link" => "https://www.eksafar.club/images/banner/popup-landscape.jpg",
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ])->json();
                break;
            }

            return response()->json([
                "status" => 200,
                'message' => 'Successfully sent message file',
                "content" => $message,
                "responses" => $responses
            ]);
        } catch (Exception $err) {
            return response()->json([
                "status" => 400,
                'message' => 'Please upload correct file',
                'exception' => $err->getMessage()
            ], 400);
        }
    }

    public function emailCampaign(Request $request)
    {
        try {
            $message = $request->message;
            $subject = $request->subject;
            $receipt = $request->receipt;
            $receipts = [];
            if (!$receipt || $receipt == "") {
                //if contacts
                if ($request->has("to_contacts")) {
                    $contacts = Contact::get()->unique("phone");
                    foreach ($contacts as $contact) {
                        if ($contact->email == null || $contact->email == "") continue;
                        $receipts[$contact->email] = [
                            "name" => $contact->name,
                            "email" => $contact->email,
                            "phone" => $contact->phone,
                        ];
                    }
                }

                if ($request->has("to_registered_users")) {
                    $users = User::get()->unique("mobile");
                    foreach ($users as $user) {
                        if ($user->email == null || $user->email == "") continue;
                        $receipts[$user->email] = [
                            "name" => $user->name,
                            "email" => $user->email,
                            "phone" => $user->mobile,
                        ];
                    }
                }

                //to_ordered_users
                if ($request->has("to_ordered_users")) {
                    $orders = Order::get()->unique("mobile");
                    foreach ($orders as $order) {
                        if ($order->email == null || $order->email == "") continue;
                        $receipts[$order->email] = [
                            "name" => $order->name,
                            "email" => $order->email,
                            "phone" => $order->mobile,
                        ];
                    }
                }
            } else {
                $receipts[$receipt] = [
                    "phone" => "",
                    "name" => "",
                    "email" => $receipt
                ];
            }
            foreach ($receipts as $receipt) {
                $mailSchedule = new MailSchedule();
                $mailSchedule->name = $receipt["name"] ?? "";
                $mailSchedule->to = $receipt["email"];
                $mailSchedule->subject = $subject;
                $mailSchedule->html = $message;
                $mailSchedule->text = "";
                $mailSchedule->status = "CREATED";
                $mailSchedule->priority = 0;
                $mailSchedule->send_at = Carbon::now();
                $mailSchedule->save();
            }
            return response()->json([
                "status" => 200,
                'message' => 'Successfully added to schedular',
            ]);
        } catch (Exception $err) {
            return response()->json([
                "status" => 400,
                'message' => 'Please upload correct file',
                'exception' => $err->getMessage()
            ], 400);
        }
    }
}
