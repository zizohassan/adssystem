@extends('admin.layout.app')

@section('title')
     {{ adminTrans('country' , 'country') }} {{ adminTrans('home' , 'control') }}
@endsection

@section('content')
    @include('admin.layout.table' , ['title' => adminTrans('country' , 'country') , 'model' => 'country' , 'table' => $dataTable->table() ])
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
@endsection