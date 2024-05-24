<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use pimax\FbBotApp;
// use pimax\Messages\Message;

class MessengerController extends Controller
{
    public function webhook(Request $request)
    {
        $local_verify_token = env('WEBHOOK_VERIFY_TOKEN');
        $hub_verify_token = $request->query('hub_verify_token');

        if ($local_verify_token == $hub_verify_token) {
            return $request->query('hub_challenge');
        } else {
            return "Verification token mismatch";
        }
    }
    
}
