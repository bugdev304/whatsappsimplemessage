<?php

namespace Pablo\Whatsappsimplemessage\app\Broadcasting\Message;

class WhatsappMessage
{
    public string $content;

    /**
     * @param $content
     * @return $this
     */
    public function content($content): self
    {
        $this->content = $content;
        return $this;
    }
}
