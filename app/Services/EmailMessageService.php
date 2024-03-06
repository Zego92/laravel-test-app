<?php


namespace App\Services;

use App\Contracts\MessageContract;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class EmailMessageService implements MessageContract
{
    public function sendMessage(string $toUser, string $type, string $body): void
    {
        Mail::raw($body, function (Message $message) use ($toUser, $type) {
            $message
                ->to($toUser)
                ->from(config('mail.from.address'))
                ->subject($type);
        });
    }
}
