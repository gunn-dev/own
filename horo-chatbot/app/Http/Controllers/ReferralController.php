<?php

namespace App\Http\Controllers;

use App\Models\Category;
use BotMan\BotMan\BotMan;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use Illuminate\Http\Request;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\Element;
use Illuminate\Support\Facades\Crypt;

class ReferralController extends Controller
{
    protected $category;
    protected $botMan;

    public function __construct()
    {
        $this->botMan = app('botman');
    }

    public function ref($payload)
    {
        $ref = $payload['referral']['ref'];
        $service = strtok($ref, '_');
        if ($service == 'Service') {
            $service_name = substr($ref, strrpos($ref, '_') + 1);
            $this->replyServiceLink($service_name);
        } else {
            $this->replyDirectPayment($ref);
        }

    }

    public function replyDirectPayment($data)
    {
        switch ($data) {
            case 'child':
                $this->category = 11;
                $price = 4500;
                break;
            case 'business':
                $this->category = 267;
                $price = 4500;
                break;
            case 'oneyear':
                $this->category = 10;
                $price = 4500;
                break;
            case 'love' :
                $this->category = 275;
                $price = 4500;
                break;
            case 'other' :
                $this->category = 1111;
                $price = 500;
                break;
        }
        $category_id = Crypt::encrypt($this->category);
        $price = Crypt::encrypt($price);
        $user = Crypt::encrypt($this->botMan->getUser()->getId());
        $this->botMan->reply(GenericTemplate::create()
            ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
            ->addElements([
                Element::create(uni_zaw('ငွေပေးချေမှု', $this->botMan))
                    ->subtitle(uni_zaw($this->getText($data), $this->botMan))
                    ->image('https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/KWAIRTmiIBNktjolJ3Gx1rGooyiKAspKQ1gLaTrJ.jpeg')
                    ->addButton(ElementButton::create(uni_zaw('ငွေပေးမည်', $this->botMan))->url(config('payment.horo_endpoint') . '/horo/manual/payment?price=' . $price . '&user=' . $user . '&category_id=' . $category_id))

            ])
        );

    }

    public function replyServiceLink($service_name)
    {
        if ($service_name == 'Direct') {
            $category_id = Crypt::encrypt(55555);
            $user_id = Crypt::encrypt($this->botMan->getUser()->getId());
            $type = $this->botMan->userStorage()->find($this->botMan->getUser()->getId());
            $this->botMan->reply(GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                ->addElements([
                    Element::create(uni_zaw($this->getServiceName('Direct'), $this->botMan))
                        ->image('https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/Y3et7hLyvcf7bVK1Yju1CbPcRSlA6NGUweKKacpE.jpeg')
                        ->addButton(ElementButton::create(uni_zaw('မေးမည်', $this->botMan))
                            ->url('https://chatbothoro.blueplanet.com.mm/direct/horo?category_id=' . $category_id . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                        )
                ])
            );
        } elseif ($service_name == 'PhoneCall') {
            $category_id = Crypt::encrypt(44444);
            $user_id = Crypt::encrypt($this->botMan->getUser()->getId());
            $type = $this->botMan->userStorage()->find($this->botMan->getUser()->getId());
            $this->botMan->reply(GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                ->addElements([
                    Element::create(uni_zaw($this->getServiceName('PhoneCall'), $this->botMan))
                        ->image('https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/Y3et7hLyvcf7bVK1Yju1CbPcRSlA6NGUweKKacpE.jpeg')
                        ->addButton(ElementButton::create(uni_zaw('မေးမည်', $this->botMan))
                            ->url('https://chatbothoro.blueplanet.com.mm/baydin_sayar/horo?category_id=' . $category_id . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                        )
                ])
            );
        } else {
            $service_name = $this->getServiceName($service_name);
            $category = Category::where('title', 'like', '%' . $service_name . '%')->first();
            $category_id = Crypt::encrypt($category->id);
            $user_id = Crypt::encrypt($this->botMan->getUser()->getId());
            $type = $this->botMan->userStorage()->find($this->botMan->getUser()->getId());
            $this->botMan->reply(GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                ->addElements([
                    Element::create(uni_zaw($category->title, $this->botMan))
                        ->subtitle(uni_zaw($category->subtitle, $this->botMan))
                        ->image('https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/Y3et7hLyvcf7bVK1Yju1CbPcRSlA6NGUweKKacpE.jpeg')
                        ->addButton(ElementButton::create(uni_zaw('မေးမည်', $this->botMan))
                            ->url($category->web_url . '?category_id=' . $category_id . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                        )
                ])
            );
        }

    }

    public function getText($service)
    {
        switch ($service) {
            case 'child':
                $message = 'ရင်သွေးရတနာအမည်ပေး အထူးဟောစာတမ်းအတွက် ဉာဏ်ပူဇော်ခ (၄၅၀၀) ကျပ်ပေးချေမည်။';
                break;
            case 'business':
                $message = 'လုပ်ငန်းအမည်ပေး အထူးဟောစာတမ်းအတွက် ဉာဏ်ပူဇော်ခ (၄၅၀၀) ကျပ်ပေးချေမည်။';
                break;
            case 'oneyear':
                $message = 'တစ်နှစ်တာ အထူးဟောစာတမ်းအတွက် ဉာဏ်ပူဇော်ခ ( ၄၅၀၀ ) ကျပ်ပေးချေမည်။';
                break;
            case 'love' :
                $message = 'ချစ်သူဇာတာခွင်တိုက်ရန် အထူးဟောစာတမ်းအတွက် ဉာဏ်ပူဇော်ခ ( ၄၅၀၀ ) ကျပ်ပေးချေမည်။';
                break;
            case 'other' :
                $message = 'မေးထားသော မေးခွန်းအတွက်ဉာဏ်ပူဇော်ခ (၅၀၀) ကျပ် ပေးချေမည်';
                break;
        }
        return $message;
    }

    public function getServiceName($ref)
    {
        switch ($ref) {
            case 'Oneyear':
                $service = 'တနစ်စာအဟော';
                break;
            case 'Business':
                $service = 'အမည်ပေး(လုပ်ငန်းအမည်)';
                break;
            case 'Baby':
                $service = 'အမည်ပေး(ရင်သွေးအမည်)';
                break;
            case 'Zarta' :
                $service = 'အချစ်ဇာတာဟောစာတမ်း';
                break;
            case 'Direct' :
                $service = 'ဗေဒင်ဆရာနဲ့တိုက်ရိုက်မေးမည်';
                break;
            case 'PhoneCall' :
                $service = 'ဖုန်းခေါ်၍ ဗေဒင်မေးမည်။';

        }
        return $service;
    }
}
