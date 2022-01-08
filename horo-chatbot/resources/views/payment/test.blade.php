@extends('layouts.master')

@section('content')
    <p style="">
        <form action="{{ route('payment') }}" method="post">
            <h3>Horo Scope</h3>
            {{--<input type="hidden" name="user_id" value="{{ $user_id }}">--}}
            {{--<input type="hidden" name="category_id" value="{{ $category_id }}">--}}
            @csrf
            <input type="hidden" name="user_id" value="">
            <input type="hidden" name="category_id" value="">

            <label class="form-group">
    <p class="text-center"><input type="text" class="form-control" name="business_type" readonly value="Horo Scope"></p>
    </label>
    <label class="form-group">
        <p class="text-center"><input type="text" class="form-control" name="business_type" readonly value=" 500 ks"></p>
    </label>

    <p>
        {{ getLang('unicode', 'ငွေပေးချေပြီးပါက ကို ၇ ရက်အတွင်းအခမဲ့မေးမြန်းနိုင်ပါသည်။') }}
    </p>
    <p>{{ getLang('unicode', 'KBZ pay, MPT, Telenor, Ooredoo, Mytel ဖြင့်ငွေပေးချေနိုင်ပါသည်။') }}</p>
    <button><h4>Pay
            <i class="zmdi zmdi-arrow-right"></i> </h4>
    </button>
    </form>
    </p>
@endsection