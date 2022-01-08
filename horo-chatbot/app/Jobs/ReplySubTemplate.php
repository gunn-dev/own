<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\Subscription;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Crypt;

class ReplySubTemplate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $bot;
    protected $Cat;

    public function __construct($bot, $Cat)
    {
        $this->Cat = $Cat;
        $this->bot = $bot;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $categories = Category::with('childs')->where('parent_id', $this->Cat)->orderBy('sort', 'ASC')->get();
        if ($categories->count() > 0) {

            $count = $categories->count();
            if ($count > 9) { // Template that contain up to 9 Category
                $chunks = $categories->chunk($count / 2);
                $elements = [];
                $i = 0;
                foreach ($chunks as $chunk) {
                    $templates[$i] = $chunk;
                    $i++;
                }
                for ($i = 0; $i < count($templates); $i++) {
                    $this->bot->typesAndWaits(1);
                    $categories = $templates[$i];
                    $elements = [];
                    foreach ($categories as $category) {
                        $category = $this->getElement($category);
                        array_push($elements, $category);
                    }
                    $this->bot->reply(GenericTemplate::create()
                        ->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL)
                        ->addElements(
                            $elements
                        )
                    );
                }
            } else {
                $elements = [];
                foreach ($categories as $category) {
                    $category = $this->getElement($category);
                    array_push($elements, $category);
                }
                $this->bot->reply(GenericTemplate::create()
                    ->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL)
                    ->addElements(
                        $elements
                    )
                );
            }

        }
        Category::where('id', $this->Cat)->increment('click_count', 1);
    }

    public function checkSubscription()
    {
        $user_id = $this->bot->getUser()->getId();
        $today = Carbon::today();
        $subscription_expire_date = Subscription::where('user_id', $user_id)->first();
        $subscription_user_id = $subscription_expire_date->id;
        $category = Category::where('id', $this->Cat)->first();
        $category_id = $this->Cat;

        $subscribed = CategorySubscription::where('subscription_id', $subscription_user_id)
            ->where('category_id', $category_id)->first();

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
        if ($this->checkSubscription() == true) {
            $category = $this->getSubButton($category);
        } else {
            $category = $this->getUnSubButton($category);
        }
        return $category;
    }

    public function getSubButton($category)
    {
        $category_array = $category->toArray();
        $count = count($category_array['childs']);

        switch ($count) {
            case 1:

                $category = Element::create(uni_zaw($category->title, $this->bot))
                    ->subtitle(uni_zaw($category->subtitle, $this->bot))
                    ->image($category->image)
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][0]['title'], $this->bot))
                        ->payload('Content_Deliver__' . $category_array['childs'][0]['id'])
                        ->type('postback')
                    );
                break;
            case 2:

                $category = Element::create(uni_zaw($category->title, $this->bot))
                    ->subtitle(uni_zaw($category->subtitle, $this->bot))
                    ->image($category->image)
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][0]['title'], $this->bot))
                        ->payload('Content_Deliver__' . $category_array['childs'][0]['id'])
                        ->type('postback')
                    )
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][1]['title'], $this->bot))
                        ->payload('Content_Deliver__' . $category_array['childs'][1]['id'])
                        ->type('postback')
                    );
                break;
            case 3:

                $category = Element::create(uni_zaw($category->title, $this->bot))
                    ->subtitle(uni_zaw($category->subtitle, $this->bot))
                    ->image($category->image)
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][0]['title'], $this->bot))
                        ->payload('Content_Deliver__' . $category_array['childs'][0]['id'])
                        ->type('postback')
                    )
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][1]['title'], $this->bot))
                        ->payload('Content_Deliver__' . $category_array['childs'][1]['id'])
                        ->type('postback')
                    )
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][2]['title'], $this->bot))
                        ->payload('Content_Deliver__' . $category_array['childs'][2]['id'])
                        ->type('postback')
                    );
                break;
        }
        return $category;
    }


    public function getUnSubButton($category)
    {
        $category_array = $category->toArray();
        $count = count($category_array['childs']);
        $user_id = Crypt::encrypt($this->bot->getUser()->getId());
        $type = $this->bot->userStorage()->find($this->bot->getUser()->getId());
        switch ($count) {
            case 1:

                $category = Element::create(uni_zaw($category->title, $this->bot))
                    ->subtitle(uni_zaw($category->subtitle, $this->bot))
                    ->image($category->image)
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][0]['title'], $this->bot))
                        ->url(config('payment.horo_subscription_endpoint') . '?category_id=' . Crypt::encrypt($category_array['childs'][0]['id']) . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                    );
                break;
            case 2:

                $category = Element::create(uni_zaw($category->title, $this->bot))
                    ->subtitle(uni_zaw($category->subtitle, $this->bot))
                    ->image($category->image)
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][0]['title'], $this->bot))
                        ->url(config('payment.horo_subscription_endpoint') . '?category_id=' . Crypt::encrypt($category_array['childs'][0]['id']) . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                    )->addButton(ElementButton::create(uni_zaw($category_array['childs'][1]['title'], $this->bot))
                        ->url(config('payment.horo_subscription_endpoint') . '?category_id=' . Crypt::encrypt($category_array['childs'][1]['id']) . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                    );
                break;
            case 3:

                $category = Element::create(uni_zaw($category->title, $this->bot))
                    ->subtitle(uni_zaw($category->subtitle, $this->bot))
                    ->image($category->image)
                    ->addButton(ElementButton::create(uni_zaw($category_array['childs'][0]['title'], $this->bot))
                        ->url(config('payment.horo_subscription_endpoint') . '?category_id=' . Crypt::encrypt($category_array['childs'][0]['id']) . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                    )->addButton(ElementButton::create(uni_zaw($category_array['childs'][1]['title'], $this->bot))
                        ->url(config('payment.horo_subscription_endpoint') . '?category_id=' . Crypt::encrypt($category_array['childs'][1]['id']) . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                    )->addButton(ElementButton::create(uni_zaw($category_array['childs'][2]['title'], $this->bot))
                        ->url(config('payment.horo_subscription_endpoint') . '?category_id=' . Crypt::encrypt($category_array['childs'][2]['id']) . '&lang=' . $type['font_type'] . '&user_id=' . $user_id)
                    );
                break;
        }
        return $category;
    }

}
