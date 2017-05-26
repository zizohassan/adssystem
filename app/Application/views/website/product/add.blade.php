@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Ads</div>
                    <div class="panel-body">
                        @include('layouts.messages')
                        <form class="form-horizontal" role="form" method="POST" action="{{ concatenateLangToUrl('addNewAds') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('des') ? ' has-error' : '' }}">
                                <label for="des" class="col-md-4 control-label">Ads Description</label>

                                <div class="col-md-6">
                                    <textarea id="des"  class="form-control" name="des"  required autofocus>{{ old('des') }}</textarea>

                                    @if ($errors->has('des'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('des') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required autofocus>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="form-line">
                                    <label class="col-md-4 control-label">{{ adminTrans('product' , 'country_id') }}</label>
                                    <div class="col-md-6">
                                        {!! Form::select('country_id' , getCountryForUser() , null , ['class' => 'form-control' , 'id' => 'country'] ) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="showState" style="display: none">
                                <div class="form-line">
                                    <label class="col-md-4 control-label">{{ adminTrans('product' , 'state_id') }}</label>
                                    <div class="col-md-6">
                                        {!! Form::select('state_id' , [] , null , ['class' => 'form-control' , 'id' => 'state'] ) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label class="col-md-4 control-label">{{ adminTrans('product' , 'cat_id') }}</label>
                                    <div class="col-md-6">
                                        {!! Form::select('cat_id' , getAllCatsWithTransform(), null , ['class' => 'form-control'] ) !!}
                                     </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label class="col-md-4 control-label">{{ adminTrans('product' , 'image') }}</label>
                                    <div class="col-md-6">
                                        <input type="file" class="imageUpload" name="image[]">
                                        <div class="Image">

                                        </div>
                                        <br>
                                        <span  class="btn btn-primary addImage">
                                            Add Image
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-line">
                                    <label class="col-md-4 control-label">{{ adminTrans('product' , 'image') }}</label>
                                    <div class="col-md-6">
                                        <div id="map" style="widows: 100%;height: 300px;"></div>
                                    </div>
                                </div>
                            </div>



                            <input type="hidden" name="lat" id="lat" value="0">
                            <input type="hidden" name="lng" id="lng" value="0">

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add Ads
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

    <script>
        $('#country').on('change' , function(){
            $('#showState').show();
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
        $('.addImage').on('click' , function(){
            if($('.imageUpload').length < 5){
                var html = '<input type="file" class="imageUpload" name="image[]">';
                $('.Image').append(html);
            }else{
                $(this).hide();
            }
        });

        var map, infoWindow;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 15
            });
            infoWindow = new google.maps.InfoWindow;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    $('#lat').val( position.coords.latitude);
                    $('#lng').val( position.coords.longitude);
                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Location found.');
                    infoWindow.open(map);
                    map.setCenter(pos);


                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map
                    });

                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSbbbC8jpQwEKs830f5sGFkkITdpvoBMM&callback=initMap">
    </script>
@endsection