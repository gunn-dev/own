<?php

namespace App\Http\Controllers;

use App\Jobs\CheckSucriptionAndContentDeliver;
use App\Jobs\ContentDeliver;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

class BotmanContentDeliverController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    public function contentDeliver(BotMan $bot, $id)
    {
        ContentDeliver::dispatch($bot, $id);
    }
}
