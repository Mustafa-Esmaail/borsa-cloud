<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactListStoreRequest;
use App\Http\Requests\ContactListUpdateRequest;
use App\Models\ContactList;
use Illuminate\Http\Request;

class ContactListController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contactList = ContactList::where('office_id', auth()->user()->office_id)->with('contactOffices')->get();
        return response()->json(['success' => 'Contact List retrived succefull', 'data' => $contactList]);
    }


    public function store(ContactListStoreRequest $request)
    {
        //
        $check = ContactList::where('office_id', auth()->user()->office_id)->where('contact_id',  $request->contact_id)->first();
        if ($check) {
            return response()->json(['failed' => 'Contact List Already Exists', 'data' => $check]);

        }
        else{
            $contactList = ContactList::create([
                'office_id'  => auth()->user()->office_id,
                'contact_id'  => $request->contact_id,
            ]);
            return response()->json(['success' => 'Contact List Create succefull', 'data' => $contactList]);

        }
       }

    public function update(ContactListUpdateRequest $request,string $id)
    {
        //
        $contactList = ContactList::find($id);
        if ($contactList) {
            $contactList->update([
                // 'office_id'  => auth()->user()->office_id,
                'contact_id'  => $request->contact_id,
                'status'  => $request->status,
            ]);
            return response()->json(['success' => 'Contact List Updated succefull', 'data' => $contactList]);
        } else {
            return response()->json(['failed' => 'Contact List Not exists']);
        }
    }

    public function destroy(string $contact_list_id)
    {

        $contactList = ContactList::find($contact_list_id);
        if ($contactList) {
            $contactList->delete();
            return response()->json(['success' => 'Contact List Deleted succefull']);
        } else {
            return response()->json(['failed' => 'Contact List Not exists']);
        }
    }
}
