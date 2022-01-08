<?php

namespace App\Console\Commands;

use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\FacebookDriver;
use Illuminate\Console\Command;

class ReplyPamentFailMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:payment_fail {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reply Message For Payment Fail';

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
        try {

            $lang = $bot->userStorage()->find($this->argument('user_id'));


            $bot->say(getLang($lang['font_type'], 'ငွေပေးချေမှုမအောင်မြင်ပါ။ အသေးစိတ်အချက်အလက်များကိုသိရှိလိုပါက အောက်ပါ ခလုတ်ကို နှိပ်ပြီးမေးမြန်း နိုင်ပါသည်။'), $this->argument('user_id'), FacebookDriver::class);

            $message = ButtonTemplate::create(getLang($lang['font_type'], 'မေးမြန်းလိုပါသလား?'))
                ->addButton(ElementButton::create(getLang($lang['font_type'], 'မေးမည်'))
                    ->type('phone_number')
                    ->payload('+1875')
                )->addButton(ElementButton::create('Menu')
                ->type('postback')->payload('font ' . $lang['font_type']));

            $bot->say($message, $this->argument('user_id'), FacebookDriver::class);

        } catch (\Exception $e) {
            $this->info('FAIL
             topsending message to ' . $this->argument('user_id'));
            $this->info($e->getCode() . ': ' . $e->getMessage());
        }

        $this->info('Success.');
    }

}
