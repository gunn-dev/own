<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessNamingForm;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Webpatser\Uuid\Uuid;

class DirectBaydinController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $lang = $request->lang;
        return view('directbaydin.index',compact('user_id','lang'));
    }

    public function store(Request $request)
    {
        $order_id = (string)Uuid::generate();
        $request->merge(['order_id' => $order_id]);
        ProcessNamingForm::dispatch($request->all(), 'directbaydin');
        $user_id = Crypt::decrypt($request->user_id);
        $price = 0;
        if($request->payment == 'coda'){
            $amount = 2000;
        }elseif ($request->payment == 'kbz'){
            $amount = 1200;
        }
        else{
            $amount = 1500;
        }
        $services = $request->services;
        foreach ($services as $service){
            $price += $amount;
        }

        Payment::create([
            'user_id' => $user_id,
            'price' => $price,
            'order_id' => $order_id,
            'category_id' => '55555',
            'phone_number' => $request->phone_number
        ]);
        return view('payment.payment')->with([
            'price' => $price,
            'order_id' => $order_id,
            'payment_method' => $request->payment
        ]);
    }
}
