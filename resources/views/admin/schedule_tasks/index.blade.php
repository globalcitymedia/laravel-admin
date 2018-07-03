@extends('admin.layouts.skin2')

@section('body')


    <table class="table">
        <thead>
        <tr>
            <th>Date {{date_format(new DateTime(), 'Y-m-dH:i')}}</th>
            <th>Template</th>
            <th>Contacts</th>
            <th>Scheduled at</th>
            <th>Sent at</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list_items as $item)

            @if($item->getSentAt() == null)

                <tr>
                    <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->created_at->toFormattedDateString()}}</a>
                    </td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->template->name}}</a></td>
                    <td>
                        <a href="{{$admin_url.'/'.$item->id}}/edit">
                            <?php $contactLists = $item->contactLists ?>
                            @if(sizeof($contactLists))
                                @foreach($contactLists as $contactList)
                                    {{$contactList->display_name}}<br>
                                @endforeach
                            @endif
                        </a>
                    </td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->scheduled_at->toDayDateTimeString()}}</a>
                    </td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->getSentAt()}}</a></td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/edit">{{$item->getStatus()}}</a></td>
                    <td><a @if($item->getSentAt()):{{"readonly=readonly" }}@endif;
                           href="{{$admin_url.'/'.$item->id}}/edit">Edit</a></td>
                    <td><a href="" onclick="event.preventDefault();
                                document.getElementById('delete_authors_form{{$item->id}}').submit();"><i
                                    class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <form class="delete" action="{{$admin_url.'/'.$item->id}}" method="POST"
                      id="delete_authors_form{{$item->id}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

            @else

                <tr>
                    <td><a href="{{$admin_url.'/'.$item->id}}/show">{{$item->created_at->toFormattedDateString()}}</a>
                    </td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/show">{{$item->template->name}}</a></td>
                    <td>
                        <a href="{{$admin_url.'/'.$item->id}}/show">
                            <?php $contactLists = $item->contactLists ?>
                            @if(sizeof($contactLists))
                                @foreach($contactLists as $contactList)
                                    {{$contactList->display_name}}<br>
                                @endforeach
                            @endif
                        </a>
                    </td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/show">{{$item->scheduled_at->toDayDateTimeString()}}</a>
                    </td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/show">{{$item->getSentAt()}}</a></td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/show">{{$item->getStatus()}}</a></td>
                    <td><a href="{{$admin_url.'/'.$item->id}}/show">View</a></td>
                    <td>
                    </td>
                </tr>

            @endif

        @endforeach
        </tbody>
    </table>

    <div class="text-align-center">
        {{ $list_items->links() }}
    </div>
    <div class="text-align-center">
        <a href="/admin/schedule-tasks/dispatch" class="btn btn-primary">Dispatch</a>
    </div>
@endsection
