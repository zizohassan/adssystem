@extends('admin.layout.app')

@section('title')
    {{ adminTrans('state' , 'state') }} {{ adminTrans('home' , 'view') }}
@endsection

@section('content')
    @component('admin.layout.form' , ['title' => adminTrans('state' , 'state') , 'model' => 'state' , 'action' => adminTrans('home' , 'view')  ])

        <table class="table table-bordered table-responsive table-striped">
            @php
                $fields = rename_keys(
                     removeFromArray($data['fields'] , ['id']) ,
                     [

                    adminTrans('state' , 'name'),
                    adminTrans('state' , 'country'),
                    ]
                );
            @endphp
                 @foreach($fields as $key =>  $field)
                        <tr>
                            <th>{{ $key }}</th>
                            @if($field == 'name')
                                <td>{!! getDefaultValueKey($item[$field])  !!}</td>
                             @else
                                <td>{!! getDefaultValueKey(\App\Application\Model\Country::find($item[$field])->name)  !!}</td>
                            @endif
                        </tr>
                    @endforeach
        </table>

        @include('admin.state.buttons.delete' , ['id' => $item->id])
        @include('admin.state.buttons.edit' , ['id' => $item->id])

    @endcomponent
@endsection
