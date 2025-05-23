<?php

namespace Pablo\Whatsappsimplemessage\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Pablo\Whatsappsimplemessage\app\Broadcasting\Message\WhatsappMessage;
use Pablo\Whatsappsimplemessage\app\Broadcasting\WhatsappChannel;
use Pablo\Whatsappsimplemessage\app\Exceptions\RouteNotificationForWhatsappNotFound;

class SimpleMessageNotification extends Notification implements ShouldQueue
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
        if (!method_exists($notifiable, 'routeNotificationForWhatsapp')) {
            throw new RouteNotificationForWhatsappNotFound('The method routeNotificationForWhatsapp was not found in the model');
        }
        return $this->formatMessageToService($notifiable->routeNotificationFor('whatsapp'), $this->message);
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
            'message' => (new WhatsappMessage())->content($message)->content,
        ];
    }

    /**
     * @param string $phone
     * @return string
     */
    private function formatPhoneNumber(string $phone): string
    {
        $phone = env('APP_ENV') !== 'production' ? config('whatsapp.default_number') : $phone;
        if (!Str::startsWith($phone, config('whatsapp.default_country_ddi'))) {
            $phone = config('whatsapp.default_country_ddi') . $phone;
        }
        return $phone;
    }
}
