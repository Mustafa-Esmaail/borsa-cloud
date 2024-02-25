<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusStoreRequest;
use App\Http\Requests\StatusUpdateRequest;
use App\Models\ContactList;
use App\Models\Office;
use App\Models\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $new = [];
        $viewed = [];
        // $Office = Office::where('id', auth()->user()->office_id)->first();

        $contactList = ContactList::where('office_id',  auth()->user()->office_id)
        ->orWhere('contact_id', auth()->user()->office_id)->where('status','confirm')->get();
        foreach ($contactList as $list) {
            if ($list->status !== 'deny') {
                $statuss = Status::with(['office','currency'])->where('office_id', $list->id)->get();
                foreach($statuss as $status){
                    if ($status) {
                        if ($status->views) {
                            $views = explode(',', $status->views);
                            if (in_array(auth()->user()->office_id, $views)) {
                                //viewed
                                array_push($viewed, $status);
                            } else {
                                //new
                                array_push($new, $status);
                            }
                        } else {
                            //new
                            array_push($new, $status);
                        }
                    }
                }

            }
        }
        $mystatus = Status::where('office_id', auth()->user()->office_id)->first();
        // if ($mystatus) {
        //     $mystatus->views = count(explode(',', $mystatus->views));
        // }


        return response()->json(['success' => 'statuses retrived succefull', 'viewed' => $viewed, 'new' => $new, 'my status' => $mystatus]);
    }



    public function show($id)
    {

        $Status = Status::where('id', $id)->with(['office', 'currency'])->first();

        if ($Status) {
            return response()->json(['success' => 'Status retived succefull', 'data' => $Status], 200);
        } else {
            return response()->json(['failed' => 'Status Not Found  '], 404);
        }
    }
    public function store(StatusStoreRequest $request)
    {

        $Status = Status::create([
            'office_id'  => auth()->user()->office_id,
            'currency_id'  => $request->currency_id,
            'sell_price'  => $request->sell_price,
            'buy_price'  => $request->buy_price,

        ]);
        return response()->json(['success' => 'Status Create succefull', 'data' => $Status]);
    }

    public function update(StatusUpdateRequest $request, string $id)
    {
        //
        $Status = Status::find($id);
        if ($Status) {

            if ($Status->views) {
                $array = explode(',', $Status->views);
                array_push($array, $request->office_id);
                $views = implode(', ', $array);
                $Status->update([
                    'views'  =>  $views,
                ]);
                return response()->json(['success' => 'Status Updated succefull', 'data' => $Status]);
            } else {
                $array = [];
                array_push($array, $request->office_id);
                $views = implode(', ', $array);
                $Status->update([
                    'views'  => $views,
                ]);
                return response()->json(['success' => 'Status Updated succefull', 'data' => $Status]);
            }
        } else {
            return response()->json(['failed' => 'Status Not exists']);
        }
    }

    public function destroy(string $id)
    {

        $Status = Status::find($id);
        if ($Status) {
            $Status->delete();
            return response()->json(['success' => 'Status Deleted succefull']);
        } else {
            return response()->json(['failed' => 'Status Not exists']);
        }
    }
}
