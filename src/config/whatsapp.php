<?php
return [
    'base_url' => env('BASE_URL'),
    'instance' => env('INSTANCE'),
    'instance_token' => env('INSTANCE_TOKEN'),
    'security_token' => env('SECURITY_TOKEN'),
    'enabled' => env('WHATSAPP_ENABLED', false),
    'default_number' => env('DEFAULT_NOTIFICATION_NUMBER'),
    'send_url' => env('SEND_URL', 'send-text'),
    'default_country_ddi' => env('DEFAULT_COUNTRY_DDI', '55'),
];
