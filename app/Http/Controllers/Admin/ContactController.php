<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactUpdateRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    function index(): View
    {
        $contact = Contact::first();
        return view('admin.contact.index',compact('contact'));
    }

    function update(ContactUpdateRequest $request): RedirectResponse
    {
        Contact::updateOrCreate(
            ['id' => 1],
            [
                'phone' => $request->phone,
                'mail' => $request->mail,
                'address' => $request->address,
                'map_link' => $request->map_link,
            ]
        );

        toastr()->success('Contact Updated Successfully!');

        return redirect()->back();
    }
}
