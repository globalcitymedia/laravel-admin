@if(isset($audit))
    <table class="table table-responsive-md table-hover ">
        <thead>
        <tr>
            <th>contact_id</th>
            <th>ip_address</th>
            <th>desc</th>
            <th>created_at</th>
            <th>created_by</th>
        </tr>
        </thead>
        <tbody>

        @foreach($audit as $item)
            <tr>
                <td>{{$item->contact_id}}</td>
                <td>{{$item->ip_address}}</td>
                <td>{{$item->desc}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->created_by}}</td>
            </tr>
        @endforeach


        </thead>
    </table>
@endif