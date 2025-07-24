@extends('layouts.app')
@section('title', __('restricts.add_new_restrict'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('restricts.add_new_restrict')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
@php
  $form_class = empty($duplicate_restrict) ? 'create' : '';
@endphp
{!! Form::open(['url' => action('RestrictController@store'), 'method' => 'post', 
    'id' => 'restrict_add_form','class' => 'restrict_form ' . $form_class, 'files' => true ]) !!}
    @component('components.widget', ['class' => 'box-primary'])
      
     <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
                {!! Form::label('operation_date', __( 'messages.date' ) .":*") !!}
                <div class="input-group date" id='od_datetimepicker'>
                  {!! Form::text('operation_date', 0, ['class' => 'form-control', 'required','placeholder' => __( 'messages.date' ) ]); !!}
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('reference_number', __('restricts.reference_number') . ':') !!}
              {!! Form::number('reference_number',null, ['class' => 'form-control',
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
            {!! Form::textarea('notes',null, ['class' => 'form-control','rows'=>6]); !!}
          </div>
        </div>



            {{-- تجريب الadd more  --}}

            <table class="table table-bordered" id="dynamicAddRemove">
              <tr>
                  <th>رقم الحساب</th>
                  <th>وصف القيد</th>
                  <th>المدين</th>
                  <th>الدائن </th>
                  <th>الخيار</th>

              </tr>
              <tr>
                
                  <td class="col-md-3">
                    <div class="form-group">
                      <select id="moreFields[0][account_number1]" name="moreFields[0][account_number1]" class="form-control @error('moreFields[0][account_number1]') is-invalid @enderror">
                        <option class="form-control select2" value=''>اختر اسم الحساب  </option>
                        @foreach ($accounts as $account)
                          <option class="form-control select2" value="{{$account->id}}" > {{$account->name}} </option>
                        @endforeach
                      </select>

                    </div>
                  </td >
                  <td class="col-md-3">
                    <div class="form-group">
                      <textarea rows="1" type="text" class="form-control @error('moreFields[0][description1]') is-invalid" @enderror placeholder="الوصف " name="moreFields[0][description1]" > {{old('moreFields[0][description1]')}}</textarea>
                        @error('moreFields[0][description1]')
                          <p class="invalid-feedback">{{$message}}</p>
                        @enderror                      
                    </div>
                  </td>

                  <td class="col-md-3">
                    <div class="form-group">                      
                      <input  type="number" class="form-control crc  @error('moreFields[0][credit1]') is-invalid" @enderror placeholder="__('restricts.debit')" name="moreFields[0][credit1]"  value="0"/>
                      @error('moreFields[0][credit1]')
                      <p class="invalid-feedback">{{$message}}</p>
                      @enderror
                    </div>
                  </td>


                  <td class="col-md-3">
                    <div class="form-group"> 
                      <input  type="number" class="form-control prc  @error('moreFields[0][debit1]') is-invalid" @enderror placeholder="__('restricts.debit')" name="moreFields[0][debit1]"  value="0"/>
                      @error('moreFields[0][debit1]')
                      <p class="invalid-feedback">{{$message}}</p>
                      @enderror
    
                      
                   </div>
                  </td>

                  <td><button type="button" name="add" id="add-btn" class="btn btn-success">سطر جديد</button></td>
              </tr>
            
              <tfoot>
               <tr>
                  <td></td>
                  <th>المجموع </th>
                  <td><output hidden id="result1" type="number" class="form-control prc  @error('debits') is-invalid" @enderror placeholder="__('restricts.debit')" name="debits"  value="0"/>
                      @error('credits')
                      <p class="invalid-feedback">{{$message}}</p>
                      @enderror</td>
                  <td><output hidden id="result" type="number" class="form-control prc  @error('debits') is-invalid" @enderror placeholder="__('restricts.debit')" name="debits"  value="0"/>
                      @error('debits')
                      <p class="invalid-feedback">{{$message}}</p>
                      @enderror</td></output></td>

              </tr>
              </tfoot>
          </table>



      <div class="clearfix"></div>
				<div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('document', __('purchase.attach_document') . ':') !!}
                        {!! Form::file('file', ['id' => 'file', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
                        <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                        @includeIf('components.document_help_text')</p></small>
                    </div>
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

 @section('javascript')

<script type="text/javascript">
  $(document).ready( function(){
    $('#od_datetimepicker').datetimepicker({
      format: moment_date_format + ' ' + moment_time_format
    });
  });
</script>

<script type="text/javascript">
  var i = 0;
  var x = 1;
  $("#add-btn").click(function(){ 
    i++;
    x++;     
      $("#dynamicAddRemove").append('' +
          '<tr>' +
          '<td>' +
            '<div class="form-group">'+
              '<select id="moreFields['+i+'][account_number'+x+']" name="moreFields['+i+'][account_number'+x+']" class="form-control">'+
                        '@foreach ($accounts as $account)'+
                          '<option class="form-control select2" value="{{$account->id}}" > {{$account->name}} </option>'+
                        '@endforeach'+
              '</select>'+
            '</div>'+
          '</td>' +
          '<td>' +
            '<div class="form-group">' +  
              '<textarea type="text" class="form-control" placeholder="الوصف " name="moreFields['+i+'][description'+x+']" rows="1"> </textarea>'+                   
            '</div>' +
          '</td>' +
          
          '<td>' +
            '<div class="form-group">'+
              '<input type="number" class="form-control crc"  placeholder="" name="moreFields['+i+'][credit'+x+']"  value="0" />'+                                             
            '</div>'+
          '</td>' +

          '<td>' +
            '<div class="form-group">'+ 
              '<input type="number" class="form-control prc"  placeholder="" name="moreFields['+i+'][debit'+x+']"  value="0" />'+                      
            '</div>'+
          '</td>' +
          
          '<td>' +
          '<button type="button" class="btn btn-danger remove-tr">حذف</button>' +
          '</td>' +
          '</tr>'
          ); 
  });
  $(document).on('click', '.remove-tr', function(){
      $(this).parents('tr').remove();
  });
</script>

<script>
$('#dynamicAddRemove').on('input','.prc',function(){
  var sum = 0;
  $('.form-group .prc').each(function(){
    var inputVal = $(this).val();
    if($.isNumeric(inputVal)){
      sum += parseFloat(inputVal);
    }
  });
      $('#result').val(sum);

});
</script>
<script>
$('#dynamicAddRemove').on('input','.crc',function(){
  var sum = 0;
  $('.form-group .crc').each(function(){
    var inputVal = $(this).val();
    if($.isNumeric(inputVal)){
      sum += parseFloat(inputVal);
    }
  });
      $('#result1').val(sum);

});
</script>


  
@endsection 
