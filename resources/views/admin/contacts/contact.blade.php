<table class="table">
    <thead>
    <tr>
        <th >Name</th>
        <th >Email</th>
        <th >Verified</th>
        <th >Status</th>
        <th >Updated</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->name()}}</a></td>
            <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->email}}</a></td>
            <td ><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->verifiedString()}}</a></td>
            <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->getStatus()}}</a></td>
            <td><a href="/admin/contacts/{{$contact->id}}/edit">{{$contact->updated_at->diffForHumans()}}</a></td>
        </tr>
    </tbody>
</table>