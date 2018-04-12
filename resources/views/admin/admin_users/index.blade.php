@extends('admin.layouts.skin2')

@section('body')
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th class="hidden-xs">Updated</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row"><a
                            href="/admin/admin_users/{{$user->id}}/edit">{{$user->first_name}} {{$user->last_name}}</a>
                </th>
                <td><a href="/admin/admin_users/{{$user->id}}/edit">{{$user->email}}</a></td>
                <td>
                    <a href="/admin/admin_users/{{$user->id}}/edit">{{$user->getUserStatus($user->status)}}</a>
                </td>
                <td class="hidden-xs">
                    <a href="/admin/admin_users/{{$user->id}}/edit">{{$user->updated_at->diffForHumans()}}</a>
                </td>
                <td>

                    <a href="" onclick="event.preventDefault();
                            document.getElementById('delete_admin_user_form{{$user->id}}').submit();"><i
                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <form action="/admin/admin_users/{{$user->id}}" method="POST"
                          id="delete_admin_user_form{{$user->id}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-align-center">
        {{ $users->links() }}
    </div>





@endsection