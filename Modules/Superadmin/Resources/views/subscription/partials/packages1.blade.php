<div id="generic_price_table">   
<section>
<style>
.bottom_btn:hover{
	background-color: #666;
	color: #FFF;
	text-decoration:none;
}
.package{
box-shadow: 2px 2px 3px grey;
}
#generic_price_table .generic_content .generic_feature_list ul li:hover{
border-left: 5px solid #c8357b !important;
}
#generic_price_table .generic_content.active .generic_head_price .generic_head_content .head_bg, #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg{
border-color: #cd3878 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #cd3878 !important;
    color: #fff !important;
}
#generic_price_table .generic_content:hover .generic_price_btn a, #generic_price_table .generic_content.active .generic_price_btn a{
background-image: -webkit-linear-gradient( 
180deg, #a12299 0%, #d23a74 51%, #f96834 99%);
background-color: unset !important;
}
#generic_price_table .generic_content .generic_price_btn a{
border: 1px solid #c8357b !important;
    color: #c8357b ;
background-color: #ffffff !important;
}
#generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head span, #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head span{
    color: #747474 !important;
}
.package{
    height: 900px !important;
	margin-bottom: 10px;
}
.generic_content {
    height: 900px !important;
}
.row {
margin: 0 auto !important;
}
.box .box-body{
padding: 0px !important;
}
.subscribe_btn{
	border: 1px solid #c8357b !important;
    color: #c8357b;
    background-color: #ffffff !important;
	padding: 10px 40px;
	border-radius: 30px;
    font-size: 18px;
}
.subscribe_btn:hover{
	background-image: -webkit-linear-gradient(180deg, #a12299 0%, #d23a74 51%, #f96834 99%);
    background-color: unset !important;
	color: #ffffff;
}
.row.subscribe{
padding: 30px;
}
.description{
	padding: 0px 30px;
}
.generic_price_btn.clearfix{
position: absolute;
    left: 50%;
    bottom: 0px;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}

i.fa.fa-tag.fa-stack-1x.fa-inverse{
padding: 0px 20px !important;
}
i.fa.fa-stack-1x{
padding: 12px 0px !important;
line-height: 1.5em;
white-space: nowrap;
text-overflow: ellipsis;
width: 100%;
}

i.fa.fa-tag.fa-stack-1x.fa-inverse{
padding: 0px 20px !important;
}
i.fa.fa-stack-1x{
padding: 9px 0px !important;
line-height: 1.5em;
white-space: nowrap;
text-overflow: ellipsis;
width: 100%;
}

#generic_price_table, #generic_price_table .generic_content .generic_feature_list ul li, span.display_currency{ font-family: 'Droid Arabic Kufi' !important; }
</style>
            <!--BLOCK ROW START-->
            <div class="row">
            @foreach ($packages as $package)
	@if($package->is_private == 1 && !auth()->user()->can('superadmin'))
		@php
			continue;
		@endphp
	@endif
                <div class="col-md-4 package">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>{{$package->name}}</span>
                                
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix" style="display:none">	
                                <span class="price">
                                 @if($package->price != 0)
                                    <span class="sign">{{$package->price}}</span>
                                    <span class="month">MON</span>
                                @else
                                <span class="month">@lang('superadmin::lang.register_free')</span>
                                @endif
                                </span>
                            </div>
                        
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->
                        <div class="generic_feature_list">
                        	<ul>
                            	<li>
                                <i>-</i>
                            	@lang('business.business_locations'):
                                @if($package->location_count == 0)
									@lang('superadmin::lang.unlimited')
									@else
									{{$package->location_count}}
									@endif</li>
                                <li>
                                <i>-</i>
                            	@lang('superadmin::lang.users'):
								@if($package->location_count == 0)
								@lang('superadmin::lang.unlimited')
								@else
								{{$package->user_count}}
								@endif
                            	</li>
                                <li>
                                <i>-</i>
                            	@lang('superadmin::lang.products'):
								@if($package->product_count == 0)
								@lang('superadmin::lang.unlimited')
								@else
								{{$package->product_count}}
								@endif
                            	</li>
                            	<li>
                                <i>-</i>
                            	@lang('superadmin::lang.invoices'):
								@if($package->invoice_count == 0)
								@lang('superadmin::lang.unlimited')
								@else
								{{$package->invoice_count}}
								@endif
                            	</li>
                            	
                                @if(!empty($package->custom_permissions))
								@foreach($package->custom_permissions as $permission => $value)
								@isset($permission_formatted[$permission])
                            	<li>
								<i>-</i>
								{{$permission_formatted[$permission]}}
                                </li>
								@endisset
								@endforeach
								@endif
                            	
                            	@if($package->trial_days != 0)
                            	<li>
								<i>-</i>
								@lang('superadmin::lang.trial_days'): {{$package->trial_days}} 
                            	</li>
								@endif
                            		
                            	 @if($package->price_befor != 0)
                            <li>
                                    <h3 class="text-left" style="padding-right: 10px;">
                                    @php
                                        $interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);
                                    @endphp
                                        
                                    <span class="fa-stack fa-lg" style="width:100px">
  										<i class="fa fa-certificate fa-stack-2x" style="color:red; font-size:55px"></i>
  										<i class="fa fa-stack-1x" style="color:white; font-size:12px">50% <br/> خصم</i>
									</span>
                                            <span class="display_currency" data-currency_symbol="true" style="text-decoration: line-through; color:red">
                                                {{$package->price_befor}}
                                            </span>

                                           <!-- <small>
                                                / {{$package->interval_count}} {{$interval_type}}
                                            </small>-->
                                        
                                        
                                    </h3>
                                </li>
                            
                            	<li>
                            		<h3 class="text-left" style="padding-right: 10px;">
									@php
										$interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);
									@endphp
										@if($package->price != 0)
                                     @if($package->price_befor != 0)
                                    <span class="fa-stack fa-lg" style="width:100px">
  										<i class="fa fa-certificate fa-stack-2x" style="color: #28b97b; font-size:55px"></i>
  										<i class="fa fa-stack-1x" style="color:white; font-size:12px">بعد <br/> الخصم</i>
									</span>
                                    @endif
											<span class="display_currency" data-currency_symbol="true">
												{{$package->price}}
											</span>
					
											<small>
												/ {{$package->interval_count}} {{$interval_type}}
											</small>
										@else
											@lang('superadmin::lang.free_for_duration', [ $interval_type . ' ' .'duration' => $package->interval_count ])
										@endif
									</h3>
                            	</li>
                            
                            @else
                            <li>
                            		<h3 class="text-center" style="padding-right: 10px;">
									@php
										$interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);
									@endphp
										@if($package->price != 0)
											<span class="display_currency" data-currency_symbol="true">
												{{$package->price}}
											</span>
					
											<small>
												/ {{$package->interval_count}} {{$interval_type}}
											</small>
										@else
											@lang('superadmin::lang.free_for_duration', [ $interval_type . ' ' .'duration' => $package->interval_count ])
										@endif
									</h3>
                            	</li>
                            @endif
                            </ul>
                        </div>
                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START-->

    			{{$package->description}}
                        <div class="generic_price_btn clearfix col-md-12 col-sm-12 col-xs-12">
                         @if($package->enable_custom_link == 1)
                        <a href="{{$package->custom_link}}" class="">{{$package->custom_link_text}}</a>
                        @else
                        @if(isset($action_type) && $action_type == 'register')
                        <a class="" href="{{ route('business.getRegister') }}?package={{$package->id}}">
                        @if($package->price != 0)
		    					@lang('superadmin::lang.register_subscribe')
		    				@else
		    					@lang('superadmin::lang.register_free')
		    				@endif
	    				</a>
                        @else
                        	<a class="" href="{{action('\Modules\Superadmin\Http\Controllers\SubscriptionController@pay', [$package->id])}}">
                            @if($package->price != 0)
		    					@lang('superadmin::lang.pay_and_subscribe')
		    				@else
		    					@lang('superadmin::lang.subscribe')
		    				@endif
                        </a>
                        @endif
                        @endif
                        </div>
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
            
            @endforeach
            </div>	
            <!--//BLOCK ROW END-->
            
        
    </section> 
</div>

<!--@foreach ($packages as $package)
	@if($package->is_private == 1 && !auth()->user()->can('superadmin'))
		@php
			continue;
		@endphp
	@endif-->

   <!-- <div class="col-md-4">
    	
		<div class="box box-success hvr-grow-shadow">
			<div class="box-header with-border text-center">
				<h2 class="box-title">{{$package->name}}</h2>
			</div>
			
			<!-- /.box-header -->
			<!--<div class="box-body text-center">

				<i class="fa fa-check text-success"></i>
				@if($package->location_count == 0)
					@lang('superadmin::lang.unlimited')
				@else
					{{$package->location_count}}
				@endif

				@lang('business.business_locations')
				<br/><br/>

				<i class="fa fa-check text-success"></i>
				@if($package->user_count == 0)
					@lang('superadmin::lang.unlimited')
				@else
					{{$package->user_count}}
				@endif

				@lang('superadmin::lang.users')
				<br/><br/>

				<i class="fa fa-check text-success"></i>
				@if($package->product_count == 0)
					@lang('superadmin::lang.unlimited')
				@else
					{{$package->product_count}}
				@endif

				@lang('superadmin::lang.products')
				<br/><br/>

				<i class="fa fa-check text-success"></i>
				@if($package->invoice_count == 0)
					@lang('superadmin::lang.unlimited')
				@else
					{{$package->invoice_count}}
				@endif

				@lang('superadmin::lang.invoices')
				<br/><br/>

				@if(!empty($package->custom_permissions))
					@foreach($package->custom_permissions as $permission => $value)
						@isset($permission_formatted[$permission])
							<i class="fa fa-check text-success"></i>
							{{$permission_formatted[$permission]}}
							<br/><br/>
						@endisset
					@endforeach
				@endif

				@if($package->trial_days != 0)
					<i class="fa fa-check text-success"></i>
					{{$package->trial_days}} @lang('superadmin::lang.trial_days')
					<br/><br/>
				@endif
				
				<h3 class="text-center">
				@php
					$interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);
				@endphp
					@if($package->price != 0)
						<span class="display_currency" data-currency_symbol="true">
							{{$package->price}}
						</span>

						<small>
							/ {{$package->interval_count}} {{$interval_type}}
						</small>
					@else
						@lang('superadmin::lang.free_for_duration', ['duration' => $package->interval_count . ' ' . $interval_type])
					@endif
				</h3>
			</div>
			<!-- /.box-body -->

		<!--	<div class="box-footer bg-gray disabled text-center">
				@if($package->enable_custom_link == 1)
					<a href="{{$package->custom_link}}" class="btn btn-block btn-success">{{$package->custom_link_text}}</a>
				@else
					@if(isset($action_type) && $action_type == 'register')
						<a href="{{ route('business.getRegister') }}?package={{$package->id}}" 
						class="btn btn-block btn-success">
		    				@if($package->price != 0)
		    					@lang('superadmin::lang.register_subscribe')
		    				@else
		    					@lang('superadmin::lang.register_free')
		    				@endif
	    				</a>
					@else
	    				<a href="{{action('\Modules\Superadmin\Http\Controllers\SubscriptionController@pay', [$package->id])}}" 
						class="btn btn-block btn-success">
		    				@if($package->price != 0)
		    					@lang('superadmin::lang.pay_and_subscribe')
		    				@else
		    					@lang('superadmin::lang.subscribe')
		    				@endif
	    				</a>
					@endif
				@endif

    			{{$package->description}}
			</div>
		</div>
		<!-- /.box -->
    <!--</div>
    @if($loop->iteration%3 == 0)
    	<div class="clearfix"></div>
    @endif
@endforeach-->