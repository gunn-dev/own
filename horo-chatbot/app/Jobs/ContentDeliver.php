<?php

namespace App\Jobs;

use App\Models\BusinessNaming;
use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\ChildNaming;
use App\Models\Content;
use App\Models\Subscription;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ContentDeliver implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $bot;
    protected $cat;

    public function __construct($bot, $cat)
    {
        $this->bot = $bot;
        $this->cat = $cat;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $category_id = Category::where('id', $this->cat)->first();


        $parent = Category::where('id', $category_id->parent_id)->first();

        if ($this->checkSubscription($parent) == true) {
            if ($category_id->title === 'နေ့စဉ်အဟော') {
                $contents = $this->getDailyContent();
            } elseif ($category_id->title === 'အပတ်စဉ်အဟော') {
                $contents = $this->getWeeklyContent();
            } elseif ($category_id->title === 'လစဉ်အဟော') {
                $contents = $this->getMonthlyContent();
            }

            foreach ($contents as $content) {
                $this->bot->typesAndWaits(1);
                if (isset($content->image)) {
                    $attachment = new Image($content->image, [
                        'custom_payload' => true,
                    ]);
                    $message = OutgoingMessage::create('')
                        ->withAttachment($attachment);
                    $this->bot->reply($message);
                } else {

                    $message = json_decode($content->content);

                    for ($count = 0; $count < count($message); $count++) {
                        $this->bot->reply(uni_zaw($message[$count], $this->bot));
                    }

                }
            }
            $user_id = $this->bot->getUser()->getId();
            $lang = $this->bot->userStorage()->find($user_id);
            $question = Question::create(getLang($lang['font_type'], ' အခြားဗေဒင် မေးချင်ပါသလား?'))
                ->fallback('Menu')
                ->callbackId('Menu')
                ->addButtons([
                    Button::create(getLang($lang['font_type'], 'အခြားမေးမည်'))->value('Category__' . $parent->parent_id),
                    Button::create('Menu')->value('font ' . $lang['font_type']),
                ]);

            $this->bot->reply($question);
        } else {
            $user_id = $this->bot->getUser()->getId();
            $lang = $this->bot->userStorage()->find($user_id);
            TypeandWait::dispatch($this->bot, 1);
            $this->bot->reply(ButtonTemplate::create(uni_zaw('ဝယ်ယူထားသောဗေဒင်ရက် သတ်မှတ်ချိန် ကျော်လွန်သွားပါပြီ။ အသစ်တဖန်ပြန်လည် ရယူရန် အောက်ပါ ခလုတ်ကိုနှိပ်ပေးပါရှင့်', $this->bot))
                ->addButton(ElementButton::create(uni_zaw('ဝယ်မည်', $this->bot))->type('postback')->payload('font ' . $lang['font_type']))
            );
        }
        Category::where('id', $this->cat)->increment('click_count', 1);
    }

    public function checkSubscription($parent)
    {
        $user_id = $this->bot->getUser()->getId();
        $today = Carbon::today();
        $subscription_expire_date = Subscription::where('user_id', $user_id)->first();
        $subscription_user_id = $subscription_expire_date->id;

        $subscribed = CategorySubscription::where('subscription_id', $subscription_user_id)
            ->where('category_id', $parent->parent_id)->first();

        if (isset($subscribed)) {
            if ($subscribed->subscription_period >= $today->toDateString()) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getDailyContent()
    {
        $today = Carbon::today();
        $for_date = $today->toDateString();
        $contents = Content::where('category_id', $this->cat)->where('for_date', $for_date)->orderBy('sequence', 'ASC')->get();
        return $contents;
    }

    public function getWeeklyContent()
    {

        $date = Carbon::today();
        $day_name = $date->format('l');

        if ($day_name == 'Monday') {
            $start_date = $date->toDateString();
            $end_date = $date->addDays(6);
            $end_date = $end_date->toDateString();
        } elseif ($day_name == 'Sunday') {
            $end_date = $date->toDateString();
            $start_date = $date->subDays(6);
            $start_date = $start_date->toDateString();

        } else {

            $ts = strtotime($date->toDateString());
            $start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
            $start_date = date('Y-m-d', $start);
            $end_date = date('Y-m-d', strtotime('next sunday', $start));
        }
        $contents = Content::where('category_id', $this->cat)->where('start_date', $start_date)->where('end_date', $end_date)->orderBy('sequence', 'ASC')->get();
        return $contents;
    }

    public function getMonthlyContent()
    {
        $today = Carbon::today();
        $for_month = $today->format('m');
        $contents = Content::where('category_id', $this->cat)->where('for_month', $for_month)->orderBy('sequence', 'ASC')->get();
        return $contents;
    }


}
