<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Content;
use App\Models\Rawlog;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\Drivers\Facebook\FacebookDriver;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReplyPaymentCompleteMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment_complete:send_message {user_id} {parent_id} {child_id} {notice}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Message To user if Payment is completed';

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

            $notice = $this->argument('notice');
            $child_id = $this->argument('child_id');

            $lang = $bot->userStorage()->find($this->argument('user_id'));

            $category = Category::where('id', $this->argument('parent_id'))->first();


//
//            $message = '';
//
//            $bot->say(getLang($lang['font_type'], $payment_success_message), $this->argument('user_id'), FacebookDriver::class);

            if ($notice == 1) {
                $bot->say(getLang($lang['font_type'], 'ငွေပေးချေမှုအောင်မြင်ပါသည်။
မေးမြန်းထားသည့် အထူးဟောစာတမ်းများကို လူကြီးမင်းထံ နှစ်ရက်အတွင်းပြန်လည်ပို့ပေးသွားပါမည်။ မေးမြန်းမှုအတွက်ကျေးဇူးတင်ပါတယ်ရှင့်။'), $this->argument('user_id'), FacebookDriver::class);
//                $sub_cat_id = Category::where('id', $this->argument('child_id'))->first();
//                $question = Question::create(getLang($lang['font_type'], ' အခြားဗေဒင် မေးချင်ပါသလား?'))
//                    ->fallback('Menu')
//                    ->callbackId('Menu')
//                    ->addButtons([
//                        Button::create(getLang($lang['font_type'], 'အခြားမေးမည်'))->value('font ' . $lang['font_type']),
//                    ]);
//
//                $bot->say($question, $this->argument('user_id'), FacebookDriver::class);
            } else {
                $payment_success_message = 'ငွေပေးချေမှုအောင်မြင်ပါသည်။ (၇) ရက်သားသမီးများ၏ ဗေဒင်အဟောများအား စတင်ကြည့်ရှုနိုင်ပြီဖြစ်ပါတယ်။ မေးမြန်းမှုအတွက်ကျေးဇူးတင်ပါတယ်ရှင့်။';

                $bot->say(getLang($lang['font_type'], $payment_success_message), $this->argument('user_id'), FacebookDriver::class);
//
                $category_id = Category::where('id', $this->argument('child_id'))->first();
                if ($category_id->title === 'နေ့စဉ်အဟော') {
                    $contents = $this->getDailyContent();
                } elseif ($category_id->title === 'အပတ်စဉ်အဟော') {
                    $contents = $this->getWeeklyContent();
                } elseif ($category_id->title === 'လစဉ်အဟော') {
                    $contents = $this->getMonthlyContent();
                }
                foreach ($contents as $content) {
                    $bot->typesAndWaits(1);
                    if (isset($content->image)) {
                        $attachment = new Image($content->image, [
                            'custom_payload' => true,
                        ]);
                        $message = OutgoingMessage::create('')
                            ->withAttachment($attachment);
                        $bot->say($message, $this->argument('user_id'), FacebookDriver::class);
                    } else {
                        $message = json_decode($content->content);

                        for ($count = 0; $count < count($message); $count++) {
                            $bot->say(getLang($lang['font_type'], $message[$count]), $this->argument('user_id'), FacebookDriver::class);
                        }

                    }

                }

                $question = Question::create(getLang($lang['font_type'], ' အခြားဗေဒင် မေးချင်ပါသလား?'))
                    ->fallback('Menu')
                    ->callbackId('Menu')
                    ->addButtons([
                        Button::create(getLang($lang['font_type'], 'အခြားမေးမည်'))->value('Category__' . $this->argument('parent_id')),
                        Button::create('Menu')->value('font ' . $lang['font_type']),
                    ]);

                $bot->say($question, $this->argument('user_id'), FacebookDriver::class);
            }


        } catch (\Exception $e) {
            $this->info('FAIL sending message to ' . $this->argument('user_id'));
            $this->info($e->getCode() . ': ' . $e->getMessage());
        }

        $this->info('Success.');
    }

    public function getDailyContent()
    {
        $today = Carbon::today();
        $for_date = $today->toDateString();
        $contents = Content::where('category_id', $this->argument('child_id'))->where('for_date', $for_date)->orderBy('sequence', 'ASC')->get();
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
        $contents = Content::where('category_id', $this->argument('child_id'))->where('start_date', $start_date)->where('end_date', $end_date)->orderBy('sequence', 'ASC')->get();
        return $contents;
    }

    public function getMonthlyContent()
    {
        $today = Carbon::today();
        $for_month = $today->format('m');
        $contents = Content::where('category_id', $this->argument('child_id'))->where('for_month', $for_month)->orderBy('sequence', 'ASC')->get();
        return $contents;
    }
}
