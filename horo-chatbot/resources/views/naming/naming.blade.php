@extends('layouts.master')

@section('content')
    <div class="container">
        <p class="text-center">
            <a href="" id="child-form-link">{{ getLang($lang,'ကလေး') }}</a>
            &nbsp;&nbsp;
            <a href=""  id="business-form-link">{{ getLang($lang,'လုပ်ငန်း') }}</a>
        </p>
    </div>
    <form id="child-form" action="{{ route('child') }}" method="post" role="form" style="display: block;">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="category_id" value="{{ $category_id }}">
        @csrf
        <h3>{{ getLang($lang, 'ကလေး အမည်ပေး') }}</h3>
        <p>{{ getLang($lang, 'အောက်ပါပေးထားသော Form အချက်အလက်များကို ဖြည့်ပေးပါ') }}</p>
        <label class="form-group">
            <input type="text" class="form-control date_picker" name="birth_date" required>
            <span>{{ getLang($lang, 'မွေးနေ့') }}</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="birth_time" required>
            <span>{{ getLang($lang, 'မွေးချိန်') }}</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="father_name" required>
            <span>{{ getLang($lang,'ဖခင်အမည်') }}</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="mother_name" required>
            <span>{{ getLang($lang, 'မိခင်အမည်') }}</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="birth_place" required>
            <span for="">{{ getLang($lang, 'မွေးရပ်') }}</span>
            <span class="border"></span>
        </label>
        <p>{{ getLang($lang, 'မှတ်ချက်။	။ မိမိပေးလိုသော နေ့နံများကိုလည်းပြောပြပေးပါရန်။') }}</p>
        <label class="form-group">
            <input type="text" class="form-control" name="nyih_nan" required>
            <span for="">{{ getLang($lang, 'နေ့နံ') }}</span>
            <span class="border"></span>
        </label>
        <button>{{ getLang($lang,'အတည်ပြုမည်') }}
            <i class="zmdi zmdi-arrow-right"></i>
        </button>
    </form>
    <form action="{{ route('business') }}" method="post" id="business-form" role="form" style="display: none;">
        @csrf
        <h3>{{ getLang($lang, 'လုပ်ငန်း အမည်ပေး') }}</h3>
        <p>{{ getLang($lang, 'အောက်ပါပေးထားသော Form အချက်အလက်များကို ဖြည့်စွပ်ပေးပါ') }}</p>
        <label class="form-group">
            <input type="text" class="form-control" name="owner_name" required>
            <span>{{ getLang($lang,'လုပ်ငန်းရှင်အမည်') }}</span>
            <span class="border"></span>
        </label>
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="category_id" value="{{ $category_id }}">
        <label class="form-group">
            <input type="text" class="form-control date_picker" name="birth_date" required>
            <span>{{ getLang($lang, 'မွေးနေ့') }}</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="business_type" required>
            <span>{{ getLang($lang, 'လုပ်ကိုင်မည့်လုပ်ငန်း') }}</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="address" required>
            <span>{{ getLang($lang, 'လုပ်ငန်းလိပ်စာ') }}</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="phone_number" required>
            <span for="">{{ getLang($lang, 'ဆက်သွယ်ရမည့်ဖုန်းနံပါတ်') }}</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="nyih_tha" required>
            <span for="">{{ getLang($lang, 'နေ့သား(လုပ်ငန်းရှင်)') }}</span>
            <span class="border"></span>
        </label>
        <button>{{ getLang($lang, 'အတည်ပြုမည်') }}
            <i class="zmdi zmdi-arrow-right"></i>
        </button>
    </form>

@endsection