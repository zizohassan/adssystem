@extends('layouts.app')

@section('content')
    <div class="container">
            @include('website.product.helpers.search')
        <div class="row">
            @include('website.product.helpers.loop')
        </div>
    </div>
@endsection
