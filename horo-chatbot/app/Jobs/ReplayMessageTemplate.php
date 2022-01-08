<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use Illuminate\Support\Facades\Crypt;

class ReplayMessageTemplate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $bot;
    protected $service;

    public function __construct($bot, $service)
    {
        $this->bot = $bot;
        $this->service = $service;
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

        $this->bot->reply(uni_zaw('မိမိကြိုက်နှစ်သက်ရာ ဗေဒင်အခန်းကဏ္ဍ ကို ရွေးချယ်ပေးပါ', $this->bot));

        TypeandWait::dispatch($this->bot, 1);

        if($this->service == 'zartar'){
            $categories = Category::with('childs')->where('parent_id', NULL)->where('web_url','!=', NULL)->orderBy('sort', 'ASC')->get();
        }else{
            $categories = Category::with('childs')->where('parent_id', NULL)->where('web_url','=', NULL)->orderBy('sort', 'ASC')->get();
        }

        if ($categories->count() > 0) {

            $count = $categories->count();
            if ($count > 9) {
                $this->replyMessageTemplates($categories, $count);
            } else {
                $this->replyMessageTemplate($categories);
            }
        }
//        $this->bot->say('Message', $this->bot->getUser()->getId());
    }

    public function checkSubscription($category)
    {
        $user_id = $this->bot->getUser()->getId();
        $today = Carbon::today();
        $subscription_expire_date = Subscription::where('user_id', $user_id)->first();
        $subscription_user_id = $subscription_expire_date->id;

        $subscribed = CategorySubscription::where('subscription_id', $subscription_user_id)
            ->where('category_id', $category->id)->first();

        if (isset($subscribed)) {
            if ($subscribed->subscription_period >= $today->toDateString()) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getElement($category)
    {

        $category_id = Crypt::encrypt($category->id);
        $user_id = Crypt::encrypt($this->bot->getUser()->getId());
        $type = $this->bot->userStorage()->find($this->bot->getUser()->getId());
        $category = Element::create(uni_zaw($category->title, $this->bot))
            ->subtitle(uni_zaw($category->subtitle, $this->bot))
            ->image($category->image)
            ->addButton(ElementButton::create(uni_zaw('မေးမည်', $this->bot))
                ->url($category->web_url . '?category_id=' . $category_id . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
            );

        return $category;
    }

    public function getElementwithButton($category)
    {
        $category_array = $category->toArray();

        if (isset($category->url_type)) {
            $category_id = Crypt::encrypt($category->id);
            $user_id = Crypt::encrypt($this->bot->getUser()->getId());
            $type = $this->bot->userStorage()->find($this->bot->getUser()->getId());

            $category = Element::create(uni_zaw($category->title, $this->bot))
                ->subtitle(uni_zaw($category->subtitle, $this->bot))
                ->image($category->image)
                ->addButton(ElementButton::create(uni_zaw($category_array['childs'][0]['title'], $this->bot))
                    ->url($category_array['childs'][0]['web_url'] . '?category_id=' . Crypt::encrypt($category_array['childs'][0]['id']) . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                )->addButton(ElementButton::create(uni_zaw($category_array['childs'][1]['title'], $this->bot))
                    ->url($category_array['childs'][1]['web_url'] . '?category_id=' . Crypt::encrypt($category_array['childs'][1]['id']) . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                );
        } else {
            $category = Element::create(uni_zaw($category->title, $this->bot))
                ->subtitle(uni_zaw($category->subtitle, $this->bot))
                ->image($category->image)
                ->addButton(ElementButton::create(uni_zaw($category_array['childs'][0]['title'], $this->bot))
                    ->payload('Category__' . $category_array['childs'][0]['id'])
                    ->type('postback')
                );
        }

        return $category;
    }

    public function replyMessageTemplates($data, $count)
    {
        $chunks = $data->chunk($count / 2);
        $templates = [];
        $i = 0;
        foreach ($chunks as $chunk) {
            $templates[$i] = $chunk;
            $i++;
        }
        for ($i = 0; $i < count($templates); $i++) {
            $elements = [];
            $categories = $templates[$i];
            foreach ($categories as $category) {
                if (isset($category->web_url)) {
                    $category = $this->getElement($category);
                } else {
                    $category = $this->getElementwithButton($category);
                }
                array_push($elements, $category);
            }
            $this->bot->reply(GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                ->addElements(
                    $elements
                )
            );
        }
    }

    public function replyMessageTemplate($categories)
    {
        $elements = [];
        foreach ($categories as $category) {
            if (isset($category->web_url)) {
                $category = $this->getElement($category);
            } else {
                $category = $this->getElementwithButton($category);
            }
            array_push($elements, $category);
        }
        $this->bot->reply(GenericTemplate::create()
            ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
            ->addElements(
                $elements
            )
        );
    }
}
