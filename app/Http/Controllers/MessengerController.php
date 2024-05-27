<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use pimax\FbBotApp;
// use pimax\Messages\Message;

class MessengerController extends Controller
{
    // public function webhook(Request $request)
    // {
    //     $local_verify_token = env('WEBHOOK_VERIFY_TOKEN');
    //     $hub_verify_token = $request->query('hub_verify_token');

    //     if ($local_verify_token == $hub_verify_token) {
    //         return $request->query('hub_challenge');
    //     } else {
    //         return "Verification token mismatch";
    //     }
    // }

    public function verifyWebhook(Request $request)
    {
        $verifyToken = env('FB_VERIFY_TOKEN');

        if ($request->hub_mode === 'subscribe' && $request->hub_verify_token === $verifyToken) {
            return response($request->hub_challenge, 200);
        }

        return response('Forbidden', 403);
    }

    public function handleWebhook(Request $request)
    {
        $data = $request->all();
        Log::info('Webhook received', $data);

        foreach ($data['entry'] as $entry) {
            $messaging = $entry['messaging'];
            foreach ($messaging as $message) {
                $senderId = $message['sender']['id'];
                $messageText = $message['message']['text'] ?? '';

                // Handle the message and send a response
                $this->sendMessage($senderId, "You said: $messageText");
            }
        }

        return response('EVENT_RECEIVED', 200);
    }

    protected function sendMessage($recipientId, $messageText)
    {
        $accessToken = env('FB_PAGE_ACCESS_TOKEN');
        $url = 'https://graph.facebook.com/v11.0/me/messages';

        $data = [
            'recipient' => ['id' => $recipientId],
            'message' => ['text' => $messageText],
            'access_token' => $accessToken,
        ];

        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, ['json' => $data]);

        Log::info('Message sent', ['response' => $response->getBody()->getContents()]);
    }
    
}
