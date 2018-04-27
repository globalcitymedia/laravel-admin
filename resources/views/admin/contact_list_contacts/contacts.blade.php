@extends('admin.layouts.skin2')

@section('body')

    @include('admin.contact_lists.contact_list')

    <div class="col-lg-12 list-group">
        <a class="btn btn-primary" href="/admin/contact-lists/{{$selected_contact_list->id}}/contacts">View Contacts</a>
        <a class="btn btn-primary" href="/admin/contact-lists/{{$selected_contact_list->id}}/contacts/create">Add Contact</a>
        <a class="btn btn-primary" href="/admin/contact-lists/{{$selected_contact_list->id}}/contacts/create">Add Contact</a>
    </div>

    <?php $contacts = $selected_contact_list->contacts()->get(); ?>
    <table class="table">
        <thead>
        <tr>
            {{--<th></th>--}}
            <th >Name</th>
            <th >Email</th>
            <th >Verified</th>
            <th >Status</th>
            <th >Updated</th>
        </tr>
        </thead>
        <tbody>

        @foreach($contacts as $contact)
            <tr>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->name()}}</a></td>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->email}}</a></td>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->verifiedString()}}</a></td>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->getStatus()}}</a></td>
                <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->updated_at->diffForHumans()}}</a></td>
            </tr>

        @endforeach
        </tbody>
    </table>



@endsection
