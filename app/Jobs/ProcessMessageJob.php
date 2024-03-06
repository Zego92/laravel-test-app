<?php

namespace App\Jobs;

use App\Manager\MessageManager;
use http\Exception\RuntimeException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $toUser,
        protected string $type,
        protected string $body,
    ) {
        //
    }

    /**
     * Execute the job.
     * @throws Throwable
     */
    public function handle(MessageManager $messageManager): void
    {
        try {
            $channel = $this->queue;

            if (!$channel) {
                throw new RuntimeException('The channel not defined');
            }

            $messageManager->driver($channel)->sendMessage($this->toUser, $this->type, $this->body);

        } catch (Throwable $exception) {
            Log::driver('notifications')->error($exception->getMessage());

            throw $exception;
        }

        $logBody = [
            'channel' => $channel,
            'type' => $this->type,
        ];
        Log::driver('notifications')->info('success', $logBody);

    }
}
