<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>1875 Bay Din</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet"
          href="{{ asset('naming/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('naming/css/style.css') }}">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
    </script>
    <style>

        @font-face {
            font-family: 'Zawgyi-One';
            src: url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/zawgyi.ttf') format('woff'), url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/zawgyi.ttf') format('ttf');
        }

        @font-face {
            font-family: 'Unicode';
            src: url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/mon3.woff') format('woff'), url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/mon3.ttf') format('ttf');
        }
        input[type="radio"] {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
            transform: scale(1.5);
        }
    </style>
    <style>
        .mm-font {
            font-family: Unicode;
        }
    </style>
    <style>
        textarea {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            width: 100%;
        }
        a:link, a:visited {
            background-color: #2098d1;
            border: none;
            color: #FFFFFF;
            padding: 2px 32px;
            text-align: center;
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
        }

        a:hover, a:active {
            background-color: #00ade6;
        }

        .text-center {
            text-align: center !important;
        }
        h4{
            color: black;
        }

        .form-check-inline {
            display: -ms-inline-flexbox;
            display: inline-flex;
            -ms-flex-align: center;
            align-items: center;
            padding-left: 0;
            margin-right: .75rem;
        }

        .check-input {
            position: static;
            margin-top: 0;
            margin-right: .3125rem;
            margin-left: 0;
        }
        .form-check-label {
            margin-bottom: 0;
        }
        input[type="radio"], input[type="checkbox"] {
            box-sizing: border-box;
            padding: 0;
        }
        .form-check-input[type="checkbox"]+label, label.btn input[type="checkbox"]+label {
            position: relative;
            display: inline-block;
            height: 1.5625rem;
            padding-left: 35px;
            line-height: 1.5625rem;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        /* The customcheck */
        .customcheck {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 15px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .customcheck input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 5px;
        }

        /* On mouse-over, add a grey background color */
        .customcheck:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .customcheck input:checked ~ .checkmark {
            background-color: #02cf32;
            border-radius: 5px;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .customcheck input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .customcheck .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>

</head>

<body style="background-color: #030033;">
<div class="inner" style="background-color: white">
    <img src="https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/S8q7H36jcwHbDaOsuQyeVZ3AAHQL8wqjQ3TIzbcq.png">
</div>
@if($status == 'success')
    <div class="inner">
        <div class="card text-white bg-success" style="max-width: 20rem;">
            <div class="card-body">
                <p class="mm-font">
                <h4 class="text-center" style="color: white">ငွေပေးချေမှုအောင်မြင်ပါသည်။</h4>
                </p>
                <p style="color: white;">မေးမြန်းထားသည့် မေးခွန်းများကို လူကြီးမင်းထံ နှစ်ရက် အတွင်းပြန်လည် ဖြေကြားပေးပါမည်</p>
            </div>
        </div>
    </div>
    @else
    <div class="inner">
        <div class="card text-white bg-danger" style="max-width: 20rem;">
            <div class="card-body">
                <p class="mm-font">
                <h4 class="text-center" style="color: white">ငွေပေးချေမှုမအောင်မြင်ပါ။</h4>
                </p>
                <p style="color: white;">အသေးစိတ်အချက်အလက်များကိုသိရှိလိုပါက <a href="tel:09456880335">09456880335</a> သို့ ခေါ်ဆိုမေးမြန်းနိုင်ပါသည်။ </p>
            </div>
        </div>
    </div>
    @endif


{{--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>--}}
<script>
    $(function () {

        $('#child-form-link').click(function (e) {
            $("#child-form").delay(100).fadeIn(100);
            $("#business-form").fadeOut(100);
            $('#business-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#business-form-link').click(function (e) {
            $("#business-form").delay(100).fadeIn(100);
            $("#child-form").fadeOut(100);
            $('#child-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });

</script>
<script type="text/javascript">
    $(".date_picker").datepicker({dateFormat: 'yy-mm-dd'});
    $('input[name=payment]').change(function (e) {
        var payment = e.target.value;
        if(payment == "coda"){
            var price = 6000;
        }else {
            var price = 4500;
        }
        var text = "ဉာဏ်ပူဇော်ခ "+price+"ကျပ် ဖြစ်ပါသည်။ ငွေပေးချေမှုအောင်မြင်ပြီးပါက နှစ်ရက်အတွင်း ပြန်လည်ဖြေကြားပေးပါမည်။";
        document.getElementById("payment").innerHTML = text;

    })
    $('input[name=direct]').change(function (e) {
        var payment = e.target.value;
        if(payment == "coda"){
            var price = 2000;
        }else {
            var price = 1500;
        }
        var text = "ဉာဏ်ပူဇော်ခ "+price+"ကျပ် ဖြစ်ပါသည်။ ငွေပေးချေမှုအောင်မြင်ပြီးပါက နှစ်ရက်အတွင်း ပြန်လည်ဖြေကြားပေးပါမည်။";
        document.getElementById("payment").innerHTML = text;

    })
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>





