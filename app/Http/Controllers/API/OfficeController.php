<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeStoreRequest;
use App\Models\ContactList;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{




    public function ApiCreate(OfficeStoreRequest $request)
    {

        $validated = $request->validated();
        // Create Office
        $office = Office::create([
            'office_name'  => $request->office_name,
            'office_owner'  => $request->office_owner,
            'country'  => $request->country,
            'city'  => $request->city,
            'phone' => $request->phone,
        ]);
        // Return response
        return response()->json(['office' => $office], 200);
    }
    public function show(string $id)
    {
        $office = Office::where('id', $id)->with('currencies')->where('status','active')->first();
        if ($office) {
            return response()->json(['success' => 'office retrived succefull', 'data' => $office], 200);
        } else {
            return response()->json(['failed' => 'office Not Found ',], 404);
        }
    }
    public function index()
    {
        $officesData = [];
        $office_id = auth()->user()->office_id;
        $offices = Office::where('id', '!=' , $office_id)->where('status','active')->get();
        
        if ($offices) {
            foreach ($offices as $office) {
                $contactList = ContactList::where(function ($query) use ($office_id, $office) {
                    $query->where('contact_id', $office_id)->Where('office_id', $office->id);
                })->orWhere(function ($query) use ($office_id, $office) {
                    $query->where('office_id', $office_id)->Where('contact_id', $office->id);
                })
                    ->where('status', 'confirm')->first();
                if (!$contactList ) {
                    array_push($officesData, $office);
                }
            }

            return response()->json(['office' => $officesData], 200);
        } else {
            return response()->json(['failed' => 'offices Not Found ',], 404);
        }
    }
    public function search(Request $request)
    {
        $officesData = [];
        $office_id = auth()->user()->office_id;
        $offices = Office::whereNotIn('id', [$office_id])->where('office_name', 'like', '%' . $request->search . '%')->where('status','active')->get();
        if ($offices) {
            foreach ($offices as $office) {
                $contactList = ContactList::where(function ($query) use ($office_id, $office) {
                    $query->where('contact_id', $office_id)->Where('office_id', $office->id);
                })->orWhere(function ($query) use ($office_id, $office) {
                    $query->where('office_id', $office_id)->Where('contact_id', $office->id);
                })
                    ->where('status', 'confirm')->first();
                if (!$contactList) {
                    array_push($officesData, $office);
                }
            }

            return response()->json(['office' => $officesData], 200);
        } else {
            return response()->json(['failed' => 'offices Not Found ',], 404);
        }
    }

    public function notification()
    {
        $office = Office::where('id', auth()->user()->office_id)->first();
        if ($office) {


            return response()->json(['success' => 'office  notifications retrived succefull', 'notifications' => $office->unreadNotifications()->paginate(10)], 200);
        } else {
            return response()->json(['failed' => 'office Not Found ',], 404);
        }
    }
    public function SetReadnotification($notificationId)
    {
        $office = Office::where('id', auth()->user()->office_id)->first();
        if ($office) {
            $notificationExists = $office->unreadNotifications()->where('id', $notificationId)->exists();

            if ($notificationExists) {
                $office->unreadNotifications->find($notificationId)->markAsRead();
                return response()->json(['success' => ' notifications marked as Read succefull'], 200);
            } else {

                return response()->json(['failed' => 'notifications not found'], 404);
            }
        } else {
            return response()->json(['failed' => 'office Not Found ',], 404);
        }
    }
    public function destroy()
    {

        $office = Office::find(auth()->user()->office_id);
        if ($office) {
            $office->update([
                'status'  => 'request delete',
            ]);
            return response()->json(['success' => 'Office Delete Request Sent   succefull'], 200);
        } else {
            return response()->json(['failed' => 'office Not Found ',], 404);
        }
    }
}
