<?php
use App\Http\Controllers\BotManController;
use App\Http\Controllers\BotmanTemplateController;
use App\Http\Controllers\BotmanSubTemplateController;
use App\Http\Controllers\BotmanContentDeliverController;
use BotMan\BotMan\Messages\Attachments\Location;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use App\Http\Controllers\ReferralController;

$botman = resolve('botman');

$botman->hears('GET_STARTED', BotmanTemplateController::class.'@getStart');

$botman->hears('font {type}', BotmanTemplateController::class.'@setFonttype');
$botman->hears('horo__{service}', BotmanTemplateController::class.'@replyTemplate');

$botman->hears('Category__{id}', BotmanSubTemplateController::class.'@subTemplate');

$botman->hears('Content_Deliver__{id}', BotmanContentDeliverController::class.'@contentDeliver');

$botman->hears('create__{service}__{amount}', function (\BotMan\BotMan\BotMan $bot, $service ,$amount) {
    $bot->reply(GenericTemplate::create()
        ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
        ->addElements([
            Element::create(uni_zaw('ငွေပေးချေမှု', $bot))
                ->subtitle(uni_zaw('ငွေပေးချေရန်အတွက် အောက်က ခလုတ်လေးကို နှိပ်ပေးပါရှင့်။', $bot))
                ->image('https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/KWAIRTmiIBNktjolJ3Gx1rGooyiKAspKQ1gLaTrJ.jpeg')
                ->addButton(ElementButton::create(uni_zaw('ငွေပေးမည်', $bot))->url('m.me/1875BayDin?ref='.$service.'_'.$amount))

        ])
    );
});


$botman->on('messaging_referrals', ReferralController::class.'@ref');

$botman->on('messaging_optins', function($payload, $bot) {
$bot->reply('hello');
});
