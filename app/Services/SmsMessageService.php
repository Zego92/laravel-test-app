<?php


namespace App\Services;


use App\Contracts\MessageContract;
use Illuminate\Notifications\Messages\VonageMessage;

class SmsMessageService implements MessageContract
{
    public function __construct(protected VonageMessage $vonageMessage)
    {
    }

    public function sendMessage(string $toUser, string $type, string $body): void
    {
        $this->vonageMessage->type = $type;
        $this->vonageMessage->content($body);
    }
}
