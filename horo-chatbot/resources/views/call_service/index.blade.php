@extends('layouts.master')
@section('content')

    <form id="child-form" action="{{ route('baydinsayar_call.store') }}" method="post" role="form"
          style="display: block;">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        {{--<input type="hidden" name="category_id" value="{{ $category_id }}">--}}
        @csrf
        <h3 class="mm-font">တနှစ်တာ အထူးဗေဒင်ဟောစာတမ်း</h3>
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
        <input type="radio" name="marital_status" value="Yes" required> <span for=""
                                                                              class="mm-font"> အိမ်ထောင်ရှိ </span>
        <input type="radio" name="marital_status" value="No" required> <span for=""
                                                                             class="mm-font"> အိမ်ထောင်မရှိ </span>
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
            <input type="text" class="form-control" name="phone_number" required>
            <span for="" class="mm-font">ဆက်သွယ်ရမည့်ဖုန်းနံပါတ်</span>
            <span class="border"></span>
        </label>
        {{--<input type="radio" name="payment" class="radiobutton" value="coda" required> <span for="" class="mm-font">ဖုန်းဘေလ်ဖြင့်ပေးချေမည်</span>--}}
        {{--<input type="radio" name="payment" class="radiobutton" value="other" required> <span for="" class="mm-font">အခြား Pay ဖြင့်ပေးချေမည်</span>--}}
        <br>
        <br>

        <label class="form-group">
            <h4 class="mm-font" style="color: white;font-size: 15px;">ဗေဒင်ဆရာ/မ များမှ ဖုန်းခေါ်ဆို
                ပေးစေချင်သောအချိန်</h4>
            <h5 class="mm-font" style="color: white">တနင်္လာ မှ စနေထိ၊မနက် ၉နာရီ မှ ညနေ ၅နာရီအတွင်းသာ</h5>
            <input type="text" class="form-control mm-font" name="call_time">

            {{--<span for="" class="mm-font">--}}
            {{----}}
            {{--<h6 style="color:white;">--}}
            {{--}}
        {{--</h6>--}}

            {{--</span>--}}
            {{--<br>--}}
            {{--<br>--}}
            {{--<span class="border"></span>--}}
        </label>
        {{--<input type="radio" name="payment" class="radiobutton" value="coda" required> <span for="" class="mm-font">ဖုန်းဘေလ်ဖြင့်ပေးချေမည်</span>--}}
        {{--<input type="radio" name="payment" class="radiobutton" value="other" required> <span for="" class="mm-font">အခြား Pay ဖြင့်ပေးချေမည်</span>--}}
        <br>
        <br>

        <input type="radio" name="call" value="kbz" required> <span for="" class="mm-font">20% Discount with KBZPay &nbsp;&nbsp;</span>
        <input type="radio" name="call" value="coda" required> <span for=""
                                                                     class="mm-font">With Phone Bill &nbsp;&nbsp;</span>
        <input type="radio" name="call" value="other" required> <span for=""
                                                                      class="mm-font">Other Pay</span>
        <br><br>
        <p class="mm-font" id="call_service">
        <p class="mm-font">မေးမြန်းလိုသည့်အကြာင်းအရာကိုရေးပါ။</p>
        <label class="form-group">
            @if($lang == 'zawgyi')
                <textarea name="about" class="test" rows="10" cols="35" placeholder="" style="color: black;"
                          required></textarea>
            @else
                <textarea name="about" class="mm-font test" rows="10" cols="35" placeholder="" style="color: black;"
                          required></textarea>
            @endif
        </label>


        <h2 class="mm-font text-center"> ဗေဒင်ဆရာများ </h2>

        <div class="feature">
            <figure class="featured-item image-holder r-3-2 transition"></figure>
        </div>

        <div class="gallery-wrapper">
            <div class="gallery">
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 active transition"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 transition"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 transition"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 transition"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 transition"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 transition"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 transition"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 transition"></figure>
                </div>
                <div class="item-wrapper">
                    <figure class="gallery-item image-holder r-3-2 transition"></figure>
                </div>
            </div>
        </div>

        <div class="controls">
            <a class="move-btn left" style="font-size: 30px">&larr;</a>
            <a class="move-btn right" style="font-size: 30px">&rarr;</a>
        </div>

        <br>
        <br>
        <p class="mm-font">{{  'KBZPay, MPT, Telenor, Ooredoo, Mytel, WavePay ဖြင့် ဉာဏ်ပူဇော် ပေးချေနိုင်ပါသည်။' }}</p>
        <button><h4 class="mm-font">
                အတည်ပြုမည်
                <i class="zmdi zmdi-arrow-right"></i>
            </h4>
        </button>
    </form>

    <script type="text/javascript">
        $('input[name=call]').change(function (e) {
            var payment = e.target.value;
            if (payment == 'kbz') {
                var price = 4000;
            } else if (payment == "coda") {
                var price = 5000;
            } else {
                var price = 5000;
            }
            var text = " ဉာဏ်ပူဇော်ခ" + price + "ကျပ်ဖြစ်ပါသည်။ ငွေပေးချေပြီးပါက လူကြီးမင်းထည့်သွင်းထားသော အချိန်အတွင်းဖုန်းပြန်လည်ခေါ်၍ ဟောကြားပေးသွားမည်ဖြစ်ပြီး အချိန်အပြောင်းအလဲရှိပါက ကြိုတင်အသိပေးသွားပါမည်။";
            document.getElementById("call_service").innerHTML = text;

        });
        var gallery = document.querySelector('.gallery');
        var galleryItems = document.querySelectorAll('.gallery-item');
        var numOfItems = gallery.children.length;
        var itemWidth = 23; // percent: as set in css

        var featured = document.querySelector('.featured-item');

        var leftBtn = document.querySelector('.move-btn.left');
        var rightBtn = document.querySelector('.move-btn.right');
        var leftInterval;
        var rightInterval;

        var scrollRate = 0.2;
        var left;

        function selectItem(e) {
            if (e.target.classList.contains('active')) return;

            featured.style.backgroundImage = e.target.style.backgroundImage;

            for (var i = 0; i < galleryItems.length; i++) {
                if (galleryItems[i].classList.contains('active'))
                    galleryItems[i].classList.remove('active');
            }

            e.target.classList.add('active');
        }

        function galleryWrapLeft() {
            var first = gallery.children[0];
            gallery.removeChild(first);
            gallery.style.left = -itemWidth + '%';
            gallery.appendChild(first);
            gallery.style.left = '0%';
        }

        function galleryWrapRight() {
            var last = gallery.children[gallery.children.length - 1];
            gallery.removeChild(last);
            gallery.insertBefore(last, gallery.children[0]);
            gallery.style.left = '-23%';
        }

        function moveLeft() {
            left = left || 0;

            leftInterval = setInterval(function () {
                gallery.style.left = left + '%';

                if (left > -itemWidth) {
                    left -= scrollRate;
                } else {
                    left = 0;
                    galleryWrapLeft();
                }
            }, 1);
        }

        function moveRight() {
            //Make sure there is element to the leftd
            if (left > -itemWidth && left < 0) {
                left = left - itemWidth;

                var last = gallery.children[gallery.children.length - 1];
                gallery.removeChild(last);
                gallery.style.left = left + '%';
                gallery.insertBefore(last, gallery.children[0]);
            }

            left = left || 0;

            leftInterval = setInterval(function () {
                gallery.style.left = left + '%';

                if (left < 0) {
                    left += scrollRate;
                } else {
                    left = -itemWidth;
                    galleryWrapRight();
                }
            }, 1);
        }

        function stopMovement() {
            clearInterval(leftInterval);
            clearInterval(rightInterval);
        }

        leftBtn.addEventListener('mouseenter', moveLeft);
        leftBtn.addEventListener('mouseleave', stopMovement);
        rightBtn.addEventListener('mouseenter', moveRight);
        rightBtn.addEventListener('mouseleave', stopMovement);


        //Start this baby up
        (function init() {
            var images = [
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/HquaoE4zf0CpyGciDKk7m2JWzYR1Y9Rh0SXu3y2f.jpeg',
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/QwGFOX5UMFViMPGMqLO01ctjd7TPZXSUxiud0fOi.jpeg',
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/jtJJrzwGwJK4hEKCEULxWS2JhmbW8X6JHSAj9mdf.jpeg',
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/1dfvLNMQn0eO9KA6sYlrmT7mMb2lBIGKzJUmNBGq.jpeg',
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/bqT3PnK3tJ7Xn1JWylN2ZEUnrQkNWKlfKh3bV0bC.jpeg',
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/g1UFtmxAzcMJeRxyaUM8V0VRzhQUAQ6KzfJHWQaG.jpeg',
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/HPZTllBvWKhA2tvfJMbd4zhZHv3cOzTi0L6oji9n.jpeg',
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/d9qxmZ8QaUtamRxc57pWAtRRGckKYKtvRRuZkMZv.jpeg',
                'https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/BaZhNOTgtAzi6SVdg25WUqigHNShv75XWDuLU5TP.jpeg'
            ];

            //Set Initial Featured Image
            featured.style.backgroundImage = 'url(' + images[0] + ')';

            //Set Images for Gallery and Add Event Listeners
            for (var i = 0; i < galleryItems.length; i++) {
                galleryItems[i].style.backgroundImage = 'url(' + images[i] + ')';
                galleryItems[i].addEventListener('click', selectItem);
            }
        })();
    </script>
@endsection