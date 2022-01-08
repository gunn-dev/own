@extends('layouts.master')

@section('content')

    <form action="{{ route('payment.create') }}" method="post">
        <h3 class="mm-font">ငွေပေးချေမှု</h3>
        {{--<input type="hidden" name="user_id" value="{{ $user_id }}">--}}
        {{--<input type="hidden" name="category_id" value="{{ $category_id }}">--}}
        @csrf

        <label class="form-group">
            <input type="text" class="form-control" style="border-bottom: 2px solid #1c94c4;" name="phone_number" required>
            <span class="mm-font"> ဖောင်တွင်ဖြည့်ထားသော ဖုန်းနံပါတ်ထည့်ရန်် </span>
            <span class="border"></span>
        </label>

        @if($baydin_type == 'special')
        <input type="radio" name="payment" value="coda" required> <span for="" class="mm-font">ဖုန်းဘေလ်ဖြင့်ပေးချေမည်</span>
        <input type="radio" name="payment" value="other" required> <span for="" class="mm-font">အခြား Pay ဖြင့်ပေးချေမည်</span>
        <br><br>
        @elseif($baydin_type == 'direct')
            <input type="radio" name="direct" value="coda" required> <span for="" class="mm-font">ဖုန်းဘေလ်ဖြင့်ပေးချေမည်</span>
            <input type="radio" name="direct" value="other" required> <span for="" class="mm-font">အခြား Pay ဖြင့်ပေးချေမည်</span>
            <br><br>@endif
        <p class="mm-font" id="payment">
        <p class="mm-font">{{  'KBZPay, MPT, Telenor, Ooredoo, Mytel, WavePay ဖြင့်ငွေပေးချေနိုင်ပါသည်။' }}</p>



        <button><h4 class="mm-font">
                ငွေပေးမည်
                <i class="zmdi zmdi-arrow-right"></i>
            </h4>
        </button>
    </form>

@endsection