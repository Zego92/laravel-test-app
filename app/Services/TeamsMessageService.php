<?php


namespace App\Services;


use App\Contracts\MessageContract;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsMessage;

class TeamsMessageService implements MessageContract
{
    public function __construct(protected MicrosoftTeamsMessage $microsoftTeamsMessage){}

    /**
     * @throws \NotificationChannels\MicrosoftTeams\Exceptions\CouldNotSendNotification
     */
    public function sendMessage(string $toUser, string $type, string $body): void
    {
        $this->microsoftTeamsMessage::create()
            ->to(config('services.microsoft_teams.webhook_url'))
            ->type($type)
            ->title($type)
            ->content($body);
    }
}
