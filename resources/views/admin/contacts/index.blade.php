@extends('admin.layouts.skin2')

@section('body')
    @include('admin.contacts.search')

    <table class="table table-hover">
        <thead>
        <tr>
            {{--<th></th>--}}
            <th>Name</th>
            <th>Email</th>
            <th>Email Verified</th>
            <th>Status</th>
            <th>Updated</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->name()}}</a></td>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->email}}</a></td>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->verifiedString()}}</a>
                    <br>{{$contact->email_verified}}
                </td>

                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->getStatus()}}</a></td>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->updated_at->diffForHumans()}}</a></td>
                <td><a href="" onclick="event.preventDefault();
                            document.getElementById('delete_authors_form{{$contact->id}}').submit();"><i
                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>


            <form action="/admin/contacts/{{$contact->id}}" method="POST"
                  id="delete_authors_form{{$contact->id}}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        @endforeach
        </tbody>
    </table>

    <div class="text-align-center">
        {{ $contacts->links() }}
    </div>

    <div class="text-align-center">
        @if(Request::is('*/contacts/no-email-send'))
            <a href="/admin/contacts/send-verification-emails" class="btn btn-primary">Send Verification Emails</a>
        @endif
    </div>

@endsection
