<?php

namespace App\Console\Commands;

use App\Models\BusinessNaming;
use App\Models\ChildNaming;
use App\Models\DirectBaydin;
use App\Models\LoveBayDin;
use App\Models\OneYear;
use App\Models\Rawlog;
use BotMan\BotMan\Messages\Attachments\Audio;
use BotMan\BotMan\Messages\Attachments\File;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\Drivers\Facebook\FacebookDriver;
use Illuminate\Console\Command;

class SendContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:content {user_id} {content_file} {extension} {id} {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bot = app('botman');
        $lang = $bot->userStorage()->find($this->argument('user_id'));
        try {
            $extension = $this->argument('extension');

            switch ($extension) {
                case "pdf":
                    $attachment = new File(config('horo.url') . '/horo/naming/get/content?name=' . $this->argument('content_file'), [
                        'custom_payload' => true,
                    ]);
                    break;
                case "mp3":
                    $attachment = new Audio(config('horo.url') . '/horo/naming/get/content?name=' . $this->argument('content_file'), [
                        'custom_payload' => true,
                    ]);
                    break;
                case "wav":
                    $attachment = new Audio(config('horo.url') . '/horo/naming/get/content?name=' . $this->argument('content_file'), [
                        'custom_payload' => true,
                    ]);
                    break;
                case "mp4":
                    $attachment = new Video(config('horo.url') . '/horo/naming/get/content?name=' . $this->argument('content_file'), [
                        'custom_payload' => true,
                    ]);
                    break;
            }
            $message = OutgoingMessage::create('This is my text')
                ->withAttachment($attachment);
            $bot->say($message, $this->argument('user_id'), FacebookDriver::class);

            $bot->say(getLang($lang['font_type'], 'မေးမြန်းထားသော ဗေဒင် အဖြေများကြည့်ရှုနိုင်ပါပြီ။'), $this->argument('user_id'), FacebookDriver::class);
            switch ($type = $this->argument('type')) {
                case 'business' :
                    $naming = BusinessNaming::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 1,
                        'is_delivered' => 1
                    ]);
                    break;
                case 'child':
                    $naming = ChildNaming::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 1,
                        'is_delivered' => 1
                    ]);
                    break;
                case 'oneyear':
                    $naming = OneYear::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 1,
                        'is_delivered' => 1
                    ]);
                    break;
                case 'lovebaydin':
                    $naming = LoveBayDin::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 1,
                        'is_delivered' => 1
                    ]);
                    break;
                case 'directbaydin':
                    $naming = DirectBaydin::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 1,
                        'is_delivered' => 1
                    ]);
                    break;
            }
        } catch (\Exception $e) {
            switch ($type = $this->argument('type')) {
                case 'business' :
                    $naming = BusinessNaming::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 2,
                        'is_delivered' => 1
                    ]);
                    break;
                case 'child':
                    $naming = ChildNaming::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 2,
                        'is_delivered' => 1
                    ]);
                    break;
                case 'oneyear':
                    $naming = OneYear::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 2,
                        'is_delivered' => 1
                    ]);
                    break;
                case 'lovebaydin':
                    $naming = LoveBayDin::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 2,
                        'is_delivered' => 1
                    ]);
                    break;
                case 'directbaydin':
                    $naming = DirectBaydin::where('id', $this->argument('id'))->first();
                    $naming->update([
                        'status' => 2,
                        'is_delivered' => 1
                    ]);
                    break;
            }

            $this->info('FAIL sending message to ' . $this->argument('user_id'));
            $this->info($e->getCode() . ': ' . $e->getMessage());
        }
    }
}
