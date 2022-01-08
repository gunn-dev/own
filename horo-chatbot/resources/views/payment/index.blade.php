@extends('layouts.master')

@section('content')

        <form action="{{ route('payment') }}" method="post">
            <h3 class="mm-font">ငွေပေးချေမှု</h3>
            {{--<input type="hidden" name="user_id" value="{{ $user_id }}">--}}
            {{--<input type="hidden" name="category_id" value="{{ $category_id }}">--}}
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="category_id" value="{{ $category_id }}">

            <label class="form-group">
    <p class="text-center"><input type="text" class="form-control mm-font" name="business_type" readonly
                                  value="{{  $category->title }}"></p>
    </label>
    <label class="form-group">
        <p class="text-center"><input type="text" class="form-control mm-font" name="business_type" readonly
                                      value="{{ $category->price }} ks"></p>
    </label>

    <p class="mm-font">
        ငွေပေးချေပြီးပါက ဂဏန်းဗေဒင် ၊ အချစ်ဗေဒင် ၊ ရက်သားဗေဒင်အဟောတို့ကို  စတင်မေးမြန်းနိုင်ပြီဖြစ်ပါတယ်။ ဗေဒင်အဟောများ မေးမြန်းနိုင်သောကာလမှာ (၇) ရက်ဖြစ်ပါတယ်။
    </p>
    <p class="mm-font">{{  'KBZPay, MPT, Telenor, Ooredoo, Mytel, WavePay ဖြင့် ဉာဏ်ပူဇော် ပေးချေနိုင်ပါသည်။' }}</p>

            <label class="form-group">
                <input type="text" class="form-control" style="border-bottom: 2px solid #1c94c4;" name="phone_number" required>
                <span class="mm-font"> ဆက်သွယ်ရန်ဖုန်းနံပါတ် </span>
                <span class="border"></span>
            </label>

    <button><h4 class="mm-font">
             ငွေပေးမည်
            <i class="zmdi zmdi-arrow-right"></i>
        </h4>
    </button>
    </form>

@endsection