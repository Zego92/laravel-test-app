<?php

namespace App\Http\Controllers;

use App\Contracts\MessageContract;
use App\Manager\MessageManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\NoReturn;

class HomeController extends Controller
{
    #[NoReturn] public function index()
    {
        /** @var MessageManager $app */
        $app = App::make(MessageManager::class);

        /** @var MessageContract $driver */
        $driver = $app->driver('sms');
//        Log::driver('notifications')->info('olololo');
        Log::channel('notifications')->info('aeasdasdopasjdija');
    }
}
