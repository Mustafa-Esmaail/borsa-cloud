<?php

namespace App\Http\Controllers\API;

use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendMessageRequest;

class ChatController extends Controller
{
    //
    public function sendMessage(SendMessageRequest $request)
    {
        $message = $request->message;
        $sender = $request->sender;
        $receiver = $request->receiver;


        event(new SendMessage($message,$sender,$receiver));

        return response()->json(['status' => 'Message sent!']);
    }
}
