@extends('admin.layout.app')

@section('title')
    {{ adminTrans('contact' , 'contact') }} {{ adminTrans('home' , 'view') }}
@endsection

@section('content')
    @component('admin.layout.form' , ['title' => adminTrans('contact' , 'contact') , 'model' => 'contact' , 'action' => adminTrans('home' , 'view')  ])

        <table class="table table-bordered table-responsive table-striped">
            @php
                $fields = rename_keys(
                     removeFromArray($data['fields'] , ['id']) ,
                     [
            adminTrans('contact' , 'name'),
            adminTrans('contact' , 'email'),
            adminTrans('contact' , 'message'),
                     ]
                );
            @endphp
                 @foreach($fields as $key =>  $field)
                        <tr>
                            <th>{{ $key }}</th>
                            <td>{!!  nl2br($item[$field])  !!}</td>
                        </tr>
                    @endforeach
        </table>

        @include('admin.contact.buttons.delete' , ['id' => $item->id])
        @include('admin.contact.buttons.edit' , ['id' => $item->id])

    @endcomponent
@endsection
