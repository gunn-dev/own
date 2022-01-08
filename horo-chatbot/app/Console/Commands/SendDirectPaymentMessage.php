<?php

namespace App\Console\Commands;

use BotMan\Drivers\Facebook\FacebookDriver;
use Illuminate\Console\Command;

class SendDirectPaymentMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment_direct:send_message {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send direct payment complete message';

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
        $payment_success_message = 'ငွေပေးချေမှုအောင်မြင်ပါသည်။ မေးမြန်းထားသည့် ဗေဒင်အဟောဖိုင်များအား လူကြီးမင်းထံ နှစ်ရက်အတွင်းပြန်လည်ပို့ပေးသွားပါမည်။  မေးမြန်းမှုအတွက်ကျေးဇူးတင်ပါတယ်ရှင့်။';
        $bot->say(getLang($lang['font_type'], $payment_success_message), $this->argument('user_id'), FacebookDriver::class);
    }
}
