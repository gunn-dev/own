@extends('layouts.master')

@section('content')

    <form id="child-form" action="{{ route('directbaydin.store') }}" method="post" role="form" style="display: block;">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        {{--<input type="hidden" name="category_id" value="{{ $category_id }}">--}}
        @csrf
{{--        <h3 class="mm-font">တနှစ်တာ အထူးဗေဒင်ဟောစာတမ်း</h3>--}}
        <p class="mm-font">အောက်ပါပေးထားသော Form အချက်အလက်များကို ဖြည့်ပေးပါ</p>
        <label class="form-group">
            <input type="text" class="form-control" name="name" required>
            <span class="mm-font">အမည်</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="birth_date" required>
            <span class="mm-font">မွေးသက္ကရာဇ်</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="nyih_nan" required>
            <span class="mm-font">နေ့နံ</span>
            <span class="border"></span>
        </label>
        <input type="radio" name="marital_status" value="Yes" required> <span for="" class="mm-font"> အိမ်ထောင်ရှိ </span>
        <input type="radio" name="marital_status" value="No" required> <span for="" class="mm-font"> အိမ်ထောင်မရှိ </span>
        <br>
        <br>
        <label class="form-group">
            <input type="text" class="form-control" name="address" required>
            <span for="" class="mm-font">နေထိုင်သည့်မြို့</span>
            <span class="border"></span>
        </label>
        <input type="radio" name="gender" value="ကျား" required> <span for="" class="mm-font">ကျား</span>
        <input type="radio" name="gender" value="မ" required> <span for="" class="mm-font"> မ </span>
        <br>
        <br>
        <br>
        <br>
        <label class="form-group">
            <select name="baydin_sayar" class="form-control mm-font" required>
                <option value=" " class="mm-font"> <p class="mm-font">ဗေဒင်ဆရာ ရွေးချယ်ပါ...</p></option>
                <option value="ဆရာမ သန့်ထားဆု" class="mm-font"> <p class="mm-font">ဆရာမ သန့်ထားဆု</p></option>
                <option value="ဆရာ မင်းသုကျော်ခေါင်" class="mm-font"> <p class="mm-font">ဆရာ မင်းသုကျော်ခေါင်</p></option>
                <option value="ဆရာ ကျော်ဇောဟန်"> <p class="mm-font">ဆရာ ကျော်ဇောဟန်</p></option>
                <option value="ဆရာ မင်းသိမ်းခိုင်"> <p class="mm-font">ဆရာ မင်းသိမ်းခိုင်</p></option>
                <option value="ဆရာမ စောလှနွယ်နီ"> <p class="mm-font">ဆရာမ စောလှနွယ်နီ</p></option>
                <option value="ဆရာ မိုးမင်းသုခ"> <p class="mm-font">ဆရာ မိုးမင်းသုခ</p></option>
                <option value="ဆရာမ စောယုထွေး"> <p class="mm-font">ဆရာမ စောယုထွေး</p></option>
                <option value="ဆရာမ ယွန်းပိုးအိ"> <p class="mm-font">ဆရာမ ယွန်းပိုးအိ</p></option>
                <option value="ဆရာမ ဝင့်ယမုံဦး"> <p class="mm-font">ဆရာမ ဝင့်ယမုံဦး</p></option>
            </select>
            <span class="mm-font">ဗေဒင်ဆရာ</span>
            <span class="border"></span>
        </label>
        <label class="form-group">
            <input type="text" class="form-control" name="phone_number" required>
            <span for="" class="mm-font">ဆက်သွယ်ရမည့်ဖုန်းနံပါတ်</span>
            <span class="border"></span>
        </label>
        <input type="radio" name="payment" value="kbz" class="radiobutton" required> <span for="" class="mm-font">20% Discount with KBZPay  &nbsp;&nbsp;</span>
        <input type="radio" name="payment" class="radiobutton" value="coda" required> <span for="" class="mm-font">With Phone Bill  &nbsp;&nbsp;</span>
        <input type="radio" name="payment" class="radiobutton" value="other" required> <span for="" class="mm-font">Other Pay</span>
        <br>
        <br>
        <br>
        <p class="mm-font">မေးလိုသောဗေဒင်များကို အမှန်ခြစ်ပေးပါ။</p>

        <div class="container options">
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="အချစ်ရေး" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">အချစ်ရေး</span>
            </label>
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="အိမ်ထောင်ရေး" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">အိမ်ထောင်ရေး</span>
            </label>
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="ကိုယ်ပိုင်စီးပွားရေး" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">ကိုယ်ပိုင်စီးပွားရေး</span>
            </label>
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="အလုပ်အကိုင်" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">အလုပ်အကိုင်</span>
            </label>
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="ပညာရေး" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">ပညာရေး</span>
            </label>
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="ကျန်းမာရေး" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">ကျန်းမာရေး</span>
            </label>
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="ငွေရေးကြေးရေး" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">ငွေရေးကြေးရေး</span>
            </label>
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="လူမှုရေးအထွေထွေ" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">လူမှုရေးအထွေထွေ</span>
            </label>
            <label class="form-check-label customcheck">
                <input class="form-check-input" type="checkbox" value="ထီပေါက်ကိန်း" name="services[]"
                       onclick="calculate()" id="test" data-service="1500" disabled="1" required>
                <span class="checkmark"></span>
                <span class="mm-font">ထီပေါက်ကိန်း</span>
            </label>

        </div>
        <br>
        <br>
        <p class="mm-font">မေးမြန်းလိုသည့်အကြာင်းအရာကိုရေးပါ။</p>
        <label class="form-group">
            @if($lang == 'zawgyi')
                <textarea name="about" class="test" rows="10" cols="35" placeholder="" style="color: black;" required></textarea>
                @else
                <textarea name="about" class="mm-font test" rows="10" cols="35" placeholder="" style="color: black;" required></textarea>
            @endif
        </label>

        <p class="mm-font" id="price">
        </p>
        <p class="mm-font">{{  'KBZPay, MPT, Telenor, Ooredoo, Mytel, WavePay ဖြင့် ဉာဏ်ပူဇော် ပေးချေနိုင်ပါသည်။' }}</p>
        <button><h4 class="mm-font">
                အတည်ပြုမည်
                <i class="zmdi zmdi-arrow-right"></i>
            </h4>
        </button>
    </form>

    <script type="text/javascript">
        function calculate() {
            var el, i = 0;
            var total = 0;
            var amount = 0;
            var price = 0;
            var payment = '';
            // fruitCount = '12'

            while (el = document.getElementsByName("services[]")[i++]) {
                var data = document.getElementById('test');
                if($("input[type='radio'].radiobutton").is(':checked')) {
                    payment = $("input[type='radio'].radiobutton:checked").val();

                }
                if(payment == 'kbz'){
                    price = 1200;
                }else if(payment == "coda"){
                         price = 2000;
                    }else {
                         price = 1500;
                    }
                var amount = price;

                if (el.checked) {
                    total = total + parseInt(amount);
                }

            }
            if (total > 0) {
                document.getElementById("price").innerHTML = "ဉာဏ်ပူဇော်ခ " + total + "ကျပ်  ဖြစ်ပါသည်။ ငွေပေးချေမှုအောင်မြင်ပြီးပါက နှစ်ရက်အတွင်း ပြန်လည်ဖြေကြားပေးပါမည်။";
            } else {
                document.getElementById("price").innerHTML = '';
            }
            var ids=[];
            $('input[type=checkbox]:checked').each(function(){
                ids.push($(this).val());
                var love = '';
                var family = "";
                var business = "";
                var carrer = "";
                $.each(ids, function( index, value ) {
                    if(value == "အချစ်ရေး"){
                        @if($lang == "zawgyi")
                            love = "ခ်စ္သူရွိလ်င္ ေမြးေန႔ကို ေရးေပးပါ";
                        @else
                        love = "ချစ်သူရှိလျင် မွေးနေ့ကို ရေးပေးပါ";
                        @endif
                    }
                    if(value == 'အိမ်ထောင်ရေး'){
                        @if($lang == "zawgyi")
                                family = "အိမ္ေထာင္ဖက္၏ေမြးေန႔ကို ေရးေပးပါ";
                                @else
                        family = "အိမ်ထောင်ဖက်၏မွေးနေ့ကို ရေးပေးပါ";
                        @endif
                    }
                    if(value == 'ကိုယ်ပိုင်စီးပွားရေး'){
                        @if($lang == "zawgyi")
                                business = "လုပ္ငန္းအမ်ိဳးအစားေဖာ္ျပေပးပါ";
                                @else
                        business = "လုပ်ငန်းအမျိုးအစားဖော်ပြပေးပါ";
                        @endif
                    }
                    if(value == 'အလုပ်အကိုင်'){
                        @if($lang == "zawgyi")
                                carrer = "ဝန္ထမ္းလား၊အလုပ္ရွာသူလား ေဖာ္ျပေပးပါ";
                                @else
                        carrer = "ဝန်ထမ်းလား၊အလုပ်ရှာသူလား ဖော်ပြပေးပါ";
                        @endif
                    }

                });
                $('.test').attr('placeholder', love+"\n"+family+"\n"+business+"\n"+carrer);
                $('textarea').focus(function(){
                    if($(this).val() === placeholder){
                        $(this).attr('value', '');
                    }
                });

                $('textarea').blur(function(){
                    if($(this).val() ===''){
                        $(this).attr('value', placeholder);
                    }
                });

            });


        }

        $(function () {
            var requiredCheckboxes = $('.options :checkbox[required]');
            requiredCheckboxes.change(function () {
                if (requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                } else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });
        });
        $('input[name=payment]').change(function (e) {
            var total = 0;
            var payment = e.target.value;
            var price = 0;
            var amount = 0;
            var el, i = 0;
            $("input.form-check-input").removeAttr("disabled");

            while (el = document.getElementsByName("services[]")[i++]) {
                if(payment == 'kbz'){
                    price = 1200;
                }else if(payment == "coda"){
                    price = 2000;
                }else {
                    price = 1500;
                }
                amount = price;

                if (el.checked) {
                    total = total + parseInt(amount);
                }

            }
            if (total > 0) {
                document.getElementById("price").innerHTML = "ဉာဏ်ပူဇော်ခ " + total + "ကျပ်  ဖြစ်ပါသည်။ ငွေပေးချေမှုအောင်မြင်ပြီးပါက နှစ်ရက်အတွင်း ပြန်လည်ဖြေကြားပေးပါမည်။";
            } else {
                document.getElementById("price").innerHTML = '';
            }

        })
    </script>
@endsection