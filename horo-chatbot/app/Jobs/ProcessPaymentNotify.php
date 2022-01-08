<?php

namespace App\Jobs;

use App\Models\BusinessNaming;
use App\Models\CallService;
use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\ChildNaming;
use App\Models\DirectBaydin;
use App\Models\LoveBayDin;
use App\Models\OneYear;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class ProcessPaymentNotify implements ShouldQueue
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
        $payment = Payment::select('id', 'user_id', 'price', 'category_id','manual')
            ->where('order_id', $this->request['OrderId'])
            ->where('notify', 0)->first();
        if($payment->category_id == 55555){
            if (isset($payment) && $this->request['amount'] == $payment->price) {
                $payment->update(['status' => 1, 'payment_method' => $this->request['payment_method'], 'notify' => 1]);
                $arguments = [
                    'user_id' => $payment->user_id,
                ];
                $model = DirectBaydin::where('order_id', $this->request['OrderId'])->first();
                $model->update([
                    'payment_status' => 1
                ]);
                Artisan::call('payment_direct:send_message', $arguments);
            }

        }
        if($payment->category_id == 44444){
            if (isset($payment) && $this->request['amount'] == $payment->price) {
                $payment->update(['status' => 1, 'payment_method' => $this->request['payment_method'], 'notify' => 1]);
                $arguments = [
                    'user_id' => $payment->user_id,
                ];
                $model = CallService::where('order_id', $this->request['OrderId'])->first();
                $model->update([
                    'payment_status' => 1
                ]);
                Artisan::call('baydin_sayar:send_message', $arguments);
            }

        }
        if ($payment->manual == 1) {
            if (isset($payment) && $this->request['amount'] == $payment->price) {
                $payment->update(['status' => 1, 'payment_method' => $this->request['payment_method'], 'notify' => 1]);
                $arguments = [
                    'user_id' => $payment->user_id,
                ];
                Artisan::call('payment_direct:send_message', $arguments);
            }

        } else {
            if (isset($payment) && $this->request['amount'] == $payment->price) {

                $category = Category::where('id', $payment->category_id)->first();

                if ($category->web_url == 'NULL' || $category->web_url == NULL) {
                } else {

                    switch ($category->url_type) {
                        case "year":
                            $model = OneYear::where('order_id', $this->request['OrderId'])->first();
                            break;
                        case "child":
                            $model = ChildNaming::where('order_id', $this->request['OrderId'])->first();
                            break;
                        case "business":
                            $model = BusinessNaming::where('order_id', $this->request['OrderId'])->first();
                            break;
                        case "lovebaydin":
                            $model = LoveBayDin::where('order_id', $this->request['OrderId'])->first();
                            break;

                    }

                    if ($model) {
                        $model->update([
                            'payment_status' => 1
                        ]);
                    }
                    $notice = 'cotent-deliver-after-2-days';
                }

                if (isset($category->parent_id)) {
                    $parent_id = $category->parent_id;
                } else {
                    $parent_id = $payment->category_id;
                }
                $category_parent_id = Category::where('id', $parent_id)->first();

                if (isset($category_parent_id->parent_id)) {
                    $parent_id = $category_parent_id->parent_id;
                }
                $today = Carbon::today();
                $subscription_period = $today->addDays(7)->toDateString();
                $subscription = Subscription::where('user_id', $payment->user_id)->first();
                $user_id = $subscription->id;

                $categories = Category::where('parent_id', NULL)->where('url_type', NULL)->get();
                foreach ($categories as $category) {
                    $parent_id = Category::where('parent_id', $category->id)->first();
                    $subscribed = CategorySubscription::where('category_id', $parent_id->id)->where('subscription_id', $user_id)->first();
                    if (isset($subscribed)) {
                        $subscribed->update([
                            'subscription_period' => $subscription_period]);
                    } else {
                        CategorySubscription::create([
                            'category_id' => $parent_id->id,
                            'subscription_id' => $user_id,
                            'subscription_period' => $subscription_period]);
                    }
                }


                $payment->update(['status' => 1, 'payment_method' => $this->request['payment_method'], 'notify' => 1]);
                $arguments = [
                    'user_id' => $payment->user_id,
                    'parent_id' => $parent_id,
                    'child_id' => $payment->category_id,
                ];
                if (isset($notice)) {
                    $arguments['notice'] = 1;
                } else {
                    $arguments['notice'] = 0;
                }
                Artisan::call('payment_complete:send_message', $arguments);
            }
        }

    }
}
