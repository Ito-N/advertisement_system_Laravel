<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class SendMessageController extends Controller
{
    public function store(Request $request)
    {
        Message::create([
            'user_id' => $request->userId,
            'receiver_id' => $request->receiverId,
            'ad_id' => $request->adId,
            'body' => $request->body,
        ]);
    }
}
