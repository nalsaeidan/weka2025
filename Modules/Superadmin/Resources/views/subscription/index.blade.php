@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.subscription'))

@section('content')

<!-- Main content -->
<section class="content">
<style>
.box.box-success{
border-top-color: #cf4880 !important;
}
span.badge.bg-green{
background-image: -webkit-linear-gradient( 
180deg, #a12299 0%, #d23a74 51%, #f96834 99%);
background-color: unset !important;
}
</style>
	@include('superadmin::layouts.partials.currency')
	
	<div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('superadmin::lang.active_subscription')</h3>
        </div>

        <div class="box-body">
        	@if(!empty($active))
        		<div class="col-md-4">
	        		<div class="box box-success">
						<div class="box-header with-border text-center">
							<h2 class="box-title">
								{{$active->package_details['name']}}
							</h2>

							<div class="box-tools pull-right">
								<span class="badge bg-green">
									@lang('superadmin::lang.running')
								</span>
              				</div>

						</div>
						<div class="box-body text-center">
							@lang('superadmin::lang.start_date') : {{@format_date($active->start_date)}} <br/>
							@lang('superadmin::lang.end_date') : {{@format_date($active->end_date)}} <br/>

							@lang('superadmin::lang.remaining', ['days' => \Carbon::today()->diffInDays($active->end_date)])

						</div>
					</div>
				</div>
        	@else
        		<h3 class="text-danger">@lang('superadmin::lang.no_active_subscription')</h3>
        	@endif

        	@if(!empty($nexts))
        		<div class="clearfix"></div>
        		@foreach($nexts as $next)
        			<div class="col-md-4">
		        		<div class="box box-success">
							<div class="box-header with-border text-center">
								<h2 class="box-title">
									{{$next->package_details['name']}}
								</h2>
							</div>
							<div class="box-body text-center">
								@lang('superadmin::lang.start_date') : {{@format_date($next->start_date)}} <br/>
								@lang('superadmin::lang.end_date') : {{@format_date($next->end_date)}}
							</div>
						</div>
					</div>
        		@endforeach
        	@endif

        	@if(!empty($waiting))
        		<div class="clearfix"></div>
        		@foreach($waiting as $row)
        			<div class="col-md-4">
		        		<div class="box box-success">
							<div class="box-header with-border text-center">
								<h2 class="box-title">
									{{$row->package_details['name']}}
								</h2>
							</div>
							<div class="box-body text-center">
                                @if($row->paid_via == 'offline')
                                    @lang('superadmin::lang.waiting_approval')
                                @else
                                    @lang('superadmin::lang.waiting_approval_gateway')
                                @endif
							</div>
						</div>
					</div>
        		@endforeach
        	@endif

        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('superadmin::lang.all_subscriptions')</h3>
        </div>

        <div class="box-body">
        	<div class="row">
                <div class ="col-xs-12">
                <div class="table-responsive" style="overflow-x: visible;">
                    <!-- location table-->
                        <table class="table table-bordered table-hover" 
                        id="all_subscriptions_table" style="width: 100% !important;">
                            <thead>
                            <tr>
                            	<th width="5%"></th>
                                <th>@lang( 'superadmin::lang.package_name' )</th>
                                <th>@lang( 'superadmin::lang.start_date' )</th>
                                <th>@lang( 'superadmin::lang.trial_end_date' )</th>
                                <th>@lang( 'superadmin::lang.end_date' )</th>
                                <th>@lang( 'superadmin::lang.price' )</th>
                                <th>@lang( 'superadmin::lang.paid_via' )</th>
                                <th>@lang( 'superadmin::lang.payment_transaction_id' )</th>
                                <th>@lang( 'sale.status' )</th>
                                <th>@lang( 'lang_v1.created_at' )</th>
                                <th>@lang( 'business.created_by' )</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('superadmin::lang.packages')</h3>
        </div>

        <div class="box-body">
        	@include('superadmin::subscription.partials.packages')
        </div>
    </div>

</section>
@endsection

@section('javascript')

<script type="text/javascript">
	$(document).ready( function(){
    	$('#all_subscriptions_table').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			fixedHeader: false,
			ajax: '{{action("\Modules\Superadmin\Http\Controllers\SubscriptionController@allSubscriptions")}}',
			columns: [
            	{
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '',
                searchable: false,
            	},
			    {data: 'package_name', name: 'P.name'},
			    {data: 'start_date', name: 'start_date'},
			    {data: 'trial_end_date', name: 'trial_end_date'},
			    {data: 'end_date', name: 'end_date'},
			    {data: 'package_price', name: 'package_price'},
			    {data: 'paid_via', name: 'paid_via'},
			    {data: 'payment_transaction_id', name: 'payment_transaction_id'},
			    {data: 'status', name: 'status'},
			    {data: 'created_at', name: 'created_at'},
			    {data: 'created_by', name: 'created_by'},
			    {data: 'action', name: 'action', searchable: false, orderable: false},
			],
			"fnDrawCallback": function (oSettings) {
            	__currency_convert_recursively($('#all_subscriptions_table'), true);
        	}
	    });
	});
</script>
@endsection