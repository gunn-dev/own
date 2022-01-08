<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPaymentNotify;
use App\Jobs\ReplyMessage;
use App\Jobs\ReplyPamentFailMessage;
use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\Payment;
use App\Models\Rawlog;
use App\Models\Subscription;
use BotMan\BotMan\BotMan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Webpatser\Uuid\Uuid;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $category_id = Crypt::decrypt($request->category_id);
        Category::where('id', $category_id)->increment('click_count', 1);
        $user_id = Crypt::decrypt($request->user_id);

        $category = Category::where('id', $category_id)->first();
        $child_category = Category::where('id', $category->parent_id)->first();
        $main_category = Category::where('id', $child_category->parent_id)->first();
        $parent_category = Category::where('id', $main_category->parent_id)->first();


        if ($this->checkSubscription($main_category, $user_id) == true) {
            ReplyMessage::dispatch($category_id, $user_id);
            $messenger_Id = Config::get('botman.facebook.messenger_id');
            return redirect('http://m.me/' . $messenger_Id);
        }

        return view('payment.index')->with([
            'category' => $parent_category,
            'category_id' => Crypt::encrypt($category_id),
            'user_id' => $request->user_id,
            'lang' => $request->lang
        ]);
    }

    public function payment(Request $request)
    {

        $user_id = Crypt::decrypt($request->user_id);
        $category_id = Crypt::decrypt($request->category_id);

        $order_id = (string)Uuid::generate();
        $category = Category::where('id', $category_id)->first();
        $parent = Category::where('id', $category->parent_id)->first();
        if (isset($parent->parent_id)) {
            $parent = Category::where('id', $parent->parent_id)->first();
            if(isset($parent->parent_id)){
                $parent = Category::where('id', $parent->parent_id)->first();
                $parent_id = $parent->id;
            }
        } else {
            $parent_id = $parent->parent_id;
        }

        $price = $category->price;
        Payment::create([
            'user_id' => $user_id,
            'price' => $price,
            'order_id' => $order_id,
            'category_id' => $category_id,
            'parent_id' => $parent_id,
            'phone_number' => $request->phone_number
        ]);
        return view('payment.payment')->with([
            'price' => $price,
            'order_id' => $order_id,
            'payment_method' => 'normal'
        ]);
    }

    public function notifyPayment(Request $request)
    {
        $raw_logs = Rawlog::create(['raw_log' => json_encode($request->all())]);
        if ($request->status == 'fail') {
            ReplyPamentFailMessage::dispatch($request->all());
            return response()->json([
                'status' => 'fail'
            ]);
        }

        if ($request->status == 'success') {
            ProcessPaymentNotify::dispatch($request->all());
            return response()->json([
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function checkSubscription($category, $user_id)
    {
        $user = Subscription::where('user_id', $user_id)->first();
        $subscription_user_id = $user->id;
        $subscribed = CategorySubscription::where('subscription_id', $subscription_user_id)
            ->where('category_id', $category->id)->first();
        $today = Carbon::today();
        if (isset($subscribed)) {
            if ($subscribed->subscription_period >= $today->toDateString()) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function paymentRedirect(Request $request)
    {
        Rawlog::create(['raw_log' => json_encode($request->all())]);

        try{
            $order = Payment::where('order_id',$request->OrderId)->first();
            if($order->user_id == '3160377440726644'){
                return view('payment.success')->with([
                    'status' => $request->status
                ]);
            }else{
                $messenger_Id = Config::get('botman.facebook.messenger_id');
                return redirect('http://m.me/' . $messenger_Id);
            }

        }catch (\Exception $exception){

            Rawlog::create(['raw_log' => json_encode($request->all())]);
            $messenger_Id = Config::get('botman.facebook.messenger_id');
            return redirect('http://m.me/' . $messenger_Id);

        }


    }

    public function manual(Request $request)
    {
        $user_id = Crypt::decrypt($request->user);
        $category_id = Crypt::decrypt($request->category_id);

        $order_id = (string)Uuid::generate();

        $price = Crypt::decrypt($request->price);
        Payment::create([
            'user_id' => $user_id,
            'price' => $price,
            'order_id' => $order_id,
            'category_id' => $category_id,
            'parent_id' => $category_id,
            'manual' => 1
        ]);
        return view('payment.payment')->with([
            'price' => $price,
            'order_id' => $order_id
        ]);
    }

}
