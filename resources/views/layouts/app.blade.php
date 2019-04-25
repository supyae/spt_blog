<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('/custom/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('/custom/css/blog-home.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url("/") }}">MY BLOG SAMPLE</a>
        </div>


        <div style="float: right">
                @guest

                    <a class="btn nav-custom" href="{{ route('login') }}">{{ __('Login') }}</a>

                    <a class="btn nav-custom" href="{{ route('register') }}">{{ __('Register') }}</a>
                @else

                    <a href="#" class="btn nav-custom"
                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                        @csrf
                    </form>

                    @endguest

        </div>
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
    @if(Auth::guest())
        <input type='hidden' value='1' name='guest'>
    @endif

    @yield('content')


</div>
<!-- /.container -->


<!-- jQuery -->
<script src="{{url('custom/js/jquery.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ url('custom/js/bootstrap.min.js') }}"></script>

<!--- ck editor ------>
<script type="text/javascript" src="{{ asset('/custom/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript" src="{{ asset('/custom/script.js') }}"></script>

</body>

</html>