<div class="form-group col-lg-6 clearfix">
    {!! Form::label('first_name', 'First name') !!}
    {!! Form::text('first_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('last_name', 'Last name') !!}
    {!! Form::text('last_name', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('work_type', 'Work type') !!}
    {!! Form::select('work_type',config('variables.work_type'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('company', 'Company name') !!}
    {!! Form::text('company', null ,['class' => 'form-control' ]) !!}
</div>

<div class="form-group col-lg-6 clearfix">
    {!! Form::label('country', 'Country') !!}
    {!! Form::select('country',config('variables.countries'),null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-lg-12 ">
    <h4><strong>Frequency of updates</strong></h4>
</div>
@foreach($contact_lists as $contact_list)
    <div class="form-group col-lg-12  form-check">
        @if(isset($contact))
            <?php $selected_list = $contact->contactLists ?>
            {!! Form::checkbox('contact_lists[]', $contact_list->id, $selected_list->contains($contact_list->id) ? 'true' : null,['class' => 'form-check-input']) !!}
        @else
            {!! Form::checkbox('contact_lists[]', $contact_list->id, null,['class' => 'form-check-input']) !!}
        @endif
        <label style="display: contents;" for="contact_lists">{!! $contact_list->display_name !!}</label><br>
        {{--<label style="display: contents; margin-top: 10px;" for="contact_lists">{!! $contact_list->description !!}</label>--}}
    </div>
@endforeach


<div class="form-group col-lg-12 ">
    <p style="margin-top:20px; padding-top: 10px; border-top:1px solid #f5f5f5;">
    <h4>Data protection</h4><br>
    Global City Media will use your contact details to contact you regarding The Global Legal Post, including your
    subscription renewals, reader research and other related products or events. In addition we will send you
    information about our other relevant products and services. If you wish to receive this please indicate
    below
    </p>
</div>

<div class="form-group col-lg-12  form-check">
    <?php   $glp_pro_list = '4'; ?>
    @if(isset($contact))
        <?php   $selected_list = $contact->contactLists;   ?>
        {!! Form::checkbox('contact_lists[]', $glp_pro_list, $selected_list->contains($glp_pro_list) ? 'true' : null,['class' => 'form-check-input']) !!}
    @else
        {!! Form::checkbox('contact_lists[]', $glp_pro_list, null,['class' => 'form-check-input']) !!}
    @endif
    I wish to receive information about other Global Legal Post products and services
</div>

<div class="form-group col-lg-12 ">
    <p>
        Global City Media may also allow other carefully selected third parties to contact you about their products and
        service. If you do not wish to receive this information please tick the relevant boxes. If you do not opt out we
        will assume you wish to receive third party emails (carefully selected by us). Thank you.
    </p>
</div>

<div class="form-group col-lg-12  form-check">
    <?php   $glp_third_party_list = '5';
    ?>
    @if(isset($contact))
        <?php   $selected_list = $contact->contactLists;   ?>
        {!! Form::checkbox('contact_lists[]', $glp_third_party_list, $selected_list->contains($glp_third_party_list) ? 'true' : null,['class' => 'form-check-input']) !!}
    @else
        {!! Form::checkbox('contact_lists[]', $glp_third_party_list, null,['class' => 'form-check-input']) !!}
    @endif
    I am happy to receive carefully selected third party information
</div>

<div class="form-group col-lg-12 ">
    <p>All email updates are free of charge.</p>
</div>

<div class="form-group clearfix col-lg-12 g-recaptcha"
     data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
</div>

<div class="form-group clearfix col-lg-12">
    @if(isset($tkn))
        <input type="hidden" name="tkn" value="{{$tkn}}">
    @endif

    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control' ]) !!}
</div>

