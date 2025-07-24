@extends('superadmin::layouts.app')

@section('title', __('superadmin::lang.confirm_delete_business'))

@section('content')
<section class="content-header">
    <h1>@lang('superadmin::lang.confirm_delete_business')</h1>
</section>

<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title text-danger">@lang('messages.warning')</h3>
        </div>
        <div class="box-body">
            <p><strong>@lang('business.business_name'):</strong> {{ $business->name }}</p>
            <ul>
                <li>@lang('sale.transactions'): {{ $counts->transactions }}</li>
                <li>@lang('user.users'): {{ $counts->users }}</li>
                <li>@lang('product.products'): {{ $counts->products }}</li>
            </ul>

            <div class="alert alert-danger">
                <strong>@lang('messages.are_you_sure')</strong>
                <br>
                @lang('superadmin::lang.this_action_cannot_be_reversed')
            </div>

<form action="{{ route('superadmin.business.destroy', ['id' => $business->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash"></i> @lang('messages.confirm_delete')
    </button>
    <a href="{{ action('\Modules\Superadmin\Http\Controllers\BusinessController@index') }}" class="btn btn-default">
        @lang('messages.cancel')
    </a>
</form>

        </div>
    </div>
</section>
@endsection
