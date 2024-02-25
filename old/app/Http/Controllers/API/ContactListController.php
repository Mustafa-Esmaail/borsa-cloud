<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactListStoreRequest;
use App\Http\Requests\ContactListUpdateRequest;
use App\Http\Requests\SendMessageRequest;
use App\Models\ContactList;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Notifications\officeNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Office;



class ContactListController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
     {
        //
        $office_id = auth()->user()->office_id;
        $contactList = ContactList::where('office_id', $office_id)
            ->orWhere('contact_id', $office_id)->where('status','confirm')->paginate(10);
        if ($contactList) {
            foreach($contactList as $key => $list){
                if($list->office_id == $office_id  && $list->contact_id !== $office_id) {
                    // unset($list->contactOffices);
                    $list->officesData=Office::find($list->contact_id);
                }
                elseif($list->office_id !== $office_id  && $list->contact_id == $office_id){
                    // unset($list->Offices);
                    $list->officesData=Office::find($list->office_id);
                }
                if( !$list->officesData){
                    unset($contactList[$key]);
                }

            }
            return response()->json(['success' => 'Contact List retrived succefull', 'data' => $contactList], 200);
        } else {
            return response()->json(['failed' => 'Contacts Not Found ',], 404);
        }
    }




    public function store(ContactListStoreRequest $request)
    {
        //
        $check = ContactList::where('office_id', auth()->user()->office_id)->where('contact_id',  $request->contact_id)->first();
        if ($check) {
            return response()->json(['failed' => 'Contact List Already Exists', 'data' => $check], 401);
        } else {
            $contactList = ContactList::create([
                'office_id'  => auth()->user()->office_id,
                'contact_id'  => $request->contact_id,
            ]);
            $office=Office::find($request->contact_id);
            $notification['title']='طلب اضافه في جهات الاتصال ';
            $notification['message']='قام المكتب  '.$office->office_name.' بإضافتك في جهات الاتصال ';
            $notification['data']=$contactList->contactOffices();

            Notification::send($office, new officeNotification($notification));

            return response()->json(['success' => 'Contact List Create succefull', 'data' => $contactList], 200);
        }
    }

    public function update(ContactListUpdateRequest $request, string $id)
    {
        //
        $contactList = ContactList::find($id);
        if ($contactList) {
            $contactList->update([
                // 'office_id'  => auth()->user()->office_id,
                // 'contact_id'  => $request->contact_id,
                'status'  => $request->status,
            ]);
            return response()->json(['success' => 'Contact List Updated succefull', 'data' => $contactList], 200);
        } else {
            return response()->json(['failed' => 'Contact List Not exists'], 404);
        }
    }

    public function destroy(string $contact_list_id)
    {

        $contactList = ContactList::find($contact_list_id);
        if ($contactList) {
            $contactList->delete();
            return response()->json(['success' => 'Contact List Deleted succefull'], 200);
        } else {
            return response()->json(['failed' => 'Contact List Not exists'], 404);
        }
    }
    public function sendMessage(SendMessageRequest $request)
    {
        $office_id = auth()->user()->office_id;
        $receiver_id = $request->receiver_id;

        $contactList = ContactList::where(function ($query) use ($office_id, $receiver_id) {
            $query->where('office_id', $office_id)->Where('contact_id', $receiver_id);
        })->orWhere(function ($query) use ($office_id, $receiver_id) {
            $query->where('office_id', $receiver_id)->Where('contact_id', $office_id);
        })->first();
        if ($contactList) {
            switch ($request->message_type) {
                case 'text':
                    // Handle text message

                    $message = Message::create([
                        'sender_id' => auth()->user()->id,
                        'text' => $request->message,
                        'message_type' => 'text',
                        'contact_id' => $contactList->id,
                    ]);
                    $contactList->last_message = $request->message;
                    $contactList->last_time_message = $message->created_at;
                    $contactList->update([
                        'last_message' => $request->message,
                        'last_time_message' => $message->created_at,
                    ]);
                    $message->load('sender');

                    if ($message && $contactList) {

                        return response()->json(['succes' => 'message text sent succesfully', 'message' => $message], 200);
                    } else {
                    }

                    // Logic to send text message
                    break;

                case 'img':
                    // Handle image message
                    $validatedImage = $request->validate([
                        'message' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048', // Adjust max file size as needed
                    ]);
                    $imagePath = $request->file('message')->store('chat_img', 'public');
                    $message = Message::create([
                        'sender_id' => auth()->user()->id,
                        'img' => $imagePath,
                        'message_type' => 'img',
                        'contact_id' => $contactList->id,

                    ]);
                    $contactList->update([
                        'last_message' => 'img',
                        'last_time_message' => $message->created_at,
                    ]);
                    $message->load('sender');

                    if ($message && $contactList) {
                        return response()->json(['succes' => 'message img sent succesfully', 'message' => $message], 200);
                    } else {
                    }
                    // Logic to send image message


                    break;

                case 'voice':
                    $validatedVoiceNote = $request->validate([
                        'message' => 'required',
                    ]);
                    // Handle voice note message
                    $voicePath = $request->file('message')->store('chat_voice', 'public');
                    $message = Message::create([
                        'sender_id' => auth()->user()->id,
                        'img' => $voicePath,
                        'message_type' => 'voice',
                        'contact_id' => $contactList->id,

                    ]);
                    $contactList->update([
                        'last_message' => 'voice',
                        'last_time_message' => $message->created_at,

                    ]);
                    $message->load('sender');

                    if ($message && $contactList) {
                        return response()->json(['succes' => 'message voice sent succesfully', 'message' => $message], 200);
                    } else {
                        return response()->json(['error' => 'Invalid message data'], 400);
                    }

                    break;
                default:
                    return response()->json(['error' => 'Invalid message type'], 400);
            }
        }
    }
    public function messages(int $id)
    {
        //
        $office_id = auth()->user()->office_id;
        $contactList = ContactList::with(['messages'])->where(function ($query) use ($office_id, $id) {
            $query->where('office_id', $office_id)->Where('contact_id', $id);
        })->orWhere(function ($query) use ($office_id, $id) {
            $query->where('office_id', $id)->Where('contact_id', $office_id);
        })->first();
        // $contactList->messages->load('sender');

        if ($contactList) {
            $messages=Message::where('contact_id',$contactList->id)->paginate(10);

            return response()->json(['success' => 'messages retrived succefull', 'data' => $messages], 200);
        } else {
            return response()->json(['failed' => 'Contacts Not Found ',], 404);
        }
    }
}
