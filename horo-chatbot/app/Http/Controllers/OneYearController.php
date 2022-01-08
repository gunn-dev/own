<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessNamingForm;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Webpatser\Uuid\Uuid;


class OneYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::where('id',Crypt::decrypt($request->category_id))->first();
        return view('oneyear.index')->with([
            'lang' => $request->lang,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'price' => $category->price
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_id = (string)Uuid::generate();
        $request->merge(['order_id' => $order_id]);
        ProcessNamingForm::dispatch($request->all(), 'one_years');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
