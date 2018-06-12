@if (count($errors) > 0 )
    <ul class="alert alert-danger" style="clear: both;">

        @foreach($errors->all() as $error)

            @if($error == 'The email has already been taken.')
                <li>{{ $error }} <a href="/send-email-to-manage-preferences">Click here to manage your preferences</a>
                </li>
            @else
                <li>{{ $error }}</li>
            @endif

        @endforeach
    </ul>

@endif

