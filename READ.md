<p align="center"><a href="https://ae3tecnologia.com.br/" target="_blank"><img src="https://s2-techtudo.glbimg.com/qsIuHxZ_g2spsqzzh3jNDCft2WE=/0x0:620x395/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_08fbf48bc0524877943fe86e43087e7a/internal_photos/bs/2021/1/1/I6jD4IToSd28BHUj0nrA/2013-11-07-whatsapp-e-o-mensageiro-de-maior-sucesso-atualmente.png" width="200" alt="A&3 Logo"></a></p>

<h1 align="center">Whatsapp Simple Message</h1>

<p>Pacote para envio de mensagem simples pelo Whatsapp utilizando a plataforma Z-API</p>

## Requisitos

- PHP >= 7.4
- Laravel >= 8.0

## Como configurar o projeto?

1) Adicione este repositório à lista de repositórios do composer em seu projeto laravel.

```json
{
  "repositories": [
    {
      "type": "git",
      "url": "https://git.ae3tecnologia.com.br/AE3_TECNOLOGIA_OPENSOURCE/whatsappsimplemessage.git"
    }
  ]
}


```

2) Execute o comando a seguir para baixar esta lib ao vendor do seu projeto.

```
composer require pablo/whatsappsimplemessage
```

3) Configure as variáveis abaixo no .env do seu projeto.

```
WHATSAPP_ENABLED=true
BASE_URL=https://example.com
INSTANCE=https://example.com
INSTANCE_TOKEN=1234567890
SECURITY_TOKEN=1234567890
DEFAULT_NOTIFICATION_NUMBER=YYXXNNNNNNNNN -> DDI+DDD+NUMERO
SEND_URL=send-text
DEFAULT_COUNTRY_DDI=55
```

4) Execute o comando abaixo para publicar o arquivo de configuração do pacote.

```
php artisan vendor:publish --tag=whatsapp-config
```

5) Model Notifiable

```php
use Pablo\Whatsappsimplemessage\app\Notifications\SimpleMessageNotification;

class User extends Authenticatable
{
    use Notifiable;

    public function routeNotificationForWhatsapp()
    {
        return $this->phone;
    }
}
```

6) Enviar mensagem

```php
$user = \App\Models\User::first();
$user->notify(new \Pablo\Whatsappsimplemessage\app\Notifications\SimpleMessageNotification('Teste'));
```


