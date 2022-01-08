<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Content;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\FacebookDriver;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReplyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:message {category_id} {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

            $lang = $bot->userStorage()->find($this->argument('user_id'));

            $category = Category::where('id', $this->argument('category_id'))->first();
            if ($category->title === 'နေ့စဉ်အဟော') {
                $contents = $this->getDailyContent();
            } elseif ($category->title === 'အပတ်စဉ်အဟော') {
                $contents = $this->getWeeklyContent();
            } elseif ($category->title === 'လစဉ်အဟော') {
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
                    }else{
                        $message = json_decode($content->content);

                        for ($count = 0; $count < count($message); $count++) {
                            $bot->say(getLang($lang['font_type'], $message[$count]), $this->argument('user_id'), FacebookDriver::class);
                        }

                    }

                }
                $parent_id = Category::where('id', $this->argument('category_id'))->first();
                $g_parent = Category::where('id', $parent_id->parent_id)->first();
            $question = Question::create(getLang($lang['font_type'], ' အခြားဗေဒင် မေးချင်ပါသလား?'))
                ->fallback('Menu')
                ->callbackId('Menu')
                ->addButtons([
                    Button::create(getLang($lang['font_type'], 'အခြားမေးမည်'))->value('Category__' . $g_parent->parent_id),
                    Button::create('Menu')->value('font ' . $lang['font_type']),
                ]);

            $bot->say($question, $this->argument('user_id'), FacebookDriver::class);

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
        $contents = Content::where('category_id', $this->argument('category_id'))->where('for_date', $for_date)->orderBy('sequence', 'ASC')->get();
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
        $contents = Content::where('category_id', $this->argument('category_id'))->where('start_date', $start_date)->where('end_date', $end_date)->orderBy('sequence', 'ASC')->get();
        return $contents;
    }

    public function getMonthlyContent()
    {
        $today = Carbon::today();
        $for_month = $today->format('m');
        $contents = Content::where('category_id', $this->argument('category_id'))->where('for_month', $for_month)->orderBy('sequence', 'ASC')->get();
        return $contents;
    }

}
