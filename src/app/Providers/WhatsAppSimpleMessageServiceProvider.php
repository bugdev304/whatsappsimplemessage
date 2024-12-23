<?php

namespace Pablo\Whatsappsimplemessage\app\Providers;

use Illuminate\Support\ServiceProvider;

class WhatsAppSimpleMessageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfig();
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/whatsapp.php',
            'whatsapp-config'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/whatsapp.php' => config_path('whatsapp.php'),
        ], 'whatsapp-config');
    }
}
