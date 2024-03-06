<?php


namespace App\Services;

use App\Contracts\MessageContract;
use Illuminate\Notifications\Slack\SlackMessage;

class SlackMessageService implements MessageContract
{
    public function __construct(protected SlackMessage $slackMessage)
    {
    }

    public function sendMessage(string $toUser, string $type, string $body): void
    {
        $this->slackMessage->headerBlock($type)->text($body);
    }
}
