@extends('layouts.app')
@section('title', __( 'lang_v1.customer_groups' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'lang_v1.customer_groups' )</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'lang_v1.all_your_customer_groups' )])
        @can('customer.create')
            @slot('tool')
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                        data-href="{{action('CustomerGroupController@create')}}" 
                        data-container=".customer_groups_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                </div>
            @endslot
        @endcan
        @can('customer.view')
            <div class="table-responsive" style="overflow-x: visible;">
                <table class="table table-bordered table-striped" id="customer_groups_table" style="width:100%;">
                    <thead>
                        <tr>
                            <th>@lang( 'lang_v1.customer_group_name' )</th>
                            <th>@lang( 'lang_v1.calculation_percentage' )</th>
                            <th>@lang( 'lang_v1.selling_price_group' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
                </div>
        @endcan
    @endcomponent

    <div class="modal fade customer_groups_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
    $(document).on('change', '#price_calculation_type', function () {
        var price_calculation_type = $(this).val();

        if (price_calculation_type == 'percentage') {
            $('.percentage-field').removeClass('hide');
            $('.selling_price_group-field').addClass('hide');
        } else {
            $('.percentage-field').addClass('hide');
            $('.selling_price_group-field').removeClass('hide');
        }   
    })
</script>
@endsection
