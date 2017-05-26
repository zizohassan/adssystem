@extends('admin.layout.app')

@section('title')
     {{ adminTrans('product' , 'product') }} {{ adminTrans('home' , 'control') }}
@endsection

@section('content')
    @include('admin.layout.table' , ['title' => adminTrans('product' , 'product') , 'model' => 'product' , 'table' => $dataTable->table() ])
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
@endsection