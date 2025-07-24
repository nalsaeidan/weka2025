@extends('layouts.app')
@section('title', __('restricts.edit_restrict'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('restricts.edit_restrict')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
{{-- @php
  $form_class = empty($duplicate_restrict) ? 'create' : '';
@endphp --}}
{!! Form::open(['url' => action('RestrictController@update', [$restrict->id]), 'method' => 'PUT', 'id' => 'restrict_edit_form' ]) !!}
    @component('components.widget', ['class' => 'box-primary'])
      
     <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('date', __('restricts.date') . ':*') !!}
              {!! Form::date('date',$restrict->date, ['class' => 'form-control', 'required',
              'placeholder' => __('restricts.date')]); !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('reference_number', __('restricts.reference_number') . ':') !!}
              {!! Form::number('reference_number',$restrict->reference_number, ['class' => 'form-control',
              'placeholder' => __('restricts.reference_number')]); !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('currency_id', __('restricts.currency_id') . ':') !!}
            <select name="currency_id" class="form-control select2">\
              <option>@lang('messages.please_select')</option>
              @foreach($currencies as $currency)
                      <option value="{{$currency->country}}{{" - "}}{{$currency->currency}}{{"("}}{{$currency->code}}{{")"}}">{{"$currency->country - $currency->currency ($currency->code)"}}</option>
              @endforeach
          
            </select>
        
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('notes', __('restricts.notes') . ':') !!}
            {!! Form::textarea('notes',$restrict->notes, ['class' => 'form-control','rows'=>6]); !!}
          </div>
        </div>



            <div class=" col-sm-3">
              <div class="form-group">
              {!! Form::label('accounts_number', __('restricts.account_number') . ':') !!}
              {{-- {!! Form::hidden('accounts_number',null, ['class' => 'form-control',
              'value' => null]); !!} --}}
          
              </div>
            </div>

            <div class=" col-sm-3">
              <div class="form-group">
              {!! Form::label('description', __('restricts.description') . ':') !!}
              {{-- {!! Form::hidden('description',null, ['class' => 'form-control',
              'value' => null]); !!} --}}
              </div>
            </div>

            <div class=" col-sm-3">
              <div class="form-group">
              {!! Form::label('debit', __('restricts.debit') . ':') !!}
              {{-- {!! Form::hidden('debit',null, ['class' => 'form-control',
              'value' => null]); !!} --}}
              </div>
            </div>

            <div class=" col-sm-3">
              <div class="form-group">
              {!! Form::label('credit', __('restricts.credit') . ':') !!}
              {{-- {!! Form::hidden('credit',null, ['class' => 'form-control',
              'value' => null]); !!} --}}
              </div>
            </div>

           
                    
                    <div class="col-md-3">
                      <div class="form-group">
                      <select name="account_number1" class="form-control select2">\
                        <option>@lang('messages.please_select')</option>
                        @foreach($accounts as $account)
                                <option value="{{$account->number}}" {{old('account_number1',$restrict->account_number1) == $account->number ?"selected":""}} >{{$account->number}}</option>
                        @endforeach
                    
                      </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">                      
                        {!! Form::textarea('description1',$restrict->description1, ['class' => 'form-control','rows' => 1]); !!}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">                       
                         {!! Form::number('debit1',$restrict->debit1, ['class' => 'form-control',
                        'placeholder' => __('restricts.debit')]); !!}
                      </div>
                    </div>
             
                    <div class="col-md-3">
                      <div class="form-group">                      
                        {!! Form::number('credit1',$restrict->credit1, ['class' => 'form-control',
                      'placeholder' => __('restricts.credit')]); !!}
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group">                    
                        <select name="account_number2" class="form-control select2">\
                          <option>@lang('messages.please_select')</option>
                          @foreach($accounts as $account)
                                  <option value="{{$account->number}}" {{old('account_number2',$restrict->account_number2) == $account->number ?"selected":""}} >{{$account->number}}</option>
                          @endforeach
                    
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">                      
                        {!! Form::textarea('description2',$restrict->description2, ['class' => 'form-control','rows' => 1]); !!}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        {!! Form::number('debit2', $restrict->debit2, ['class' => 'form-control',
                        'placeholder' => __('restricts.debit')]); !!}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">                      
                        {!! Form::number('credit2', $restrict->credit2, ['class' => 'form-control',
                      'placeholder' => __('restricts.credit')]); !!}
                      </div>
                    </div>


                    <div class="form-group col-sm-3">
                      <select name="account_number3" class="form-control select2">\
                        <option>@lang('messages.please_select')</option>
                        @foreach($accounts as $account)
                                <option value="{{$account->number}}" {{old('account_number3',$restrict->account_number3) == $account->number ?"selected":""}} >{{$account->number}}</option>
                        @endforeach
                    
                      </select>
                    </div>
                
                    <div class="form-group col-sm-3">
                      {!! Form::textarea('description3',$restrict->description3, ['class' => 'form-control','rows' => 1]); !!}
                    </div>
           
                    <div class="form-group col-sm-3">
                      {!! Form::number('debit3', $restrict->debit3, ['class' => 'form-control',
                        'placeholder' => __('restricts.debit')]); !!}
                    </div>
                 
                    <div class="form-group col-sm-3">
                      {!! Form::number('credit3', $restrict->credit3, ['class' => 'form-control',
                      'placeholder' => __('restricts.credit')]); !!}
                    </div>



                    <div class="form-group col-sm-3">
                      <select name="account_number4" class="form-control select2">\
                        <option>@lang('messages.please_select')</option>
                        @foreach($accounts as $account)
                                <option value="{{$account->number}}"  {{old('account_number4',$restrict->account_number4) == $account->number ?"selected":""}}>{{$account->number}}</option>
                        @endforeach
                    
                      </select>
                    </div>
                
                    <div class="form-group col-sm-3">
                      {!! Form::textarea('description4',$restrict->description4, ['class' => 'form-control','rows' => 1]); !!}
                    </div>
           
                    <div class="form-group col-sm-3">
                      {!! Form::number('debit4', $restrict->debit4, ['class' => 'form-control',
                        'placeholder' => __('restricts.debit')]); !!}
                    </div>
                 
                    <div class="form-group col-sm-3">
                      {!! Form::number('credit4', $restrict->credit4, ['class' => 'form-control',
                      'placeholder' => __('restricts.credit')]); !!}
                    </div>


                    <div class="form-group col-sm-3">
                      <select name="account_number5" class="form-control select2">\
                        <option>@lang('messages.please_select')</option>
                        @foreach($accounts as $account)
                                <option value="{{$account->number}}" {{old('account_number5',$restrict->account_number5) == $account->number ?"selected":""}} >{{$account->number}}</option>
                        @endforeach
                    
                      </select>
                    </div>
                
                    <div class="form-group col-sm-3">
                      {!! Form::textarea('description5',$restrict->description5, ['class' => 'form-control','rows' => 1]); !!}
                    </div>
           
                    <div class="form-group col-sm-3">
                      {!! Form::number('debit5', $restrict->debit5, ['class' => 'form-control',
                        'placeholder' => __('restricts.debit')]); !!}
                    </div>
                 
                    <div class="form-group col-sm-3">
                      {!! Form::number('credit5', $restrict->credit5, ['class' => 'form-control',
                      'placeholder' => __('restricts.credit')]); !!}
                    </div>
                
                
                {{-- <tr>
                    <th></th>
                    <th>{{"المجموع الكلي :"}}</th>

                  
                    <th>{{"00"}}</th>
                    <th>{{"00"}}</th>

                  
                </tr>
                <tr>
                  <th></th>
                  <th>{{" مجموع الفرق :"}}</th>

                
                  <th>{{"00"}}</th>
                  <th>{{"00"}}</th>

                
              </tr> 
                
              </tbody>
          </table> --}}

      <div class="clearfix"></div>
				<div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('document', __('purchase.attach_document') . ':') !!}
                        {!! Form::file('file', ['id' => 'file', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
                        <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                        @includeIf('components.document_help_text')</p></small>
                    </div>
                    {{-- <p>{{$restrict->file}}</p> --}}
        </div>
        
    @endcomponent

    <div class="row">
      <div class="col-sm-12">
        <div class="text-right">
            <button type="submit" value="submit" class="btn btn-primary submit_product_form">@lang('messages.save')</button>
        
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
