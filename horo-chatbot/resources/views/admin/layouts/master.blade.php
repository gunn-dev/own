<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('admin/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('admin/css/themes/all-themes.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.html">HORO Chat Bot</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                <!-- #END# Call Search -->
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ asset('admin/images/user.png') }}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ \Illuminate\Support\Facades\Auth::user()->name }}</div>
                <div class="email">{{ \Illuminate\Support\Facades\Auth::user()->email }}</div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
           @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                    <li class="active">
                        <a href="{{route('admin.home')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">comment</i>
                            <span>Contents</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ route('admin.content.index') }}" class="">
                                    <span>View</span>
                                </a>
                                <a href="{{ route('admin.content.create') }}" class="">
                                    <span>Create Content</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.business.index') }}">
                            <i class="material-icons">account_balance</i>
                            <span>Business Baydin</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.child.index') }}">
                            <i class="material-icons">pregnant_woman</i>
                            <span>Child Baydin</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('admin.oneyear.index')}}">
                            <i class="material-icons">today</i>
                            <span>One Year Baydin</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('admin.lovebaydin.index')}}">
                            <i class="material-icons">favorite</i>
                            <span>Love Baydin</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('admin.directbaydin.index')}}">
                            <i class="material-icons">sync_alt</i>
                            <span>Direct Baydin</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('admin.phone_call.index')}}">
                            <i class="material-icons">settings_cell</i>
                            <span>Phone Call Service</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('admin.manual_payment.index')}}">
                            <i class="material-icons">request_page</i>
                            <span>Manual Payment</span>
                        </a>
                    </li>


               @else
                    <li class="active">
                        <a href="{{route('starphone.payment')}}">
                            <i class="material-icons">home</i>
                            <span>Payment</span>
                        </a>
                    </li>
               @endif
                <li class="">
                    <a href="{{route('admin.logout')}}">
                        <i class="material-icons">logout</i>
                        <span>Logout</span>
                    </a>
                </li>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->

        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <!-- #END# Right Sidebar -->
</section>

@yield('content')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" >
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>


<!-- Bootstrap Core Js -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Select Plugin Js -->
<script src="{{ asset('admin/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('admin/plugins/node-waves/waves.js') }}"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('admin/plugins/jquery-countto/jquery.countTo.js') }}"></script>

<!-- Morris Plugin Js -->
<script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/plugins/morrisjs/morris.js') }}"></script>

<!-- ChartJs -->
<script src="{{ asset('admin/plugins/chartjs/Chart.bundle.js') }}"></script>

<!-- Flot Charts Plugin Js -->
<script src="{{ asset('admin/plugins/flot-charts/jquery.flot.js') }}"></script>
<script src="{{ asset('admin/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('admin/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('admin/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('admin/plugins/flot-charts/jquery.flot.time.js') }}"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="{{ asset('admin/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('admin/js/admin.js') }}"></script>
<script src="{{ asset('admin/js/pages/index.js') }}"></script>
<script src="{{ asset('admin/js/pages/charts/chartjs.js') }}"></script>
<!-- Demo Js -->
<script src="{{ asset('admin/js/demo.js') }}"></script>
<script type="text/javascript">
    $(".date_picker").datepicker({ dateFormat: 'yy-mm-dd' });
</script>
@yield('scripts')

</body>

</html>
