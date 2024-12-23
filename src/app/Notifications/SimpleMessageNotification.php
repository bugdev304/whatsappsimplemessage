<?php

namespace Pablo\Whatsappsimplemessage\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Pablo\Whatsappsimplemessage\app\Broadcasting\Message\WhatsappMessage;
use Pablo\Whatsappsimplemessage\app\Broadcasting\WhatsappChannel;

class SimpleMessageNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    public string $message;

    public function __construct(
        string $message
    )
    {
        $this->message = $message;
    }

    /**
     * @return class-string[]
     */
    public function via(): array
    {
        return [WhatsappChannel::class];
    }

    public function toWhatsapp($notifiable)
    {
        return json_encode($this->formatMessageToService($notifiable->routeNotificationFor('whatsapp'), $this->message));
    }

    /**
     * @param string $phone
     * @param string $message
     * @return string[]
     */
    private function formatMessageToService(string $phone, string $message): array
    {
        return [
            'phone' => $this->formatPhoneNumber($phone),
            'message' => (new WhatsappMessage())->content($message),
        ];
    }

    /**
     * @param string $phone
     * @return string
     */
    private function formatPhoneNumber(string $phone): string
    {
        $phone = env('APP_ENV') !== 'production' ? config('services.zapi.default_number') : $phone;
        if (!Str::startsWith($phone, config('default_country_ddi'))) {
            $phone = config('default_country_ddi') . $phone;
        }
        return $phone;
    }
}
