{{--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>--}}


<div class="form-group col-lg-6 clearfix">
    {!! Form::label('name', 'Template name') !!}
    {!! Form::text('name', null ,['class' => 'form-control' ]) !!}
</div>
<div class="form-group col-lg-6 clearfix">
    {!! Form::label('subject', 'Subject') !!}
    {!! Form::text('subject', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('from_address', 'From address') !!}
    {!! Form::text('from_address', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('display_name', 'Display name') !!}
    {!! Form::text('display_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',config('variables.status'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-lg-12 clearfix">
    {!! Form::label('email_body', 'Email body') !!}
    {!! Form::textarea('email_body', null ,['class' => 'form-control' ]) !!}
</div>


<div class="form-group clearfix col-lg-12">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>

<script>
    tinymce.init({
        selector: 'textarea',
        height: 500,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste imagetools wordcount"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        // imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
    });
</script>
{{--<script>--}}
    {{--tinymce.init({--}}
        {{--selector: 'textarea',--}}
        {{--height: 500,--}}
        {{--theme: 'modern',--}}
        {{--plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',--}}
        {{--toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',--}}
        {{--image_advtab: true,--}}
        {{--templates: [--}}
            {{--{ title: 'Test template 1', content: 'Test 1' },--}}
            {{--{ title: 'Test template 2', content: 'Test 2' }--}}
        {{--],--}}
        {{--content_css: [--}}
            {{--'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',--}}
            {{--'//www.tinymce.com/css/codepen.min.css'--}}
        {{--]--}}
    {{--});--}}
{{--</script>--}}
{{--<textarea>Next, get a free Cloud API key!</textarea>--}}


{{--<script>--}}
{{--$(document).ready(function () {--}}
{{--CKEDITOR.replace('email_body');--}}
{{--});--}}
{{--</script>--}}

{{--<script>--}}
{{--$(document).ready(function () {--}}
{{--CKEDITOR.replace('email_body');--}}
{{--});--}}
{{--</script>--}}