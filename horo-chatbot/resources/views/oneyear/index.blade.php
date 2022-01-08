@extends('layouts.master')

@section('content')

    <form id="child-form" action="{{ route('oneyear.store') }}" method="post" role="form" style="display: block;">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="category_id" value="{{ $category_id }}">
        @csrf
        <h3 class="mm-font">တနှစ်တာ အထူးဗေဒင်ဟောစာတမ်း</h3>
        <p class="mm-font">အောက်ပါပေးထားသော Form အချက်အလက်များကို ဖြည့်ပေးပါ</p>
        <label class="form-group">
            <input type="text" class="form-control" name="birth_date" required>
            <span class="mm-font">မွေးနေ့(30.11.2004)</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="birth_time" required>
            <span class="mm-font"> မွေးချိန်</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
        <input type="text" class="form-control" name="name" required>
        <span class="mm-font">အမည်</span>
        <span class="border"></span>
        </label>
        {{--<label class="form-group">--}}
            {{--<input type="text" class="form-control" name="father_name" required>--}}
            {{--<span class="mm-font">ဖခင်အမည်</span>--}}
            {{--<span class="border"></span>--}}
        {{--</label>--}}
        {{--<label class="form-group">--}}
            {{--<input type="text" class="form-control" name="mother_name" required>--}}
            {{--<span class="mm-font"> မိခင်အမည်</span>--}}
            {{--<span class="border"></span>--}}
        {{--</label>--}}
        <label class="form-group">
            <input type="text" class="form-control" name="birth_place" required>
            <span for="" class="mm-font">မွေးရပ်</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="career" required>
            <span for="" class="mm-font">အလုပ်အကိုင်</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="address" required>
            <span for="" class="mm-font">နေရပ်လိပ်စာ (မြို့နယ်)</span>
            <span class="border"></span>
        </label>
        <input type="radio" name="marital_status" value="1" required> <span for="" class="mm-font"> အိမ်ထောင်ရှိ </span>
        <input type="radio" name="marital_status" value="0" required> <span for="" class="mm-font"> အိမ်ထောင်မရှိ </span>
        <br>
        <br>
        {{--<p class="mm-font">မှတ်ချက်။	။ မိမိပေးလိုသော နေ့နံများကိုလည်းပြောပြပေးပါရန်။</p>--}}
        <label class="form-group">
            <input type="text" class="form-control" name="nyih_nan" required>
            <span for="" class="mm-font"> နေ့နံ</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="about" required>
            <span for="" class="mm-font">အဓိကသိချင်သောအကြောင်းအရာ</span>
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