@extends('admin.layouts.skin2')

@section('body')
<dd>
    Total contacts: {{ $import_report['stats']['total_contacts']}}<br>
    Total new contacts added: {{$import_report['stats']['new_contacts']}}
</dd>


<stong>Following contacts already exists in out lists.</stong>
    <table class="table">
        <thead>
        <tr>
            <th >Name</th>
            <th >Email</th>
            <th >Trashed</th>
            <th ></th>
        </tr>
        </thead>

        <tbody>
        @foreach($import_report['existing'] as $list)
            <tr>
                <td><a href="/admin/contacts/{{$list['id']}}/edit">{{$list['first_name'] . ' ' . $list['last_name']}}</a></td>
                <td><a href="/admin/contacts/{{$list['id']}}/edit">{{$list['email']}}</a></td>
                <td><a href="/admin/contacts/{{$list['id']}}/edit">{{$list['trashed']}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>





@endsection
