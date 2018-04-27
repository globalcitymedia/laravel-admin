<table class="table">
    <thead>
    <tr>
        <th >List Name</th>
        <th >No of Contacts</th>
        <th >Status</th>
        <th >Updated</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <th scope="row"><a href="/admin/contact-lists/{{$selected_contact_list->id}}/contacts">{{$selected_contact_list->name}}</a></th>
        <td></td>
        <td><a href="/admin/contact-lists/{{$selected_contact_list->id}}/contacts">{{$selected_contact_list->getStatus()}}</a></td>
        <td><a href="/admin/contact-lists/{{$selected_contact_list->id}}/contacts">{{$selected_contact_list->updated_at->diffForHumans()}}</a></td>
        <th scope="row"><a href="/admin/contact-lists/{{$selected_contact_list->id}}/edit">Edit</a></th>
    </tr>

    </tbody>
</table>
<hr>

