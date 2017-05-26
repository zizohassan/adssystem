@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/singleprodut_page.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="card">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/'.$product->country->slug) }}">{{ getDefaultValueKey($product->country->name) }}</a></li>
            <li><a href="{{ url('/'.$product->country->slug.'/'.$product->state->slug) }}">{{ getDefaultValueKey($product->state->name) }}</a></li>
            <li><a href="{{ url('/'.$product->country->slug.'/'.$product->state->slug.'/'.$product->cat->slug) }}">{{ getDefaultValueKey($product->cat->name) }}</a></li>

        </ol>
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        @if(json_decode($product->image))
                            @foreach(json_decode($product->image) as $key => $image)
                                <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="pic-{{ $key }}"><img src="{{ url('/'.env('UPLOAD_PATH').'/'.$image) }}" /></div>
                            @endforeach
                        @endif
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        @if(json_decode($product->image))
                            @foreach(json_decode($product->image) as $key => $image)
                                <li class="{{ $key == 0 ? 'active' : '' }}"><a data-target="#pic-{{ $key }}" data-toggle="tab"><img src="{{ url('/'.env('UPLOAD_PATH').'/'.$image) }}" /></a></li>
                            @endforeach
                        @endif
                    </ul>
                    <br>
                    @if($product->lat != 0 && $product->lng != 0 )
                        <div id="map" style="width: 100%;height:400px;"></div>
                    @endif
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">
                        {{ $product->name }}
                    </h3>
                    <p class="product-description">
                        {{ $product->des }}
                    </p>
                    <h4 class="price">current price: <span>${{ $product->price }}</span></h4>
                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">
                            {{ $product->phone }}
                        </button>
                    </div>
                    <div id="disqus_thread"></div>
                    <script>
                         var disqus_config = function () {
                         this.page.url = "{{ request()->fullUrl() }}";  // Replace PAGE_URL with your page's canonical URL variable
                         this.page.identifier = "{{ $product->id.'|'.$product->title }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                         };
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://ads-6.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script id="dsq-count-scr" src="//ads-6.disqus.com/count.js" async></script>


    @if($product->lat != 0 && $product->lng != 0 )
        <script>
            function initMap() {
                var uluru = {lat: {{  $product->lat }}, lng: {{ $product->lng }} };
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: uluru
                });
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSbbbC8jpQwEKs830f5sGFkkITdpvoBMM&callback=initMap">
        </script>
    @endif
@endsection
