<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ContactImport;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            \Maatwebsite\Excel\Facades\Excel::import(new ContactImport, request()->file('file'));
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

            $wRes = Http::withToken('EAAMjVOLPyiYBAKzLFAZCAFo3GUN0h1bjHI7S54j29GzpTqaLEogZAkgvtP4ZAhJ2AcZBjyct5KmQSD5GOhlQLdyL1d3UxcCJBetMfnNRwLfvkwQzDJZCiVoABuxZC3UUQnXoptjzSKRdUA7e6ZAE3yE43xlfCmvGFQYYwdpkaLwITZCi9VfppPHn3sIvXZAVqxX51AZAvoWl9vcGeBZCoYGh38oOGtpXFlCCuUZD')
                ->post('https://graph.facebook.com/v15.0/110821481827920/messages',  [
                    "messaging_product" => "whatsapp",
                    "to" => "919123881186",
                    "recipient_type" => "individual",
                    // "type" => "text",
                    // "text" => [
                    //     "preview_url" => true,
                    //     "body" => $message
                    // ]
                    "type" => "template",
                    "template" => [
                        "name" => "hello_world", "language" => ["code" => "en_US"]
                    ]
                ]);


            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v15.0/110821481827920/messages');
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            // curl_setopt($ch, CURLOPT_HTTPHEADER, [
            //     'Authorization: Bearer EAAMjVOLPyiYBAKzLFAZCAFo3GUN0h1bjHI7S54j29GzpTqaLEogZAkgvtP4ZAhJ2AcZBjyct5KmQSD5GOhlQLdyL1d3UxcCJBetMfnNRwLfvkwQzDJZCiVoABuxZC3UUQnXoptjzSKRdUA7e6ZAE3yE43xlfCmvGFQYYwdpkaLwITZCi9VfppPHn3sIvXZAVqxX51AZAvoWl9vcGeBZCoYGh38oOGtpXFlCCuUZD',
            //     'Content-Type: application/json',
            // ]);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "messaging_product": "whatsapp", "to": "919123881186", "type": "template", "template": { "name": "hello_world", "language": { "code": "en_US" } } }');

            // $response = curl_exec($ch);

            //curl_close($ch);

            return response()->json([
                "status" => 200,
                'message' => 'Successfully sent message file',
                "content" => $message,
                "response" => $wRes->json()
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
