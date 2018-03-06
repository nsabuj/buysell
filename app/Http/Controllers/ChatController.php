<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatMessage;
use App\User;
use App\Chat;
class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {

        $user_id = $request->user_id;

        $text = $request->text;
        $chat_id=$request->chat_id;
     //   $chatMessage = new ChatMessage();
        ChatMessage::create([
            'sender_id' => $user_id,
            'chat_id' => $chat_id,
            'message' => $text
        ]);

    }

    public function isTyping(Request $request)
    {
        $user_id = $request->user_id;

        $chat = Chat::find($request->chat_id);
        if ($chat->user1 == $user_id)
            $chat->user1_is_typing = true;
        else
            $chat->user2_is_typing = true;
        $chat->save();
    }

    public function notTyping(Request $request)
    {
        $user_id = $request->user_id;

        $chat = Chat::find($request->chat_id);
        if ($chat->user1 == $user_id)
            $chat->user1_is_typing = false;
        else
            $chat->user2_is_typing = false;
        $chat->save();
    }

    public function retrieveChatMessages(Request $request)
    {
        $sender_id = $request->user_id;
        $chat_id = $request->chat_id;

        $messages =ChatMessage::where('chat_id',$chat_id)->where('sender_id', '!=', $sender_id)->where('read', '=', false)->get();
        if (count($messages) > 0)
        {
            $msg='';
            foreach ($messages as $message) {
                $msg.='<div class="msg-single sender-'.$message->sender_id.'">'.$message->message.'</div>';
                $msg_inst=ChatMessage::find($message->id);
                $msg_inst->read = true;
                $msg_inst->save();

            }
            return $msg;
        }
    }

    public function retrieveTypingStatus(Request $request)
    {
        $user_id = $request->user_id;

        $chat_id=$request->chat_id;
        $chat = Chat::find($chat_id);
        if ($chat->user1 == $user_id)
        {
            if ($chat->user2_is_typing) {
                $user_id = $chat->user2;
                $user = User::find($user_id);
                return $user->name;
            }

        }
        else
        {
            if ($chat->user1_is_typing) {
                $user_id = $chat->user1;
                $user = User::find($user_id);
                return $user->name;
            }
        }
    }
}
