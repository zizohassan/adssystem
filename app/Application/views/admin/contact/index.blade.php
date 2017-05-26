@extends('admin.layout.app')

@section('title')
     {{ adminTrans('contact' , 'contact') }} {{ adminTrans('home' , 'control') }}
@endsection

@section('content')
    @include('admin.layout.table' , ['title' => adminTrans('contact' , 'contact') , 'model' => 'contact' , 'table' => $dataTable->table() ])
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
@endsection