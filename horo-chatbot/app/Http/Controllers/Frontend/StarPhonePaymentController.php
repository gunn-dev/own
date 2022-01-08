<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rawlog;
use App\Models\StarPhonePayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;

class StarPhonePaymentController extends Controller
{
    public function payment_index()
    {
        $payments = StarPhonePayment::where('status',1)->paginate(8);
        return view('admin.starphone.payment.index',compact('payments'));
    }
    public function edit($id)
    {
       $payment = StarPhonePayment::where('id', $id)->first();
       $payment = $payment->update([
           'send' => 1
       ]);
       return response()->json('Success');
    }
    public function index(Request $request)
    {
        $type = $request->type;
        if($type == 'ed8f1c54-256a-46c3-89a1-290b649358a7'){

            $baydin_type = 'special';
        }elseif ($type == '8922b63b-0cbb-427e-98a4-e6754c786f9d'){

            $baydin_type = 'direct';
        }
        return view('payment.starphone.index', compact('baydin_type'));
    }

    public function paymentCreate(Request $request)
    {
        if ($request->payment != ''){
            $pay_with = $request->payment;
            if($pay_with == 'coda'){
                $price = 6000;
                $payment_method = 'coda';
            }elseif ($pay_with == 'other'){
                $price = 4500;
                $payment_method = 'other';
            }
            $baydin_type = 'အထူးဟောစာတမ်း';
        }

        elseif ($request->direct != '')
        {
            $pay_with = $request->direct;
            if($pay_with == 'coda'){
                $price = 2000;
                $payment_method = 'coda';
            }elseif ($pay_with == 'other'){
                $price = 1500;
                $payment_method = 'other';
            }
            $baydin_type = 'ဗေဒင်ဆရာတိုက်ရိုက်';
        }

        $order_id = (string)Uuid::generate();

        StarPhonePayment::create([
            'price' => $price,
            'order_id' => $order_id,
            'type' => $baydin_type,
            'phone' => $request->phone_number
        ]);
        return view('payment.payment')->with([
            'price' => $price,
            'order_id' => $order_id,
            'payment_method' =>  $payment_method
        ]);

    }


    public function notifyPayment(Request $request)
    {
        $raw_logs = Rawlog::create(['raw_log' => json_encode($request->all())]);
        if ($request->status == 'fail') {
            return response()->json([
                'status' => 'fail'
            ]);
        }
        if ($request->status == 'success') {

            $payment = StarPhonePayment::select('id', 'price')
                ->where('order_id', $request->OrderId)
                ->where('notify', 0)->first();

            if (isset($payment) && $request->amount == $payment->price) {
                $payment->update(['status' => 1, 'payment_method' => $request->payment_method, 'notify' => 1]);
            }
            return response()->json([
                'status' => 'success'
            ]);
        }
        return response()->json([
            'status' => 'success'
        ]);
    }
}
