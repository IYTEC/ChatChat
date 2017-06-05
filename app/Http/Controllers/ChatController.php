<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUserConversationById(Request $request)
    {
      $userID = $request->input('id');
      $authUserId = $request->user()->id;

      $chat = Chat::whereIn('sender_id', [$authUserId, $userID])
              ->whereIn('receiver_id', [$authUserId, $userID])
              ->orderBy('created_at', 'asc')
              ->get();

              return $chat;
    }

    public function saveuserchat(Request $request)
    {
      $sender_id = $request->user()->id;
      $receiver_id = $request->input('receiver_id');
      $chatText = $request->input('chat');

      $data = [
        'sender_id' => $sender_id,
        'receiver_id' => $receiver_id,
        'chat' => $chatText,
        'read' => 1
      ];

      $chat = Chat::create($data);
      $finalData = Chat::where('id', $chat->id)->first();

      return $finalData;
    }
}
