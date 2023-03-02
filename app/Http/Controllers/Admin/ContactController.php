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
            ///re

            //$receipts = json_decode('[{"name":"","email":"","phone":"8171109195"},{"name":"","email":"","phone":"8754140041"},{"name":"","email":"","phone":"9844880119"},{"name":"","email":"","phone":"9624035074"},{"name":"","email":"","phone":"7541077333"},{"name":"","email":"","phone":"7406206582"},{"name":"","email":"","phone":"9629815729"},{"name":"","email":"","phone":"7892960297"},{"name":"","email":"","phone":"8861972098"},{"name":"","email":"","phone":"6304356725"},{"name":"","email":"","phone":"7032760048"},{"name":"","email":"","phone":"6268772720"},{"name":"","email":"","phone":"9148158728"},{"name":"","email":"","phone":"9061998236"},{"name":"","email":"","phone":"8050074098"},{"name":"","email":"","phone":"7899202796"},{"name":"","email":"","phone":"8050149240"},{"name":"","email":"","phone":"7994008112"},{"name":"","email":"","phone":"9582243471"},{"name":"","email":"","phone":"8478911266"},{"name":"","email":"","phone":"7979786323"},{"name":"","email":"","phone":"8951250754"},{"name":"","email":"","phone":"95130 69600"},{"name":"","email":"","phone":"77022 33692"},{"name":"","email":"","phone":"9535780405"},{"name":"","email":"","phone":"9749068787"},{"name":"","email":"","phone":"9703090439"},{"name":"","email":"","phone":"9123881186"},{"name":"","email":"","phone":"8431255907"},{"name":"","email":"","phone":"9742548835"},{"name":"","email":"","phone":"9148258728"},{"name":"","email":"","phone":"987654321"},{"name":"","email":"","phone":"8861941717"},{"name":"","email":"","phone":"9097971854"},{"name":"","email":"","phone":"88399 43835"},{"name":"","email":"","phone":"78926 45648"},{"name":"","email":"","phone":"920000000000"},{"name":"","email":"","phone":"8147883574"},{"name":"","email":"","phone":"8861495156"},{"name":"","email":"","phone":"9884202053"},{"name":"","email":"","phone":"9033987576"},{"name":"","email":"","phone":"95131 82459"},{"name":"","email":"","phone":"7974862710"},{"name":"","email":"","phone":"8317349289"},{"name":"","email":"","phone":"7902707107"},{"name":"","email":"","phone":"9745597239"},{"name":"","email":"","phone":"8660591552"},{"name":"","email":"","phone":"8310360153"},{"name":"","email":"","phone":"9746611487"},{"name":"","email":"","phone":"6364855281"},{"name":"","email":"","phone":"8971507000"},{"name":"","email":"","phone":"7002755389"},{"name":"","email":"","phone":"9904969444"},{"name":"","email":"","phone":"9886899399"},{"name":"","email":"","phone":"8590572767"},{"name":"","email":"","phone":"78922902548"},{"name":"","email":"","phone":"9591288833"},{"name":"","email":"","phone":"9845298490"},{"name":"","email":"","phone":"7736682699"},{"name":"","email":"","phone":"9243251888"},{"name":"","email":"","phone":"9845097614"},{"name":"","email":"","phone":"9600092716"},{"name":"","email":"","phone":"7501345944"},{"name":"","email":"","phone":"7018279308"},{"name":"","email":"","phone":"9074738070"},{"name":"","email":"","phone":"9632807762"},{"name":"","email":"","phone":"7829909918"},{"name":"","email":"","phone":"8718826833"},{"name":"","email":"","phone":"9772349194"},{"name":"","email":"","phone":"8123506659"},{"name":"","email":"","phone":"7218748808"},{"name":"","email":"","phone":"7559887945"},{"name":"","email":"","phone":"7907754245"},{"name":"","email":"","phone":"8660192058"},{"name":"","email":"","phone":"9808374407"},{"name":"","email":"","phone":"9711081040"},{"name":"","email":"","phone":"7838790992"},{"name":"","email":"","phone":"7899030167"},{"name":"","email":"","phone":"6361336552"},{"name":"","email":"","phone":"9066225294"},{"name":"","email":"","phone":"9810512717"},{"name":"","email":"","phone":"7204076412"},{"name":"","email":"","phone":"9832168880"},{"name":"","email":"","phone":"7008939329"},{"name":"","email":"","phone":"7903475946"},{"name":"","email":"","phone":"7205387887"},{"name":"","email":"","phone":"8116477811"},{"name":"","email":"","phone":"9032024692"},{"name":"","email":"","phone":"9741500482"},{"name":"","email":"","phone":"8780441061"},{"name":"","email":"","phone":"8310719823"},{"name":"","email":"","phone":"8884991551"},{"name":"","email":"","phone":"9431454523"},{"name":"","email":"","phone":"9919335522"},{"name":"","email":"","phone":"9894352525"},{"name":"","email":"","phone":"7019495582"},{"name":"","email":"","phone":"7998523735"},{"name":"","email":"","phone":"9740634781"},{"name":"","email":"","phone":"8951688665"},{"name":"","email":"","phone":"9986418886"},{"name":"","email":"","phone":"7259457296"},{"name":"","email":"","phone":"9591960517"},{"name":"","email":"","phone":"8797907101"},{"name":"","email":"","phone":"9632033556"},{"name":"","email":"","phone":"9019657512"},{"name":"","email":"","phone":"7259520390"},{"name":"","email":"","phone":"9650670344"},{"name":"","email":"","phone":"9886903882"},{"name":"","email":"","phone":"9986721186"},{"name":"","email":"","phone":"9849361171"},{"name":"","email":"","phone":"7338644411"},{"name":"","email":"","phone":"8179464951"},{"name":"","email":"","phone":"9903361711"},{"name":"","email":"","phone":"7411477553"},{"name":"","email":"","phone":"9940091556"},{"name":"","email":"","phone":"7022251706"},{"name":"","email":"","phone":"9845380140"},{"name":"","email":"","phone":"9741322005"},{"name":"","email":"","phone":"9972246765"},{"name":"","email":"","phone":"8917663227"},{"name":"","email":"","phone":"8056033024"},{"name":"","email":"","phone":"9633276923"},{"name":"","email":"","phone":"8989776337"},{"name":"","email":"","phone":"8971540279"},{"name":"","email":"","phone":"9164073950"},{"name":"","email":"","phone":"9538752895"},{"name":"","email":"","phone":"7895721761"},{"name":"","email":"","phone":"9632391010"},{"name":"","email":"","phone":"8197242843"},{"name":"","email":"","phone":"9353449739"},{"name":"","email":"","phone":"7902778868"},{"name":"","email":"","phone":"7411590449"},{"name":"","email":"","phone":"8800480060"},{"name":"","email":"","phone":"8793175880"},{"name":"","email":"","phone":"9453038099"},{"name":"","email":"","phone":"8147705097"},{"name":"","email":"","phone":"9717685078"},{"name":"","email":"","phone":"9110618426"},{"name":"","email":"","phone":"7892166538"},{"name":"","email":"","phone":"7888047776"},{"name":"","email":"","phone":"7726837423"},{"name":"","email":"","phone":"9660367726"},{"name":"","email":"","phone":"9518327077"},{"name":"","email":"","phone":"7019599347"},{"name":"","email":"","phone":"8310714667"},{"name":"","email":"","phone":"9487239368"},{"name":"","email":"","phone":"9643966103"},{"name":"","email":"","phone":"8904333731"},{"name":"","email":"","phone":"9619620830"},{"name":"","email":"","phone":"9930101966"},{"name":"","email":"","phone":"9886822776"},{"name":"","email":"","phone":"8258807361"},{"name":"","email":"","phone":"8259047527"},{"name":"","email":"","phone":"8120672276"},{"name":"","email":"","phone":"7278210669"},{"name":"","email":"","phone":"8895836350"},{"name":"","email":"","phone":"9088981529"},{"name":"","email":"","phone":"9729277080"},{"name":"","email":"","phone":"8800184466"},{"name":"","email":"","phone":"8296604002"},{"name":"","email":"","phone":"7259498903"},{"name":"","email":"","phone":"7660083489"},{"name":"","email":"","phone":"9207584109"},{"name":"","email":"","phone":"9731349947"},{"name":"","email":"","phone":"9629026911"},{"name":"","email":"","phone":"7022159329"},{"name":"","email":"","phone":"9899993681"},{"name":"","email":"","phone":"9113082439"},{"name":"","email":"","phone":"9740855163"},{"name":"","email":"","phone":"9742753948"},{"name":"","email":"","phone":"9616162854"},{"name":"","email":"","phone":"9106836824"},{"name":"","email":"","phone":"7760457556"},{"name":"","email":"","phone":"8848767525"},{"name":"","email":"","phone":"9148720527"},{"name":"","email":"","phone":"9916831063"},{"name":"","email":"","phone":"9076763229"},{"name":"","email":"","phone":"9556099227"},{"name":"","email":"","phone":"9591062767"},{"name":"","email":"","phone":"7380960557"},{"name":"","email":"","phone":"7749850799"},{"name":"","email":"","phone":"9771892927"},{"name":"","email":"","phone":"7997083807"},{"name":"","email":"","phone":"9007950824"},{"name":"","email":"","phone":"7975667474"},{"name":"","email":"","phone":"6361310214"},{"name":"","email":"","phone":"9972293963"},{"name":"","email":"","phone":"9847219280"},{"name":"","email":"","phone":"8249046844"},{"name":"","email":"","phone":"7907188166"},{"name":"","email":"","phone":"7306283657"},{"name":"","email":"","phone":"9605914104"},{"name":"","email":"","phone":"6207894350"},{"name":"","email":"","phone":"9699653688"},{"name":"","email":"","phone":"9867801491"},{"name":"","email":"","phone":"8369074452"},{"name":"","email":"","phone":"9747302538"},{"name":"","email":"","phone":"8971844999"},{"name":"","email":"","phone":"9791117167"},{"name":"","email":"","phone":"6361264996"},{"name":"","email":"","phone":"8660961019"},{"name":"","email":"","phone":"9632642887"},{"name":"","email":"","phone":"9642059747"},{"name":"","email":"","phone":"8088507677"},{"name":"","email":"","phone":"9677979962"},{"name":"","email":"","phone":"6360328939"},{"name":"","email":"","phone":"8296835429"},{"name":"","email":"","phone":"9567629876"},{"name":"","email":"","phone":"9686517188"},{"name":"","email":"","phone":"9920069709"},{"name":"","email":"","phone":"9738313010"},{"name":"","email":"","phone":"9977910001"},{"name":"","email":"","phone":"9964113680"},{"name":"","email":"","phone":"7619182536"},{"name":"","email":"","phone":"7022674938"},{"name":"","email":"","phone":"8105938260"},{"name":"","email":"","phone":"6362263520"},{"name":"","email":"","phone":"7306036247"},{"name":"","email":"","phone":"9704648598"},{"name":"","email":"","phone":"7025828782"},{"name":"","email":"","phone":"8867114110"},{"name":"","email":"","phone":"9731866413"},{"name":"","email":"","phone":"9176406174"},{"name":"","email":"","phone":"8408940800"},{"name":"","email":"","phone":"8855869398"},{"name":"","email":"","phone":"8408944000"},{"name":"","email":"","phone":"8827836374"},{"name":"","email":"","phone":"9056471154"},{"name":"","email":"","phone":"9059471154"},{"name":"","email":"","phone":"7019352920"},{"name":"","email":"","phone":"9742821892"},{"name":"","email":"","phone":"8396954105"},{"name":"","email":"","phone":"8285038665"},{"name":"","email":"","phone":"8185038665"}]', JSON_OBJECT_AS_ARRAY);
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
                            "name" => "colorland_1_0_2023_promo",
                            "language" => ["code" => "en"],
                            "components" => [
                                [
                                    "type" => "header",
                                    "parameters" => [
                                        [
                                            "type" => "image",
                                            "image" => [
                                                "link" => "https://www.eksafar.club/storage/uploads/202302270113.jpeg",
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ])->json();
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
