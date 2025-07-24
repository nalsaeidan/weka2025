@extends('layouts.app')
@section('title', __('accounts.add_new_account'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('accounts.add_new_account')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
@php
  $form_class = empty($duplicate_account) ? 'create' : '';
@endphp
{!! Form::open(['url' => action('AccountsController@store'), 'method' => 'post', 
    'id' => 'accounts_add_form','class' => 'accounts_form ' . $form_class, 'files' => true ]) !!}
    @component('components.widget', ['class' => 'box-primary'])
      {{-- <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
              {!! Form::hidden('business_id',session()->get('user.business_id'), ['class' => 'form-control', 'required']); !!}
          </div>
        </div>
      </div> --}}
    <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('name', __('accounts.account_name') . ':*') !!}
              {!! Form::text('name', !empty($duplicate_accounts->name) ? $duplicate_accounts->name : null, ['class' => 'form-control', 'required',
              'placeholder' => __('accounts.account_name')]); !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('number', __('accounts.account_number') . ':') !!}
              {!! Form::number('number', !empty($duplicate_accounts->number) ? $duplicate_accounts->number : null, ['class' => 'form-control',
              'placeholder' => __('accounts.account_number')]); !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('type', __('accounts.account_type') . ':') !!}
            <select name="type" class="form-control select2">\
              <option>@lang('messages.please_select')</option>
              <option value="Current Liability">{{"Current Liability"}}</option>
              <option value="Accounts Payable">{{"Accounts Payable"}}</option>
              <option value="Accounts Receivable">{{"Accounts Receivable"}}</option>
              <option value="Asset">{{"Asset"}}</option>
              <option value="Bank">{{"Bank"}}</option>
              <option value="Cash">{{"Cash"}}</option>
              <option value="Equity">{{"Equity"}}</option>
              <option value="Fixed Asset">{{"Fixed Asset"}}</option>
              <option value="Long term liability">{{"Long term liability"}}</option>
              <option value="Other Current Asset">{{"Other Current Asset"}}</option>
              <option value="Stock">{{"Stock"}}</option>
            </select>
          </div>
        </div>
        {{-- <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('type', __('accounts.account_type') . ':*') !!}
              {!! Form::text('type', !empty($duplicate_accounts->type) ? $duplicate_accounts->type : null, ['class' => 'form-control', 'required',
              'placeholder' => __('accounts.account_type')]); !!}
          </div>
        </div> --}}

        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('accounts_id', __('accounts.account_id') . ':') !!}
            <select name="accounts_id" class="form-control select2">\
              <option>@lang('messages.please_select')</option>
              @foreach($accounts as $account)
                      <option value="{{$account->id}}">{{$account->name}}</option>
              @endforeach
          
            </select>
        
          </div>
        </div>

        <div class="col-sm-8">
          <div class="form-group">
            {!! Form::label('description', __('accounts.description') . ':') !!}
              {!! Form::textarea('description', !empty($duplicate_accounts->description) ? $duplicate_accounts->description : null, ['class' => 'form-control']); !!}
            </div>
          </div>

      </div>
        
    @endcomponent

    <div class="row">
    <div class="col-sm-12">
      <div class="text-center">
          <button type="submit" value="submit" class="btn btn-primary submit_product_form">@lang('messages.save')</button>
          {{-- <button type="submit" value="submit" class="btn btn-primary submit_product_form">@lang('messages.save')</button> --}}
      
      </div>
    </div>
  </div>
{!! Form::close() !!}
  
</section>
<!-- /.content -->

@endsection

  {{-- @section('javascript')
  <script type="text/javascript">
    __page_leave_confirmation('#accounts_add_form');

  $('form#accounts_add_form').validate({
    rules: {
        name: {
            required: true,
        },
        type: {
            required: true,
        },
    },
});
</script>
@endsection --}}
