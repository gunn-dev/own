<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessNamingForm;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Webpatser\Uuid\Uuid;

class BaydinSayarCallController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $lang = $request->lang;
        return view('call_service.index',compact('user_id','lang'));
    }

    public function store(Request $request)
    {
        $order_id = (string)Uuid::generate();
        $request->merge(['order_id' => $order_id]);
        ProcessNamingForm::dispatch($request->all(), 'baydinSayar_call');
        $user_id = Crypt::decrypt($request->user_id);
        $price = 0;
        if($request->call == 'coda'){
            $price = 5000;
        }elseif ($request->call == 'kbz'){
            $price = 4000;
        }
        else{
            $price = 5000;
        }
        Payment::create([
            'user_id' => $user_id,
            'price' => $price,
            'order_id' => $order_id,
            'category_id' => '44444',
            'phone_number' => $request->phone_number
        ]);
        return view('payment.payment')->with([
            'price' => $price,
            'order_id' => $order_id,
            'payment_method' => $request->call
        ]);
    }
}
