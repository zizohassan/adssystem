<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteTitle }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link href="{{ asset('css/product.css') }}" rel="stylesheet">

    @yield('style')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ $siteTitle }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav" style="margin-top: 5px">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                         @endforeach
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('addAds') }}">Add Ads</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('/user/ads') }}">Your Ads</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ adminTrans('website' , 'coutnry') }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($country as $slugCountry => $countryName)
                                        <li><a href="{{ url('/'.$slugCountry) }}">{{ getDefaultValueKey($countryName) }}</a></li>
                                     @endforeach
                                    </ul>
                                </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ adminTrans('website' , 'cat') }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">

                                    @foreach($cats as $slugCat => $CatName)
                                        <li><a href="{{ url('/'.getCurrectCountry().'/'.$slugCat) }}">{{ getDefaultValueKey($CatName) }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    @include('layouts.footer')

    {!! Links::track(true) !!}
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('#country').on('change' , function(){
            var country = $(this).val();
            if(country != ''){
                $.get("{{ concatenateLangToUrl('getState') }}"+'/'+country , function(res){
                    var json = JSON.parse(res);
                    var out = '';
                    $.each(json , function(key , value){
                        console.log(value);
                        out += '<option value="'+key+'">'+value+'</option>'
                    });
                    $('#state').html(out);
                    $('#state').selectpicker('refresh');
                });
            }
        });
    </script>
    @yield('script')
</body>
</html>
