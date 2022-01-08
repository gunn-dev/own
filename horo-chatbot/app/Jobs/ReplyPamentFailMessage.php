<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class ReplyPamentFailMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payment = Payment::select('id', 'user_id', 'price', 'category_id')
            ->where('order_id', $this->request['OrderId'])
            ->where('notify', 0)->first();
        $subscription = Subscription::where('user_id', $payment->user_id)->first();
        $user_id = $subscription->id;
        $arguments = [
            'user_id' => $payment->user_id,
        ];
        Artisan::call('send:payment_fail',  $arguments);
    }
}
