<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ContactsImport;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        $contacts = Contact::latest()->paginate(10);
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
            $receipts = [];
            //if contacts
            if ($request->has("to_contacts")) {
                $contacts = Contact::get()->unique("phone");
                foreach ($contacts as $contact) {
                    $receipts[] = [
                        "name" => $contact->name,
                        "email" => $contact->email,
                        "phone" => $contact->phone,
                    ];
                }
            }

            if ($request->has("to_registered_users")) {
                $users = User::get()->unique("mobile");
                foreach ($users as $user) {
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
                    $receipts[$order->email] = [
                        "name" => $order->name,
                        "email" => $order->email,
                        "phone" => $order->mobile,
                    ];
                }
            }

            $responses = [];
            foreach ($receipts as $phone=>$receipt) {
                $text = Str::replace("{{name}}", $receipt["name"], $message);
                $responses[$phone] = Http::withToken('EAAC5X0tCE2ABAKswdx8gCP7vtCxIfiqGfT200u0dtoH0skWrMQtiMN9ZAxiAEcnZCUoGDLgapLTEIB1y4e8xoOtaG0297ttarXyhdqy7KjYZAUvdtZCRVhJxwpWTUq6hUpV7vMZACNHjxJXkDJ125iawzRcxbzFRlMrSGCGFAMO5r69SClrhiTeW2uBjarjvA3ISKTsHwLfRYRC1pxZBn8XgNKEjAJeaUZD')
                    ->post('https://graph.facebook.com/v15.0/110821481827920/messages',  [
                        "messaging_product" => "whatsapp",
                        "to" => "91".$receipt["phone"],
                        "recipient_type" => "individual",
                        "type" => "text",
                        "text" => [
                            "preview_url" => true,
                            "body" => $text
                        ]
                        // "type" => "template",
                        // "template" => [
                        //     "name" => "hello_world", "language" => ["code" => "en_US"]
                        // ]
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
}
