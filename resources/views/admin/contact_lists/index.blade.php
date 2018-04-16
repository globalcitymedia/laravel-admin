@extends('admin.layouts.skin2')

@section('body')


    <table class="table">
        <thead>
        <tr>
            <th >Name</th>
            <th >Contacts count</th>
            <th >Status</th>
            <th >Updated</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($contact_lists as $list)
            <tr>
                <th scope="row"><a href="/admin/contact-lists/{{$list->id}}/edit">{{$list->name}}</a></th>
                <td></td>
                <td><a href="/admin/contact-lists/{{$list->id}}/edit">{{$list->getStatus()}}</a></td>
                <td><a href="/admin/contact-lists/{{$list->id}}/edit">{{$list->updated_at->diffForHumans()}}</a></td>
                <td><a href="" onclick="event.preventDefault();
                            document.getElementById('delete_authors_form{{$list->id}}').submit();"><i
                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
            <form action="/admin/contact-lists/{{$list->id}}" method="POST"
                  id="delete_authors_form{{$list->id}}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        @endforeach
        </tbody>
    </table>

    <div class="text-align-center">
        {{ $contact_lists->links() }}
    </div>



@endsection
