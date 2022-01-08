<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
</head>
<body>
<div class="loader"></div>
<div class="limiter">
    <div class="container-login100" style="background-image: url({{ asset('payment/images/bg-01.jpg') }});">
        <div class="wrap-login100">


            @if($payment_method == 'normal')
                <form action="{{config('payment.payment_endpoint')}}" id="payment" method='POST' name='paymentform'>

                    <input type="hidden" name="merchant_id" value="{{ config('payment.merchant_id_1') }}">

                    <input type="hidden" name="service_name" value="{{ config('payment.service_name_1') }}">

                    <input type="hidden" name="email" value="{{ config('payment.email_1') }}">

                    <input type="hidden" name="password" value="{{ config('payment.password_1') }}">

                    <input type="hidden" name="amount" value="{{ $price }}">

                    <input type="hidden" name="order_id" value="{{ $order_id }}">

                </form>
            @endif


                @if($payment_method == 'coda')
                    <form action="{{config('payment.payment_endpoint')}}" id="payment" method='POST' name='paymentform'>

                        <input type="hidden" name="merchant_id" value="{{ config('payment.merchant_id_2') }}">

                        <input type="hidden" name="service_name" value="{{ config('payment.service_name_2') }}">

                        <input type="hidden" name="email" value="{{ config('payment.email_2') }}">

                        <input type="hidden" name="password" value="{{ config('payment.password_2') }}">

                        <input type="hidden" name="amount" value="{{ $price }}">

                        <input type="hidden" name="order_id" value="{{ $order_id }}">

                    </form>
                @endif



                @if($payment_method == 'other')
                    <form action="{{config('payment.payment_endpoint')}}" id="payment" method='POST' name='paymentform'>

                        <input type="hidden" name="merchant_id" value="{{ config('payment.merchant_id_3') }}">

                        <input type="hidden" name="service_name" value="{{ config('payment.service_name_3') }}">

                        <input type="hidden" name="email" value="{{ config('payment.email_3') }}">

                        <input type="hidden" name="password" value="{{ config('payment.password_3') }}">

                        <input type="hidden" name="amount" value="{{ $price }}">

                        <input type="hidden" name="order_id" value="{{ $order_id }}">

                    </form>
                @endif

                @if($payment_method == 'kbz')
                    <form action="{{config('payment.payment_endpoint')}}" id="payment" method='POST' name='paymentform'>

                        <input type="hidden" name="merchant_id" value="{{ config('payment.merchant_id_4') }}">

                        <input type="hidden" name="service_name" value="{{ config('payment.service_name_4') }}">

                        <input type="hidden" name="email" value="{{ config('payment.email_4') }}">

                        <input type="hidden" name="password" value="{{ config('payment.password_4') }}">

                        <input type="hidden" name="amount" value="{{ $price }}">

                        <input type="hidden" name="order_id" value="{{ $order_id }}">

                    </form>
                @endif
        </div>
    </div>
</div>
<div class="container">
    <br><br>
    <img src="https://s3.ap-southeast-1.amazonaws.com/assets.myclip.com/smart/yViOMmpAE5Q0NDrz9ORW3wFKp1hq5kJd1SYpSc2W.gif"
         class="center">
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script language="JavaScript">
    $(document).ready(function () {
        $('#payment').submit();
    });
</script>
</body>
</html>