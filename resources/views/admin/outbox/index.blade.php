@extends('admin.layouts.skin2')

@section('body')


    <table class="table">
        <thead>
        <tr>
            {{--$table->integer('schedule_task_id')->unsigned()->nullable();--}}

            {{--$table->integer('locked_email_template_id')->unsigned()->nullable();--}}

            {{--$table->string('template_name')->nullable();--}}
            {{--$table->string('subject')->nullable();--}}
            {{--$table->text('email_body')->nullable();--}}
            {{--$table->string('from_address')->nullable();--}}
            {{--$table->string('display_name')->nullable();--}}

            {{--$table->integer('contact_id')->unsigned()->nullable();--}}
            {{--$table->string('first_name')->nullable();--}}
            {{--$table->string('last_name')->nullable();--}}
            {{--$table->string('email')->nullable();--}}
            {{--$table->string('id_key')->nullable();--}}


            <th>email</th>
            <th>fullname</th>
            <th>template</th>
            <th>task id</th>
            <th>created</th>

        </tr>
        </thead>
        <tbody>
        @foreach($outbox as $item)
            <tr>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->email}}</a></td>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->first_name}} {{$item->last_name}}</a></td>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->template_name}}</a></td>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->schedule_task_id}}</a></td>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->created_at}}</a></td>
            </tr>

        @endforeach
        </tbody>
    </table>

    <div class="text-align-center">
        {{ $outbox->links() }}
    </div>

    <div class="text-align-center">
        <a href="/admin/outbox/dispatch" class="btn btn-primary">Dispatch</a>
    </div>

@endsection
