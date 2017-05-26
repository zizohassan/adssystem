@extends('admin.layout.app')

@section('title')
     {{ adminTrans('state' , 'state') }} {{ adminTrans('home' , 'control') }}
@endsection

@section('content')
    @include('admin.layout.table' , ['title' => adminTrans('state' , 'state') , 'model' => 'state' , 'table' => $dataTable->table() ])
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
@endsection