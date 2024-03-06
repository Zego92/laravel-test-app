<?php

namespace App\Providers;

use App\Manager\MessageManager;
use App\Services\EmailMessageService;
use App\Services\SlackMessageService;
use App\Services\SmsMessageService;
use App\Services\TeamsMessageService;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Slack\SlackMessage;
use Illuminate\Support\ServiceProvider;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsMessage;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MessageManager::class, function ($app) {
            $manager = new MessageManager($app);

            $manager->extend('sms', function () use ($app) {
                return $app[SmsMessageService::class];
            });

            $manager->extend('email', function () use ($app) {
                return $app[EmailMessageService::class];
            });

            $manager->extend('slack', function () use ($app) {
                return $app[SlackMessageService::class];
            });

            $manager->extend('teams', function () use ($app) {
                return $app[TeamsMessageService::class];
            });

            return $manager;
        });

        $this->app->singleton(SmsMessageService::class, function ($app) {
            return new SmsMessageService($app[VonageMessage::class]);
        });

        $this->app->singleton(EmailMessageService::class, function () {
            return new EmailMessageService();
        });

        $this->app->singleton(SlackMessageService::class, function ($app) {
            return new SlackMessageService($app[SlackMessage::class]);
        });

        $this->app->singleton(TeamsMessageService::class, function ($app) {
            return new TeamsMessageService($app[MicrosoftTeamsMessage::class]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
