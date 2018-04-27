@extends('admin.layouts.skin2')

@section('body')

    @include('admin.contacts.contact');

    <table class="table">
        <thead>
        <tr>
            <th>contact_id</th>
            <th>ip_address</th>
            <th>desc</th>
            <th>created_at</th>
        </tr>
        </thead>
        <tbody>

        @foreach($audit as $item)
            <tr>
                <td>{{$item->contact_id}}</td>
                <td>{{$item->ip_address}}</td>
                <td>{{$item->desc}}</td>
                <td>{{$item->created_at}}</td>
            </tr>
        @endforeach


        </thead>
    </table>

@endsection