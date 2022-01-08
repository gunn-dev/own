@extends('layouts.master')

@section('content')

    <form id="child-form" action="{{ route('lovebaydin.store') }}" method="post" role="form" style="display: block;">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="category_id" value="{{ $category_id }}">
        @csrf
        <h3 class="mm-font">အချစ်ဇာတာဟောစာတမ်း</h3>
        <p class="mm-font">အောက်ပါပေးထားသော Form အချက်အလက်များကို ဖြည့်ပေးပါ</p>

        <label class="mm-font">အမျိုးသမီး</label>
        <br><br>
        <label class="form-group">
            <input type="text" class="form-control" name="g_name" required>
            <span class="mm-font">အမည်</span>
            <span class="border"></span>
        </label>
        <label class="form-group mm-font">
            <select name="g_birth_day" class="form-control mm-font" required>
                <option value="တနင်္ဂနွေ"> <p class="mm-font">တနင်္ဂနွေ</p></option>
                <option value="တနင်္လာ"> <p class="mm-font">တနင်္လာ</p></option>
                <option value="အင်္ဂါ"> <p class="mm-font">အင်္ဂါ</p></option>
                <option value="ဗုဒ္ဓဟူး"> <p class="mm-font">ဗုဒ္ဓဟူး</p></option>
                <option value="ကြာသပတေး"> <p class="mm-font">ကြာသပတေး</p></option>
                <option value="သောကြာ"> <p class="mm-font">သောကြာ</p></option>
                <option value="စနေ"> <p class="mm-font">စနေ</p></option>
            </select>
            <span class="mm-font">မွေးနေ့</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="g_birth_date" required>
            <span class="mm-font">မွေးသက္ကရာဇ်(7.11.1990)</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="g_address" required>
            <span for="" class="mm-font">နေရပ်လိပ်စာ</span>
            <span class="border"></span>
        </label>

        <p style="font-size: 30px"><i class="fa fa-heart" aria-hidden="true"></i></p>
        <label class="mm-font">အမျိုးသား</label>
        <br><br>
        <label class="form-group">
            <input type="text" class="form-control" name="b_name" required>
            <span class="mm-font">အမည်</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <select name="b_birth_day" class="form-control mm-font" required>
                <option value="တနင်္ဂနွေ" class="mm-font"> <p class="mm-font">တနင်္ဂနွေ</p></option>
                <option value="တနင်္လာ" class="mm-font"> <p class="mm-font">တနင်္လာ</p></option>
                <option value="အင်္ဂါ" class="mm-font"> <p class="mm-font">အင်္ဂါ</p></option>
                <option value="ဗုဒ္ဓဟူး"> <p class="mm-font">ဗုဒ္ဓဟူး</p></option>
                <option value="ကြာသပတေး"> <p class="mm-font">ကြာသပတေး</p></option>
                <option value="သောကြာ"> <p class="mm-font">သောကြာ</p></option>
                <option value="စနေ"> <p class="mm-font">စနေ</p></option>
            </select>
            <span class="mm-font">မွေးနေ့</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="b_birth_date" required>
            <span class="mm-font">မွေးသက္ကရာဇ်(5.12.1990)</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="b_address" required>
            <span for="" class="mm-font">နေရပ်လိပ်စာ</span>
            <span class="border"></span>
        </label>



        <label class="form-group">
            <input type="text" class="form-control" name="phone_number" required>
            <span for="" class="mm-font">ဆက်သွယ်ရမည့်ဖုန်းနံပါတ်</span>
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