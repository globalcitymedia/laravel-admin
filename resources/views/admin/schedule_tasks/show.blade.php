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
            <tr>
                <th scope="row">{{$contactList->name}}</th>
                <td></td>
                <td>{{$contactList->getStatus()}}</td>
                <td>{{$contactList->updated_at->diffForHumans()}}</td>
                <th scope="row"><a href="/admin/contact-lists/{{$contactList->id}}/edit">Edit</a></th>
                <td><a href="" onclick="event.preventDefault();
                            document.getElementById('delete_authors_form{{$contactList->id}}').submit();"><i
                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
            <form action="/admin/contact-lists/{{$contactList->id}}" method="POST"
                  id="delete_authors_form{{$contactList->id}}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </tbody>
    </table>
    <hr>

    <div class="col-lg-12 list-group">
        <a class="btn btn-primary" href="/admin/contact-lists/{{$contactList->id}}/contacts">View Contacts</a>
        <a class="btn btn-primary" href="/admin/contact-lists/{{$contactList->id}}/contacts/create">Add Contact</a>
    </div>

@endsection
