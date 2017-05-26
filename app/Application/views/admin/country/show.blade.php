@extends('admin.layout.app')

@section('title')
    {{ adminTrans('country' , 'country') }} {{ adminTrans('home' , 'view') }}
@endsection

@section('content')
    @component('admin.layout.form' , ['title' => adminTrans('country' , 'country') , 'model' => 'country' , 'action' => adminTrans('home' , 'view')  ])

        <table class="table table-bordered table-responsive table-striped">
            @php
                $fields = rename_keys(
                     removeFromArray($data['fields'] , ['id']) ,
                     [
                        adminTrans('country' , 'name')
                     ]
                );
            @endphp
                 @foreach($fields as $key =>  $field)
                        <tr>
                            <th>{{ $key }}</th>
                             <td>{!!  getDefaultValueKey($item[$field])  !!}</td>
                        </tr>
                    @endforeach
        </table>

        @include('admin.country.buttons.delete' , ['id' => $item->id])
        @include('admin.country.buttons.edit' , ['id' => $item->id])

    @endcomponent
@endsection
