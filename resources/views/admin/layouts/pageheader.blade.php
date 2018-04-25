<h1 class="page-header">
    {{$page_title}}
    {{--<span class="right">Subheading</span>--}}
</h1>
<ol class="breadcrumb col-lg-6">
    <li>
        <a href="{{url('/admin')}}"><i class="fa fa-home"></i> Home</a>
    </li>
    @foreach($breadcrums as $breadcrum)

        <li class="active">
            @if($breadcrum['url'] == '')
                {{$breadcrum['title']}}
            @else
                <a title="{{$breadcrum['title']}}" href="{{url($breadcrum['url'])}}">{{$breadcrum['title']}}</a>
            @endif
        </li>
    @endforeach
</ol>
<ul class=" list col-lg-6 text-right">
    @if(isset($object_name) && !Request::is('*create'))
    <li>
        <a href="{{url('/admin/'.$object_name.'/create')}}"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
    </li>
    @endif
    @if(isset($object_name) && $object_name == 'contacts' && Request::is('*edit'))
    <li>
        <a class="btn" href="/admin/contacts/{{$contact->id}}/audit"><i class="fa fa-history" aria-hidden="true"></i> Audit history</a>
    </li>
    @endif

</ul>
