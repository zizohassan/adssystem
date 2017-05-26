@extends('admin.layout.app')

@section('title')
    {{ adminTrans('contact' , 'contact') }} {{  isset($item) ? adminTrans('home' , 'edit')  : adminTrans('home' , 'add')  }}
@endsection

@section('content')
    @component('admin.layout.form' , ['title' => adminTrans('contact' , 'contact') , 'model' => 'contact' , 'action' => isset($item) ? adminTrans('home' , 'edit')  : adminTrans('home' , 'add')  ])
        @include('admin.layout.messages')
        <form action="{{ concatenateLangToUrl('admin/contact/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="form-line">
                    <label for="">{{ adminTrans('contact' , 'name') }}</label>
                    <input type="text" name="name" value="{{ isset($item) ? $item->name : null }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="form-line">
                    <label for="">{{ adminTrans('contact' , 'email') }}</label>
                    <input type="text" name="email" value="{{ isset($item) ? $item->email : null }}" class="form-control">
                </div>
            </div>


            <div class="form-group">
                <div class="form-line">
                    <label for="">{{ adminTrans('contact' , 'message') }}</label>
                <textarea type="text" name="message" class="form-control"
                          rows="8">{{ isset($item) ? $item->message : null }}</textarea>
                </div>
            </div>


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ adminTrans('home' ,'save') }}  {{ adminTrans('contact' , 'contact') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
