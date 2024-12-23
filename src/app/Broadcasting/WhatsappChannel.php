<?php

namespace Pablo\Whatsappsimplemessage\app\Broadcasting;

use Illuminate\Notifications\Notification;
use Pablo\Whatsappsimplemessage\app\Exceptions\RouteNotificationForWhatsappNotFound;

class WhatsappChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = json_encode($notification->toWhatsapp($notifiable));
        if (config('whatsapp.enabled')) {
            $this->performSending($message);
        }
    }

    private function performSending(string $message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('whatsapp.base_url') . config('whatsapp.send_url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $message,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "Client-Token: " . config('whatsapp.security_token')
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    }
}
