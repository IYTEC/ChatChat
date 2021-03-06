<?php

namespace App\Http\Controllers;

use Auth;
use App\Events\MessagePosted;
use LRedis;
use App\PrivateMessage;
use Illuminate\Http\Request;
use Vinkla\Pusher\Facades\Pusher as LaravelPusher;

class PrivateMessageController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getUserNotifications(Request $request)
  {
    $notifications = PrivateMessage::where('read', 0)
                      ->where('receiver_id', $request->user()->id)
                      ->orderBy('created_at', 'asc')
                      ->get();

    return $notifications;
  }

  public function getPrivateMessages(Request $request)
  {
    $pms = PrivateMessage::where('receiver_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

    return $pms;
  }

  public function getPrivateMessageById(Request $request)
  {
    // return $request->input('id')
    $pm = PrivateMessage::where('id', $request->input('id'))->first();
    // $pm = $request->input('id')

    if($pm->read === 0){
      $pm->read = 1;
      $pm->save();
    }
    return $pm;
  }

  public function getPrivateMessageSent(Request $request)
  {
    $pms = PrivateMessage::where('sender_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

    return $pms;
  }

  public function sendPrivateMessage(Request $request)
  {
    $curruser = Auth::user();
    $attributes = [
      'sender_id' => $request->user()->id,
      'receiver_id' => $request->input('receiver_id'),
      'message' => $request->input('message'),
      'subject' => $request->input('subject'),
      'read' => 0,
    ];

    $pm = PrivateMessage::create($attributes);
    $data = PrivateMessage::where('id', $pm->id)->first();

    event(new MessagePosted($data, $curruser));
    // LaravelPusher::trigger('chat_channel', 'chat_saved', ['message' => $data]);

    return $data;
  }

}
