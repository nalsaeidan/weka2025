@extends('layouts.app')

@section('title', __( 'accounts.edit_account' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'accounts.edit_account' )</h1>
</section>

<!-- Main content -->
<section class="content">
    {!! Form::open(['url' => action('AccountsController@update', [$account->id]), 'method' => 'PUT', 'id' => 'account_edit_form' ]) !!}
    <div class="row">
        <div class="col-md-12">
          @component('components.widget', ['class' => 'box-primary'])
          <div class="col-sm-6">
            <div class="form-group">
              {!! Form::label('name', __('accounts.account_name') . ':*') !!}
                {!! Form::text('name', $account->name, ['class' => 'form-control', 'required',
                'placeholder' => __('accounts.account_name')]); !!}
            </div>
          </div>
          
          
          <div class="col-sm-6">
            <div class="form-group">
              {!! Form::label('number', __('accounts.account_number') . ':') !!}
                {!! Form::number('number',$account->number, ['class' => 'form-control',
                  'placeholder' => __('accounts.account_number')]); !!}
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              {!! Form::label('type', __('accounts.account_type') . ':') !!}
              <select name="type" class="form-control select2">\
                <option value="">@lang('messages.please_select')</option>
                <option value="Current Liability" {{$account->type == 'Current Liability'?'selected': ''}}>{{"Current Liability"}}</option>
                <option value="Accounts Payable" {{$account->type == 'Accounts Payable'?'selected': ''}}>{{"Accounts Payable"}}</option>
                <option value="Accounts Receivable" {{$account->type=="Accounts Receivable"?'selected': ''}}>{{"Accounts Receivable"}}</option>
                <option value="Asset" {{ old('type',$account->type)=="Asset"?'selected': ''}}>{{"Asset"}}</option>
                <option value="Bank" {{ old('type',$account->type)=="Bank"?'selected': ''}}>{{"Bank"}}</option>
                <option value="Cash" {{ old('type',$account->type)=="Cash"?'selected': ''}}>{{"Cash"}}</option>
                <option value="Equity" {{ old('type',$account->type)=="Equity"?'selected': ''}}>{{"Equity"}}</option>
                <option value="Fixed Asset" {{ old('type',$account->type)=="Fixed Asset"?'selected': ''}}>{{"Fixed Asset"}}</option>
                <option value="Long term liability" {{ $account->type == 'Long term liability'?'selected': ''}}>{{"Long term liability"}}</option>
                <option value="Other Current Asset" {{ $account->type == 'Other Current Asset'?'selected': ''}}>{{"Other Current Asset"}}</option>
                <option value="Stock" {{ old('type',$account->type)=="Stock"?'selected': ''}}>{{"Stock"}}</option>
              </select>
            </div>
          </div>
  
          <div class="col-sm-6">
            <div class="form-group">
              {!! Form::label('accounts_id', __('accounts.account_id') . ':') !!}
              <select name="accounts_id" class="form-control select2">\
                <option>@lang('messages.please_select')</option>
                @foreach($accounts as $aaccount)
                        <option value="{{$aaccount->id}}" {{old('accounts_id',$account->accounts_id)== $aaccount->id?"selected":""}}>{{$aaccount->name}}</option>
                @endforeach
            
              </select>
          
            </div>
          </div>
  
          <div class="col-sm-8">
            <div class="form-group">
              {!! Form::label('description', __('accounts.description') . ':') !!}
                {!! Form::textarea('description', $account->description , ['class' => 'form-control']); !!}
            </div>
          </div>

          <div class="col-md-4">
                <div class="form-group">
                  <div class="checkbox">
                    <br>
                    <label>
                         {!! Form::checkbox('is_active', $account->account_status, $is_checked_checkbox, ['class' => 'input-icheck status']); !!} {{ __('lang_v1.status_for_user') }}
                    </label>
                    @show_tooltip(__('lang_v1.tooltip_enable_user_active'))
                  </div>
                </div>
          </div>
  
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary pull-right" id="submit_user_button">@lang( 'messages.update' )</button>
        </div>
    </div>
    {!! Form::close() !!}
  @stop
