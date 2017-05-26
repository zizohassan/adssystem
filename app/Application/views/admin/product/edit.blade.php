@extends('admin.layout.app')

@section('title')
    {{ adminTrans('product' , 'product') }} {{  isset($item) ? adminTrans('home' , 'edit')  : adminTrans('home' , 'add')  }}
@endsection

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    @component('admin.layout.form' , ['title' => adminTrans('product' , 'product') , 'model' => 'product' , 'action' => isset($item) ? adminTrans('home' , 'edit')  : adminTrans('home' , 'add')  ])
    @include('admin.layout.messages')
    <form action="{{ concatenateLangToUrl('admin/product/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'name') }}</label>
                <input type="text" name="name" value="{{ isset($item) ? $item->name : null }}" class="form-control">
            </div>
        </div>


        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'status') }}</label>
                @php $status = isset($item) ? $item->status : null @endphp
                {!! Form::select('status' , productStatus() , $status , ['class' => 'form-control'] ) !!}
            </div>
        </div>




        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'des') }}</label>
                <textarea type="text" name="des" class="form-control"
                          rows="8">{{ isset($item) ? $item->des : null }}</textarea>
            </div>
        </div>


        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'price') }}</label>
                <input type="text" name="price" value="{{ isset($item) ? $item->price : null }}" class="form-control">
            </div>
        </div>


        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'lat') }}</label>
                <input type="text" name="lat" value="{{ isset($item) ? $item->lat : null }}" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'lng') }}</label>
                <input type="text" name="lng" value="{{ isset($item) ? $item->lng : null }}" class="form-control">
            </div>
        </div>


        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'phone') }}</label>
                <input type="text" name="phone" value="{{ isset($item) ? $item->phone : null }}" class="form-control">
            </div>
        </div>


        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('page' , 'image') }}</label>
                @if(isset($item) && $item->image != '')
                    @if(json_decode($item->image))
                        @foreach(json_decode($item->image) as $image)
                            <img src="{{ url('/'.env('UPLOAD_PATH').'/'.$image) }}" class="img-responsive thumbnail pull-right" alt="" width="150">
                        @endforeach
                    @endif
                    <br>
                @endif
                <input type="file" name="image[]" class="" {{ !isset($item) ? "required='required'" : '' }} >
                <input type="file" name="image[]" class=""  >
                <input type="file" name="image[]" class="" >
                <input type="file" name="image[]" class="" >
                <input type="file" name="image[]" class=""  >

            </div>
        </div>


        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'country_id') }}</label>
                @php $countryName = isset($item) ? $item->country_id : null @endphp
                {!! Form::select('country_id' , $data['data']['country'] , $countryName , ['class' => 'form-control' , 'id' => 'country'] ) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'state_id') }}</label>
                @php $stateName = isset($item) ? $item->state_id : null @endphp
                {!! Form::select('state_id' , $data['data']['state'] , $stateName , ['class' => 'form-control' , 'id' => 'state'] ) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="">{{ adminTrans('product' , 'user_id') }}</label>
            @if(!isset($item))
                {!! Form::select('user_id' , [] , null , ['class' => 'form-control ajaxSelect'] ) !!}
            @else
               <a href="{{ concatenateLangToUrl('admin/user/item/'.$data['data']['user_id']->id) }}"> {{ $data['data']['user_id']->name  }}</a>
            @endif
        </div>


        <div class="form-group">
            <div class="form-line">
                <label for="">{{ adminTrans('product' , 'cat_id') }}</label>
                @php $catName = isset($item) ? $item->cat_id : null @endphp
                {!! Form::select('cat_id' , $data['data']['cat_id'] , $catName , ['class' => 'form-control'] ) !!}
            </div>
        </div>


        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-default">
                <i class="material-icons">check_circle</i>
                {{ adminTrans('home' ,'save') }}  {{ adminTrans('product' , 'product') }}
            </button>
        </div>
    </form>
    @endcomponent
@endsection


@section('script')
    @include('admin.product.scripts.script')
    @include('admin.product.scripts.country')
@endsection