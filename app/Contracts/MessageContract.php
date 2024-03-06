<?php


namespace App\Contracts;

interface MessageContract
{
    public function sendMessage(string $toUser, string $type, string $body);
}
