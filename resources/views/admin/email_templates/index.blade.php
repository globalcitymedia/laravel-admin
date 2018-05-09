@extends('admin.layouts.skin2')

@section('body')


    <table class="table">
        <thead>
        <tr>
            <th >Name</th>
            <th>Subject</th>
            <th >Status</th>
            <th >Updated</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($list_items as $item)
            <tr>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->name}}</a></td>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->subject}}</a></td>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->getStatus()}}</a></td>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->updated_at->diffForHumans()}}</a></td>
                <td><a href="{{$admin_url.'/'.$item->id}}/edit">Edit</a></td>
                <td><a href="" onclick="event.preventDefault();
                            document.getElementById('delete_authors_form{{$item->id}}').submit();"><i
                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
            <form action="{{$admin_url.'/'.$item->id}}" method="POST"
                  id="delete_authors_form{{$item->id}}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        @endforeach
        </tbody>
    </table>

    <div class="text-align-center">
        {{ $list_items->links() }}
    </div>


@endsection