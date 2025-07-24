@extends('layouts.app')
@section('title', __('lang_v1.'.$type.'s'))
@php
    $api_key = env('GOOGLE_MAP_API_KEY');
@endphp
@if(!empty($api_key))
    @section('css')
        @include('contact.partials.google_map_styles')
    @endsection
@endif
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
@if($type == "customer")
    <h1> @lang('lang_v1.'.$type.'s')
        <small>ادارة كل العملاء الخاص بك</small>
    </h1>
@endif

@if($type == "supplier")
    <h1> @lang('lang_v1.'.$type.'s')
        <small>ادارة كل الموردين الخاص بك</small>
    </h1>
@endif
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <input type="hidden" value="{{$type}}" id="contact_type">
@if($type == "supplier")
    @component('components.widget', ['class' => 'box-primary','title' => "كل جهات الموردين الخاصة بك"])
@endif
@if($type == "customer")
    @component('components.widget', ['class' => 'box-primary','title' => "كل جهات العملاء الخاصة بك"])
@endif
        @if(auth()->user()->can('supplier.create') || auth()->user()->can('customer.create') || auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own'))
            @slot('tool')
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-href="{{action('ContactController@create', ['type' => $type])}}" 
                    data-container=".contact_modal">
                    <i class="fa fa-plus"></i> @lang('messages.add')</button>
                </div>
            @endslot
        @endif
        @if(auth()->user()->can('supplier.view') || auth()->user()->can('customer.view') || auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own'))
 <div class="table-responsive" style="overflow-x: visible;">           
<table class="table table-bordered table-striped" id="contact_table" style="width: 100%;">
                <thead>
                    <tr>
                    	<th width="5%"></th>
                        <th>@lang('messages.action')</th>
                        <th>@lang('lang_v1.contact_id')</th>
                        @if($type == 'supplier') 
                            <th>@lang('business.business_name')</th>
                            <th>@lang('contact.name')</th>
                            <th>@lang('business.email')</th>
                            <th>@lang('contact.tax_no')</th>
                            <th>@lang('contact.pay_term')</th>
                            <th>@lang('account.opening_balance')</th>
                            <th>@lang('lang_v1.advance_balance')</th>
                            <th>@lang('lang_v1.added_on')</th>
                            <th>@lang('business.address')</th>
                            <th>@lang('contact.mobile')</th>
                            <th>@lang('contact.total_purchase_due')</th>
                    		<th>@lang('lang_v1.total_purchase_return_due')</th>
                        @elseif( $type == 'customer')
                            <th>@lang('business.business_name')</th>
                            <th>@lang('user.name')</th>
                            <th>@lang('business.email')</th>
                            <th>@lang('contact.tax_no')</th>
                            <th>@lang('lang_v1.credit_limit')</th>
                            <th>@lang('contact.pay_term')</th>
                            <th>@lang('account.opening_balance')</th>
                            <th>@lang('lang_v1.advance_balance')</th>
                            <th>@lang('lang_v1.added_on')</th>
                            @if($reward_enabled)
                                <th id="rp_col">{{session('business.rp_name')}}</th>
                            @endif
                            <!--<th>@lang('lang_v1.customer_group')</th>
                            <th>@lang('business.address')</th>
                            <th>@lang('contact.mobile')</th>
                            <th>@lang('contact.total_sale_due')</th>
                            <th>@lang('lang_v1.total_sell_return_due')</th>-->
                        @endif
                        @php
                            $custom_labels = json_decode(session('business.custom_labels'), true);
                        @endphp
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 text-center footer-total">
                    @if($type == 'supplier')
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                        <td></td>
                        <td
                            @if($type == 'supplier')
                                colspan="8"
                            @elseif( $type == 'customer')
                                @if($reward_enabled)
                                    colspan="9"
                                @else
                                    colspan="8"
                                @endif
                            @endif>
                                <strong>
                                    @lang('sale.total'):
                                </strong>
                        </td>
                        <td id="footer_contact_due"></td>
                        <td id="footer_contact_return_due"></td>
                        <!--<td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>-->
                        <td></td>
                    </tr>
                </tfoot>
            </table>
</div>
        @endif
    @endcomponent

    <div class="modal fade contact_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script>
    //Start: CRUD for Contacts
    //contacts table
	/*function format ( d ) {
    // `d` is the original data object for the row
    var contact_table_type = $('#contact_type').val();
    if (contact_table_type == 'supplier'){
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
    	'<tr>'+
    '<tr>'+
            '<td>@lang('business.address') </td>'+
            '<td>'+d.address+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>@lang('contact.mobile'): </td>'+
            '<td>'+d.mobile+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}: </td>'+
            '<td>'+d.custom_field1+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}</td>'+
            '<td>'+d.custom_field2+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}</td>'+
            '<td>'+d.custom_field3+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}</td>'+
            '<td>'+d.custom_field4+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]) }}</td>'+
            '<td>'+d.custom_field5+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_6'] ?? __('lang_v1.custom_field', ['number' => 6]) }}</td>'+
            '<td>'+d.custom_field16+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_7'] ?? __('lang_v1.custom_field', ['number' => 7]) }}</td>'+
            '<td>'+d.custom_field7+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_8'] ?? __('lang_v1.custom_field', ['number' => 8]) }}</td>'+
            '<td>'+d.custom_field8+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_9'] ?? __('lang_v1.custom_field', ['number' => 9]) }}</td>'+
            '<td>'+d.custom_field9+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_10'] ?? __('lang_v1.custom_field', ['number' => 10]) }}</td>'+
            '<td>'+d.custom_field10+'</td>'+
        '</tr>'+
    '</table>';
    }
    else if (contact_table_type == 'customer') {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
    '<tr>'+
            '<td>@lang('lang_v1.customer_group'):</td>'+
            '<td>'+d.customer_group+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>@lang('business.address'):</td>'+
            '<td>'+d.address+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>@lang('contact.mobile'):</td>'+
            '<td>'+d.mobile+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>@lang('contact.total_sale_due'):</td>'+
            '<td>'+d.due+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>@lang('lang_v1.total_sell_return_due'):</td>'+
            '<td>'+d.return_due+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}: </td>'+
            '<td>'+d.custom_field1+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}</td>'+
            '<td>'+d.custom_field2+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}</td>'+
            '<td>'+d.custom_field3+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}</td>'+
            '<td>'+d.custom_field4+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]) }}</td>'+
            '<td>'+d.custom_field5+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_6'] ?? __('lang_v1.custom_field', ['number' => 6]) }}</td>'+
            '<td>'+d.custom_field16+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_7'] ?? __('lang_v1.custom_field', ['number' => 7]) }}</td>'+
            '<td>'+d.custom_field7+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_8'] ?? __('lang_v1.custom_field', ['number' => 8]) }}</td>'+
            '<td>'+d.custom_field8+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_9'] ?? __('lang_v1.custom_field', ['number' => 9]) }}</td>'+
            '<td>'+d.custom_field9+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>{{ $custom_labels['contact']['custom_field_10'] ?? __('lang_v1.custom_field', ['number' => 10]) }}</td>'+
            '<td>'+d.custom_field10+'</td>'+
        '</tr>'+
            '</table>';
    }
}*/
$(document).ready( function(){
    var contact_table_type = $('#contact_type').val();
    if (contact_table_type == 'supplier') {
        var columns = [
        	{
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '',
            	searchable: false,
            },
            { data: 'action', searchable: false, orderable: false },
            { data: 'contact_id', name: 'contact_id' },
            { data: 'supplier_business_name', name: 'supplier_business_name', searchable: true },
            { data: 'name', name: 'name', searchable: true },
            { data: 'email', name: 'email', searchable: true },
            { data: 'tax_number', name: 'tax_number', searchable: true },
            { data: 'pay_term', name: 'pay_term', searchable: false, orderable: false },
            { data: 'opening_balance', name: 'opening_balance', searchable: false },
            { data: 'balance', name: 'balance', searchable: false },
            { data: 'created_at', name: 'contacts.created_at' },
            { data: 'address', name: 'address', orderable: false },
            { data: 'mobile', name: 'mobile', searchable: true },
            { data: 'due', searchable: false, orderable: false },
            { data: 'return_due', searchable: false, orderable: false },
            /*{ data: 'custom_field1', name: 'custom_field1'},
            { data: 'custom_field2', name: 'custom_field2'},
            { data: 'custom_field3', name: 'custom_field3'},
            { data: 'custom_field4', name: 'custom_field4'},
            { data: 'custom_field5', name: 'custom_field5'},
            { data: 'custom_field6', name: 'custom_field6'},
            { data: 'custom_field7', name: 'custom_field7'},
            { data: 'custom_field8', name: 'custom_field8'},
            { data: 'custom_field9', name: 'custom_field9'},
            { data: 'custom_field10', name: 'custom_field10'},*/
        ];
    }
	else if (contact_table_type == 'customer') {
        var columns = [
        	{
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '',
                 searchable: false,
            },
            { data: 'action', searchable: false, orderable: false },
            { data: 'contact_id', name: 'contact_id' },
            { data: 'supplier_business_name', name: 'supplier_business_name' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'tax_number', name: 'tax_number' },
            { data: 'credit_limit', name: 'credit_limit' },
            { data: 'pay_term', name: 'pay_term', searchable: false, orderable: false },
            { data: 'opening_balance', name: 'opening_balance', searchable: false },
            { data: 'balance', name: 'balance', searchable: false },
            { data: 'created_at', name: 'contacts.created_at' }
        ];

        if ($('#rp_col').length) {
            columns.push({ data: 'total_rp', name: 'total_rp' });
        }
       /* Array.prototype.push.apply(columns, [{ data: 'customer_group', name: 'cg.name' },
            { data: 'address', name: 'address', orderable: false },
            { data: 'mobile', name: 'mobile' },
            { data: 'due', searchable: false, orderable: false },
            { data: 'return_due', searchable: false, orderable: false },
            { data: 'custom_field1', name: 'custom_field1'},
            { data: 'custom_field2', name: 'custom_field2'},
            { data: 'custom_field3', name: 'custom_field3'},
            { data: 'custom_field4', name: 'custom_field4'},
            { data: 'custom_field5', name: 'custom_field5'},
            { data: 'custom_field6', name: 'custom_field6'},
            { data: 'custom_field7', name: 'custom_field7'},
            { data: 'custom_field8', name: 'custom_field8'},
            { data: 'custom_field9', name: 'custom_field9'},
            { data: 'custom_field10', name: 'custom_field10'},
            ]);*/
    }
    
    contact_table = $('#contact_table').DataTable({
        processing: true,
        serverSide: true,
    	responsive: true,
		fixedHeader: false,
       // scrollY:        "75vh",
      //  scrollX:        true,
       // scrollCollapse: true,
        "ajax": {
            "url": "/contacts",
            "data": function ( d ) {
                d.type = $('#contact_type').val();
                d = __datatable_ajax_callback(d);
            }
        },
        aaSorting: [[1, 'desc']],
        columns: columns,
        fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#contact_table'));
        },
        "footerCallback": function ( row, data, start, end, display ) {
        $('.details-control').css('background', 'none');
            var total_due = 0;
            var total_return_due = 0;
            for (var r in data){
                total_due += $(data[r].due).data('orig-value') ? 
                parseFloat($(data[r].due).data('orig-value')) : 0;

                total_return_due += $(data[r].return_due).data('orig-value') ? 
                parseFloat($(data[r].return_due).data('orig-value')) : 0;
            }
            $('#footer_contact_due').html(__currency_trans_from_en(total_due));
            $('#footer_contact_return_due').html(__currency_trans_from_en(total_return_due));
        }
    });
});
</script>
@if(!empty($api_key))
<script>
  // This example adds a search box to a map, using the Google Place Autocomplete
  // feature. People can enter geographical searches. The search box will return a
  // pick list containing a mix of places and predicted search terms.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 10,
      mapTypeId: 'roadmap'
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.setCenter(initialLocation);
        });
    }


    // Create the search box and link it to the UI element.
    var input = document.getElementById('shipping_address');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      // Clear out the old markers.
      markers.forEach(function(marker) {
        marker.setMap(null);
      });
      markers = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        // Create a marker for each place.
        markers.push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location
        }));

        //set position field value
        var lat_long = [place.geometry.location.lat(), place.geometry.location.lng()]
        $('#position').val(lat_long);

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$api_key}}&libraries=places"
     async defer></script>
<script type="text/javascript">
    $(document).on('shown.bs.modal', '.contact_modal', function(e) {
        initAutocomplete();
    });
</script>
@endif
@endsection
