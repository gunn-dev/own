<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessNamingForm;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Webpatser\Uuid\Uuid;

class NamingController extends Controller
{
    public function child_index(Request $request)
    {
        $category = Category::where('id',Crypt::decrypt($request->category_id))->first();

        return view('naming.child')->with([
            'lang' => $request->lang,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'price' => $category->price
        ]);

    }

    public function business_index(Request $request)
    {
        $category = Category::where('id',Crypt::decrypt($request->category_id))->first();

        return view('naming.business')->with([
            'lang' => $request->lang,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'price' => $category->price
        ]);

    }

    public function child(Request $request)
    {

        $order_id = (string)Uuid::generate();
        $request->merge(['order_id' => $order_id]);
        ProcessNamingForm::dispatch($request->all(), 'child_namings');
        $category_id = Crypt::decrypt($request->category_id);
        $user_id = Crypt::decrypt($request->user_id);

        $category = Category::where('id', $category_id)->first();

        $parent = Category::where('parent_id', $category->parent_id)->first();

        if($request->payment == 'coda'){
            $price = 6000;
        }elseif ($request->payment == 'kbz'){
            $price = 3600;
        }
        else{
            $price = $category->price;
        }

        Payment::create([
            'user_id' => $user_id,
            'price' => $price,
            'order_id' => $order_id,
            'category_id' => $category_id,
            'parent_id' => $parent->parent_id == '' ? $category_id : $parent->parent_id,
            'phone_number' => $request->phone_number
        ]);
        return view('payment.payment')->with([
            'price' => $price,
            'order_id' => $order_id,
            'payment_method' => $request->payment
        ]);
    }

    public function business(Request $request)
    {

        $order_id = (string)Uuid::generate();
        $request->merge(['order_id' => $order_id]);
        ProcessNamingForm::dispatch($request->all(), 'business_namings');
        $category_id = Crypt::decrypt($request->category_id);
        $user_id = Crypt::decrypt($request->user_id);

        $category = Category::where('id', $category_id)->first();
        $parent = Category::where('parent_id', $category->parent_id)->first();
        if($request->payment == 'coda'){
            $price = 6000;
        }elseif ($request->payment == 'kbz'){
            $price = 3600;
        }
        else{
            $price = $category->price;
        }
        Payment::create([
            'user_id' => $user_id,
            'price' => $price,
            'order_id' => $order_id,
            'category_id' => $category_id,
            'parent_id' => $parent->parent_id == '' ? $category_id : $parent->parent_id,
            'phone_number' => $request->phone_number
        ]);
        return view('payment.payment')->with([
            'price' => $price,
            'order_id' => $order_id,
            'payment_method' => $request->payment
        ]);
    }
}
