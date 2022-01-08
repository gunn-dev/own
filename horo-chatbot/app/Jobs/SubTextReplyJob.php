<?php

namespace App\Jobs;

use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Crypt;

class SubTextReplyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bot;

    public function __construct($bot)
    {
        $this->bot = $bot;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


//        $this->bot->reply(uni_zaw('အချစ်ရေးဗေဒင် ၊ ဂဏန်းဗေဒင် ၊ ရက်သားဗေဒင် အဟောတို့အား မေးမြန်းနိုင်ပါပြီ။ ဉာဏ်ပူဇော်ခမှာ (500) ကျပ် ဖြစ်ပြီး ဗေဒင်မေးမြန်းနိုင်သော ကာလသက်တမ်းမှာ (၇) ရက်ဖြစ်ပါတယ်။', $this->bot));

        TypeandWait::dispatch($this->bot, 1);

        $user_id = Crypt::encrypt($this->bot->getUser()->getId());
        $lang = $this->bot->userStorage()->find($this->bot->getUser()->getId());
        if (isset($lang) || $lang != '') {
            $lang = $lang['font_type'];
        } else {
            $lang = 'unicode';
        }

        $this->bot->reply(GenericTemplate::create()
            ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
            ->addElements([

                Element::create(uni_zaw('ဖုန်းခေါ်၍ ဗေဒင်မေးမည်။', $this->bot))
                    ->subtitle(uni_zaw('ဗေဒင်ဆရာများမှ ဖုန်းခေါ်ပြီး ေဟာကြားပေးပါသည်။', $this->bot))
                    ->image('https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/o1VwsUDjD4By1NurtsJzGhM6p3RKcqHsHQNWX500.jpeg')
                    ->addButton(ElementButton::create(uni_zaw('မေးမည်', $this->bot))->url(config('payment.horo_endpoint') . '/baydin_sayar/horo?user_id=' . $user_id . '&lang=' . $lang)),

                Element::create(uni_zaw('Messenger မှ တိုက်ရိုက်မေးမည်။', $this->bot))
                    ->subtitle(uni_zaw('ဗေဒင်ဆရာများမှ ကိုယ်တိုင်တွက်ချက်ဟောကြားပေးပါသည်။', $this->bot))
                    ->image('https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/JmWP2nRjTBUlkjFwg2JEyj4G7mzrSKxgjmEuaEzO.jpeg')
                    ->addButton(ElementButton::create(uni_zaw('ဗေဒင်ဆရာနဲ့တိုက်ရိုက်မေးမည်', $this->bot))->url(config('payment.horo_endpoint') . '/direct/horo?user_id=' . $user_id . '&lang=' . $lang))
                    ->addButton(ElementButton::create(uni_zaw('အထူးဟောစာတမ်းများမေးမည်', $this->bot))
                        ->payload('horo__zartar')->type('postback'))
                    ->addButton(ElementButton::create(uni_zaw('နေ့စဉ်၊ အပတ်စဉ်၊ လစဉ် ဟောစာတမ်းများ', $this->bot))
                        ->payload('horo__m_w_d')->type('postback'))
            ])
        );


    }
}
