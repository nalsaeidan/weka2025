@extends('layouts.app')
@section('title', __( 'user.users_roles' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'user.users_roles' )
        <small>@lang( 'user.manage_users_roles' )</small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'user.all_users_roles' )])
        {{-- @can('user.create')
            @slot('tool')
                <div class="box-tools">
                    <a class="btn btn-block btn-primary" 
                    href="{{action('ManageUserController@create')}}" >
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                 </div>
            @endslot
        @endcan --}}
                    @can('roles.view')
                <div class="col-md-2">
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary" 
                        href="{{action('RoleController@index')}}" >
                        {{__('user.roles')}}</a>
                    </div>
                </div>
            @endcan
            @can('user.create')
            <div class="col-md-3">
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary" 
                        href="{{action('ManageUserController@create')}}" >
                        <i class="fa fa-plus"></i> @lang( 'messages.add_user' )</a>
                    </div>
            </div>
        @endcan
        </div>
        @can('user.view')
            <div class="table-responsive" style="overflow-x: visible;">
                <table class="table table-bordered table-striped" id="users_table" style="width: 100% !important;">
                    <thead>
                        <tr>
                        	<th width="5%"></th>
                            <th>@lang( 'business.username' )</th>
                            <th>@lang( 'user.name' )</th>
                            <th>@lang( 'user.role' )</th>
                            <th>@lang( 'business.email' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcan
    @endcomponent

    <div class="modal fade user_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var users_table = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
        			responsive: true,
					fixedHeader: false,
                    ajax: '/users',
                    columnDefs: [ {
                        "targets": [4],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                    	{
            			    "className":      'details-control',
            			    "orderable":      false,
            			    "data":           null,
            			    "defaultContent": '',
                        	searchable: false,
            			},
                        {"data":"username"},
                        {"data":"full_name"},
                        {"data":"role"},
                        {"data":"email"},
                        {"data":"action"}
                    ]
                });
        $(document).on('click', 'button.delete_user_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_user,
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
                                users_table.ajax.reload();
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
