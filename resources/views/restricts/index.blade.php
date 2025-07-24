@extends('layouts.app')

@section('title', __( 'restricts.restricts' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'restricts.restricts' )
        <small>@lang( 'restricts.manage_your_restrict' )</small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'restricts.all_restricts' )])
         @can('restrict.create')
            @slot('tool')
                <div class="col-md-2">
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary" 
                        href="{{action('RestrictController@create')}}" >
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                    </div>
                </div>
            @endslot

        @endcan 
              
        {{-- @can('account.view')
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="accounts_table" style="width: 100% !important;">
                    <thead>
                        <tr>
                            <th>@lang( 'accounts.account_number' )</th>
                            <th>@lang( 'accounts.account_name' )</th>
                            <th>@lang( 'accounts.account_type' )</th>
                            <th>@lang( 'accounts.currency' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $account)
                            <tr>
                                <td>{{$account->number}}</td>
                                <td>{{$account->name}}</td>
                                <td>{{$account->type}}</td>
                                <td>{{$account->currency}}</td>
                                <td></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endcan --}}

        @can('user.view')
            <div class="table-responsive" style="overflow-x: visible;">
                <table class="table table-bordered table-striped" id="restricts_table" style="width: 100% !important;">
                    <thead>
                        <tr>
                        	<th width="5%"></th>
                            <th>@lang( 'restricts.date' )</th>
                            <th>@lang( 'restricts.id' )</th>
                            <th>@lang( 'restricts.reference_number' )</th>
                            <th>@lang( 'restricts.debit1' )</th>
                            <th>@lang( 'restricts.credit1' )</th>
                            {{-- <th>@lang( 'restricts.debit2' )</th>
                            <th>@lang( 'restricts.credit2' )</th>
                            <th>@lang( 'restricts.debit3' )</th>
                            <th>@lang( 'restricts.credit3' )</th>
                            <th>@lang( 'restricts.debit4' )</th>
                            <th>@lang( 'restricts.credit4' )</th>
                            <th>@lang( 'restricts.debit5' )</th>
                            <th>@lang( 'restricts.credit5' )</th> --}}
                            <th>@lang( 'restricts.created by' )</th>
                            <th>@lang( 'restricts.status' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcan
    @endcomponent

    <div class="modal fade restrict_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var restricts_table = $('#restricts_table').DataTable({
                    processing: true,
                    serverSide: true,
        			responsive: true,
					fixedHeader: false,
                    ajax: '/restricts',
                    // dataType:JSON,
                    columnDefs: [ {
                        "targets": [0],
                        "orderable": false,
                        "searchable": false
                    } ],
                    columns:[
                    	{
                			"className":      'details-control',
                			"orderable":      false,
                			"data":           null,
                			"defaultContent": '',
           		 		},
                        {"data":'date'},
                        {"data":"id"},
                        {"data":"reference_number"},
                        {"data":"credit1"},
                        {"data":"debit1"},
                        // {"data":"debit2"},
                        // {"data":"credit2"},
                        // {"data":"debit3"},
                        // {"data":"credit3"},
                        // {"data":"debit4"},
                        // {"data":"credit4"},
                        // {"data":"debit5"},
                        // {"data":"credit5"},
                        {"data":"user_id"},
                        {"data":"status"},
                        {"data":"action"}
                    ]
                });
        $(document).on('click', 'button.delete_restricts_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_restricts,
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                restricts_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
             });
        });
        
    });
    
    
</script>
@endsection

