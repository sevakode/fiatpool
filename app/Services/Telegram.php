<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Telegram
{
    public function withdraw($id)
    {
        $MadelineProto = new \danog\MadelineProto\API(storage_path('tgsession') . '/' . $id . 'session.madeline');
        $MadelineProto->start();
        $MadelineProto->messages->sendMessage(['peer' => '@WhalesPoolBot', 'message' => "/withdraw"]);
        sleep(2);
        $messages_AffectedMessages = $MadelineProto->messages->getPeerDialogs(['peers' => ['@WhalesPoolBot']]);
        $MadelineProto->messages->sendMessage(['peer' => '@WhalesPoolBot', 'message' => "0", 'reply_to_msg_id' => $messages_AffectedMessages['messages'][0]['id']]);
        $message=$messages_AffectedMessages['messages'][0]['message'] ;


        $pos1      = strripos($message, '(');
        $message = substr($message, $pos1+1, 20);
        $pos2      = strripos($message, ' T');
        $message = substr($message, 0, $pos2);
        return (float) $message;
    }

    static function logger($text){
        Http::get('https://api.telegram.org/bot'.env('LOGGER_TOKEN').'/sendMessage',['chat_id'=>env('LOGGER_ID'),'text'=>json_encode($text,JSON_PRETTY_PRINT)]);
    }
}
