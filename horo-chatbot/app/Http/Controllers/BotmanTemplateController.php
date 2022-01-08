<?php

namespace App\Http\Controllers;

use App\Jobs\AddSubscription;
use App\Jobs\ReplayMessageTemplate;
use App\Jobs\SubTextReplyJob;
use App\Jobs\TypeandWait;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

class BotmanTemplateController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    public function getStart(BotMan $bot)
    {

//        TypeandWait::dispatch($bot, 1);

        AddSubscription::dispatch($bot);

        $bot->reply(ButtonTemplate::create('မင်္ဂလာပါရှင့်။ 1875 Bay Din  မှ ကြိုဆိုပါတယ်။ ကျေးဇူးပြု၍ ဖောင့်အမျိုးအစားရွေးရန်ခလုတ်ကိုနှိပ်ပါ
မဂၤလာပါရွင့္။ 1875 Bay Din မွ ႀကိဳဆိုပါတယ္။
ေက်းဇူးျပဳ၍ ေဖာင့္အမ်ိဳးအစားေ႐ြးရန္ခလုတ္ကိုႏွိပ္ပါ')
            ->addButton(ElementButton::create('ယူနီကုတ်')->type('postback')->payload('font unicode'))
            ->addButton(ElementButton::create('ေဇာ္ဂ်ီ')->type('postback')->payload('font zawgyi'))
        );
    }

    public function setFonttype(BotMan $bot, $type)
    {
        TypeandWait::dispatch($bot, 1);
        $bot->userStorage()->save([
            'font_type' => $type,
            'user_id' => $bot->getUser()->getId()
        ]);
        SubTextReplyJob::dispatch($bot);
    }

    public function replyTemplate(BotMan $bot, $service)
    {
        TypeandWait::dispatch($bot, 1);
        ReplayMessageTemplate::dispatch($bot, $service);
    }
}
