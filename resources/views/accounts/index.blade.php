@extends('layouts.app')
@section('title', __( 'accounts.accounts' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 style="font-family:Droid Arabic Kufi, serif">@lang( 'accounts.accounts' )
        <small style="font-family:Droid Arabic Kufi, serif">@lang( 'accounts.manage_your_account' )</small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content" >
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'accounts.all_accounts' )])
         @can('account.create')
            @slot('tool')
                <div class="col-md-2">
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary" 
                        href="{{action('AccountsController@create')}}" >
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                    </div>
                </div>
            @endslot

        @endcan 
                    
        </div>
        {{-- @can('account.view')
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="accounts_table">
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
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="accounts_table">
                    <thead>
                        <tr>
                            <th>@lang( 'accounts.account_number' )</th>
                            <th>@lang( 'accounts.account_name' )</th>
                            <th>@lang( 'accounts.account_type' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcan
    @endcomponent

    <div class="modal fade account_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var accounts_table = $('#accounts_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/accounts',
                    columnDefs: [ {
                        "targets": [0],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"number",name:'number'},
                        {"data":"name"},
                        {"data":"type"},
                        {"data":"action"}
                    ]
                });
        $(document).on('click', 'button.delete_accounts_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_accounts,
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
                                accounts_table.ajax.reload();
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

