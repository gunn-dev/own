<?php

namespace App\Http\Controllers;

use App\Jobs\ReplySubTemplate;
use App\Jobs\TypeandWait;
use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\Error;
use App\Models\Promotion;
use App\Models\Subscription;
use BotMan\BotMan\BotMan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BotmanSubTemplateController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    public function subTemplate(BotMan $bot, $id)
    {
        $user_id = $bot->getUser()->getId();
        Error::create(['error' => json_encode($id. '--'.$user_id)]);
        $json_encode = json_encode($id);
        $json_decode = json_decode($json_encode);
        $n = substr($json_decode, 6, 3);
        if($n == 252)
        {
            $id = 252;
        }
        if($n == 293)
        {
            $id = 293;
        }
        $category = Category::where('id', $id)->first();

        $promotion = Promotion::where('category_id', $category->parent_id)->where('status', 1)->first();

        $today = Carbon::today();

        if (isset($promotion)) {

            $subscription_id = Subscription::where('user_id', $user_id)->first();
            $subscribed = CategorySubscription::where('subscription_id', $subscription_id->id)->where('category_id', $id)->first();
            if (!$subscribed) {
                $period = Carbon::today();
                $period = $period->addDays($promotion->promotion_period);
                TypeandWait::dispatch($bot, 1);
                $bot->reply(uni_zaw('အခမဲ့ Promotion အစီအစဉ်သည်  ' . $period->toDateString() . ' ထိသာဖြစ်ပါသည်။', $bot));
                CategorySubscription::create(['category_id' => $id, 'subscription_id' => $subscription_id->id, 'subscription_period' => $period]);
                $promotion_categories = Promotion::where('status', 1)->where('category_id','!=', $category->parent_id)->get();

                //set to subscribed for all categories promotion free
                foreach ($promotion_categories as $promotion_category){
                    $cat = Category::where('parent_id', $promotion_category->category_id)->first();
                    CategorySubscription::create(['category_id' => $cat->id, 'subscription_id' => $subscription_id->id, 'subscription_period' => $period]);
                }

            }
// else {
//                TypeandWait::dispatch($bot, 1);
//                if ($subscribed->subscription_period >= $today->toDateString()) {
//                    $bot->reply(uni_zaw('အခမဲ့ Promotion အစီအစဉ်သည်  ' . $subscribed->subscription_period . ' တွင် ကုန်ဆုံးပါမည်။', $bot));
//                } else {
//                    $bot->reply(uni_zaw('အခမဲ့ Promotions အစီအစဉ်သည်  ' . $subscribed->subscription_period . 'တွင် ကုန်ဆုံးသွားပါပြီ။', $bot));
//
//                }
//
//            }

        } else {

        }

        ReplySubTemplate::dispatch($bot, $id);
    }
}
