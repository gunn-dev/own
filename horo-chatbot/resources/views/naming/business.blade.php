@extends('layouts.master')

@section('content')


        <form action="{{ route('business') }}" method="post" id="business-form" role="form">
            @csrf
            <h3 class="mm-font">လုပ်ငန်း အမည်ပေး</h3>
    <p class="mm-font"> အောက်ပါပေးထားသော Form အချက်အလက်များကို ဖြည့်ပေးပါ</p>
    <label class="form-group">
        <input type="text" class="form-control" name="owner_name" required>
        <span class="mm-font">လုပ်ငန်းရှင်အမည်</span>
        <span class="border"></span>
    </label>
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    <input type="hidden" name="category_id" value="{{ $category_id }}">
    <label class="form-group">
        <input type="text" class="form-control" name="birth_date" required>
        <span class="mm-font"> မွေးနေ့ (30.11.2004)</span>
        <span class="border"></span>
    </label>
    <label class="form-group">
        <input type="text" class="form-control" name="business_type" required>
        <span class="mm-font">လုပ်ကိုင်မည့်လုပ်ငန်း</span>
        <span class="border"></span>
    </label>
    <label class="form-group">
        <input type="text" class="form-control" name="address" required>
        <span class="mm-font">လုပ်ငန်းလိပ်စာ</span>
        <span class="border"></span>
    </label>
    <label class="form-group">
        <input type="text" class="form-control" name="phone_number" required>
        <span for="" class="mm-font" >ဆက်သွယ်ရမည့်ဖုန်းနံပါတ်</span>
        <span class="border"></span>
    </label>
    <label class="form-group">
        <input type="text" class="form-control" name="nyih_tha" required>
        <span for="" class="mm-font">နေ့သား(လုပ်ငန်းရှင်)</span>
        <span class="border"></span>
    </label>
            <input type="radio" name="payment" value="kbz" required> <span for="" class="mm-font">20% Discount with KBZPay  &nbsp;&nbsp;</span>
            <input type="radio" name="payment" value="coda" required> <span for="" class="mm-font">With Phone Bill  &nbsp;&nbsp;</span>
            <input type="radio" name="payment" value="other" required> <span for="" class="mm-font">Other Pay</span>
            <br><br>
            <p class="mm-font" id="payment">
            </p>
            <p class="mm-font">{{  'KBZPay, MPT, Telenor, Ooredoo, Mytel, WavePay ဖြင့် ဉာဏ်ပူဇော် ပေးချေနိုင်ပါသည်။' }}</p>
    <button><h4 class="mm-font">
            အတည်ပြုမည်
            <i class="zmdi zmdi-arrow-right"></i>
        </h4>
    </button>
    </form>



@endsection