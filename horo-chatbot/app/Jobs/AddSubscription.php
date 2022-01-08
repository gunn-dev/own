<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Subscription;

class AddSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
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
        $today = Carbon::today();
        $user_id = $this->bot->getUser()->getId();
        $name = $this->bot->getUser()->getFirstName().' '.$this->bot->getUser()->getLastName();
        $subscription = Subscription::where('user_id', $user_id)->first();
        if(! isset($subscription->user_id)){
            Subscription::create([
                'user_id' => $user_id,
                'name' => $name
            ]);
        }else{
            $subscription->update([
                'name' => $name
            ]);
        }
    }
}
