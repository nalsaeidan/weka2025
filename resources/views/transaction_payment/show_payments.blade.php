<style>
    .icons{
        float:right;
        width: 10%;
        border-radius: 30px;
        border: 1px solid;
        padding: 6px;
        background: #cff2ff !important;
        color: #ffffff !important;
    }
    .icons .fa, .icons .fas, .icons :before {
        color: #000000 !important;
    }
    .data{
        float:left;
        text-align: right;
        width:90%;
        padding: 7px 9px;
    }
    @media(max-width: 991px){
        .right-invoice-info{
            /*margin-top: -100px;*/
        }
        .icons{
            padding: 10px !important;
        }
    }
    @media print {
        .footer {
            top: 100vh !important; /*position below the bottom of the page*/
            margin-top: -30px; /*move back up by the height of the footer*/
        }
    }
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title no-print">
                سند قبض
                (
                @if(in_array($transaction->type, ['purchase', 'expense', 'purchase_return', 'payroll']))
                    سند صرف رقم: {{ $transaction->ref_no }}
                @elseif(in_array($transaction->type, ['sell', 'sell_return']))
                    سند قبض رقم: {{ $transaction->invoice_no }}
                @endif
                )
            </h4>
            <h4 class="modal-title visible-print-block">
                @if(in_array($transaction->type, ['purchase', 'expense', 'purchase_return', 'payroll']))
                    سند صرف رقم: {{ $transaction->ref_no }}
                @elseif($transaction->type == 'sell')
                    سند قبض رقم: {{ $transaction->invoice_no }}
                @endif
            </h4>
        </div>

        <div class="modal-body">
            @if(in_array($transaction->type, ['purchase', 'purchase_return']))
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        @include('transaction_payment.transaction_supplier_details')
                    </div>
                    <div class="col-md-4 invoice-col">
                        @include('transaction_payment.payment_business_details')
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <b>@lang('purchase.ref_no'):</b> #{{ $transaction->ref_no }}<br/>
                        <b>@lang('messages.date'):</b> {{ @format_date($transaction->transaction_date) }}<br/>
                        <b>@lang('purchase.purchase_status'):</b> {{ __('lang_v1.' . $transaction->status) }}<br>
                        <b>@lang('purchase.payment_status'):</b> {{ __('lang_v1.' . $transaction->payment_status) }}<br>
                    </div>
                </div>


            @elseif(in_array($transaction->type, ['expense', 'expense_refund']))
                <div class="row invoice-info">
                    @if(!empty($transaction->contact))
                        <div class="col-sm-4 invoice-col">
                            @lang('expense.expense_for'):
                            <address>
                                <strong>{{ $transaction->contact->supplier_business_name }}</strong>
                                {{ $transaction->contact->name }}
                                {!! $transaction->contact->contact_address !!}
                                @if(!empty($transaction->contact->tax_number))
                                    <br>@lang('contact.tax_no'): {{$transaction->contact->tax_number}}
                                @endif
                                @if(!empty($transaction->contact->mobile))
                                    <br>@lang('contact.mobile'): {{$transaction->contact->mobile}}
                                @endif
                                @if(!empty($transaction->contact->email))
                                    <br>@lang('business.email'): {{$transaction->contact->email}}
                                @endif
                            </address>
                        </div>
                    @endif
                    <div class="col-md-4 invoice-col">
                        @include('transaction_payment.payment_business_details')
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <b>@lang('purchase.ref_no'):</b> #{{ $transaction->ref_no }}<br/>
                        <b>@lang('messages.date'):</b> {{ @format_date($transaction->transaction_date) }}<br/>
                        <b>@lang('purchase.payment_status'):</b> {{ __('lang_v1.' . $transaction->payment_status) }}<br>
                    </div>
                </div>
            @elseif($transaction->type == 'payroll')
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        @lang('essentials::lang.payroll_for'):
                        <address>
                            <strong>{{ $transaction->transaction_for->user_full_name }}</strong>
                            @if(!empty($transaction->transaction_for->address))
                                <br>{{$transaction->transaction_for->address}}
                            @endif
                            @if(!empty($transaction->transaction_for->contact_number))
                                <br>@lang('contact.mobile'): {{$transaction->transaction_for->contact_number}}
                            @endif
                            @if(!empty($transaction->transaction_for->email))
                                <br>@lang('business.email'): {{$transaction->transaction_for->email}}
                            @endif
                        </address>
                    </div>
                    <div class="col-md-4 invoice-col">
                        @include('transaction_payment.payment_business_details')
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>@lang('purchase.ref_no'):</b> #{{ $transaction->ref_no }}<br/>
                        @php
                            $transaction_date = \Carbon::parse($transaction->transaction_date);
                        @endphp
                        <b>@lang( 'essentials::lang.month_year' ):</b> {{ $transaction_date->format('F') }} {{ $transaction_date->format('Y') }}<br/>
                        <b>@lang('purchase.payment_status'):</b> {{ __('lang_v1.' . $transaction->payment_status) }}<br>
                    </div>
                </div>
            @else
                <div class="row invoice-info">
{{--                <div class="col-sm-4 invoice-col">--}}
{{--                        @lang('contact.customer'):--}}
{{--                        <address>--}}
{{--                            <strong>{{ $transaction->contact->name }}</strong>--}}

{{--                            {!! $transaction->contact->contact_address !!}--}}
{{--                @if(!empty($transaction->contact->tax_number))--}}
{{--                    <br>@lang('contact.tax_no'): {{$transaction->contact->tax_number}}--}}
{{--                @endif--}}
{{--                @if(!empty($transaction->contact->mobile))--}}
{{--                    <br>@lang('contact.mobile'): {{$transaction->contact->mobile}}--}}
{{--                @endif--}}
{{--                @if(!empty($transaction->contact->email))--}}
{{--                    <br>@lang('business.email'): {{$transaction->contact->email}}--}}
{{--                @endif--}}
{{--                        </address>--}}
{{--                    </div>--}}
                    <div class="col-sm-4 invoice-col" style="float:right !important; text-align: right !important;">
                        @include('transaction_payment.payment_business_details')
                    </div>
                    <div class="col-sm-4 invoice-col" style="float:right !important; text-align: center !important;">
                        @if(!empty($transaction->business->logo))
                            <p style="text-align:center"><img style="max-height: 120px; width: auto;" src="{{ $logo }}"></p>
                        @endif
                    </div>
                    <div class="col-sm-4 invoice-col" style="float:left !important; text-align: right !important;">
                        <b> سند قبض رقم:</b> #{{ $transaction->invoice_no }}<br/>
                        <b>@lang('messages.date'):</b> {{ @format_date($transaction->transaction_date) }}<br/>
                        <b>@lang('purchase.payment_status'):</b> {{ __('lang_v1.' . $transaction->payment_status) }}<br>
                        <b>@lang('contact.customer'):</b>
                        <address>
                            <strong>{{ $transaction->contact->name }}</strong>

                            {!! $transaction->contact->contact_address !!}
                            @if(!empty($transaction->contact->tax_number))
                                <br>@lang('contact.tax_no'): {{$transaction->contact->tax_number}}
                            @endif
                            @if(!empty($transaction->contact->mobile))
                                <br>@lang('contact.mobile'): {{$transaction->contact->mobile}}
                            @endif
                            @if(!empty($transaction->contact->email))
                                <br>@lang('business.email'): {{$transaction->contact->email}}
                            @endif
                        </address>
                    </div>
                </div>
            @endif

            @can('send_notification')
                @if($transaction->type == 'purchase')
                    <div class="row no-print">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-info btn-modal btn-xs"
                                    data-href="{{action('NotificationController@getTemplate', ['transaction_id' => $transaction->id,'template_for' => 'payment_paid'])}}" data-container=".view_modal"><i class="fa fa-envelope"></i> @lang('lang_v1.payment_paid_notification')</button>
                        </div>
                    </div>
                    <br>
                @endif
                @if($transaction->type == 'sell')
                    <div class="row no-print">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-info btn-modal btn-xs"
                                    data-href="{{action('NotificationController@getTemplate', ['transaction_id' => $transaction->id,'template_for' => 'payment_received'])}}" data-container=".view_modal"><i class="fa fa-envelope"></i> @lang('lang_v1.payment_received_notification')</button>

                            @if($transaction->payment_status != 'paid')
                                &nbsp;
                                <button type="button" class="btn btn-warning btn-modal btn-xs" data-href="{{action('NotificationController@getTemplate', ['transaction_id' => $transaction->id,'template_for' => 'payment_reminder'])}}" data-container=".view_modal"><i class="fa fa-envelope"></i> @lang('lang_v1.send_payment_reminder')</button>
                            @endif
                        </div>
                    </div>
                    <br>
                @endif
            @endcan
            @if($transaction->payment_status != 'paid')
                <div class="row">
                    <div class="col-md-12">
                        @if((auth()->user()->can('purchase.payments') && (in_array($transaction->type, ['purchase', 'purchase_return']))) || (auth()->user()->can('sell.payments') && (in_array($transaction->type, ['sell', 'sell_return']))) || auth()->user()->can('all_expense.access') || auth()->user()->can('view_own_expense'))
                            <a href="{{ action('TransactionPaymentController@addPayment', [$transaction->id]) }}" class="btn btn-primary btn-xs pull-right add_payment_modal no-print"><i class="fa fa-plus" aria-hidden="true"></i> @lang("purchase.add_payment1")</a>
                        @endif
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="border: 1px solid #ffffff !important;">
                            <tr>
                                <th style="background-color: #cff2ff !important;">@lang('messages.date')</th>
                                <th style="background-color: #cff2ff !important;">@lang('purchase.ref_no')</th>
                                <th style="background-color: #cff2ff !important;">@lang('purchase.amount')</th>
                                <th style="background-color: #cff2ff !important;">@lang('purchase.payment_method')</th>
                                <th style="background-color: #cff2ff !important;">@lang('purchase.payment_note')</th>
                                @if($accounts_enabled)
                                    <th style="background-color: #cff2ff !important;">@lang('lang_v1.payment_account')</th>
                                @endif
                                <th style="background-color: #cff2ff !important;" class="no-print">@lang('messages.actions')</th>
                            </tr>
                            @forelse ($payments as $payment)
                                <tr>
                                    <td>{{ @format_datetime($payment->paid_on) }}</td>
                                    <td>{{ $payment->payment_ref_no }}</td>
                                    <td><span class="display_currency" data-currency_symbol="true">{{ $payment->amount }}</span></td>
                                    <td>{{ $payment_types[$payment->method] ?? '' }}</td>
                                    <td>{{ $payment->note }}</td>
                                    @if($accounts_enabled)
                                        <td>{{$payment->payment_account->name ?? ''}}</td>
                                    @endif
                                    <td class="no-print" style="display: flex;">
                                        @if((auth()->user()->can('purchase.payments') && (in_array($transaction->type, ['purchase', 'purchase_return']))) || (auth()->user()->can('sell.payments') && (in_array($transaction->type, ['sell', 'sell_return']))) || auth()->user()->can('all_expense.access') || auth()->user()->can('view_own_expense'))
                                            @if($payment->method != 'advance')
                                                <button type="button" class="btn btn-info btn-xs edit_payment"
                                                        data-href="{{action('TransactionPaymentController@edit', [$payment->id]) }}"><i class="glyphicon glyphicon-edit"></i></button>
                                            @endif
                                            &nbsp; <button type="button" class="btn btn-danger btn-xs delete_payment"
                                                           data-href="{{ action('TransactionPaymentController@destroy', [$payment->id]) }}"
                                            ><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            &nbsp;
                                            <button type="button" class="btn btn-primary btn-xs view_payment" data-href="{{ action('TransactionPaymentController@viewPayment', [$payment->id]) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        @endif
                                        @if(!empty($payment->document_path))
                                            &nbsp;
                                            <a href="{{$payment->document_path}}" class="btn btn-success btn-xs" download="{{$payment->document_name}}"><i class="fa fa-download" data-toggle="tooltip" title="{{__('purchase.download_document')}}"></i></a>
                                            @if(isFileImage($payment->document_name))
                                                &nbsp;
                                                <button data-href="{{$payment->document_path}}" class="btn btn-info btn-xs view_uploaded_document" data-toggle="tooltip" title="{{__('lang_v1.view_document')}}"><i class="fa fa-picture-o"></i></button>
                                            @endif

                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="6">@lang('purchase.no_records_found')</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            {{-- Barcode --}}

            <div class="row">
                {{--	<div class="col-12">
                            <img class="center-block" style="width:100px !important" src="" alt="barcode"/>

                        </div> --}}
                <div class="col-12 invoice-col width-100 footer" style="margin-top: 10px;">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6" style="float:right">
                        <div class="icons">
                            <i class="fas fa-phone"></i>
                            <br>
                            <i class="fas fa-at"></i>
                            <br>
                            <i class="fas fa-globe"></i>
                            <br>
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="data">
                            <i>000000000</i>
                            <br>
                            <i>test@test.com</i>
                            <br>
                            <i>الموقع</i>
                            <br>

                            <i>العنوان بالتفصيل</i>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6" style="float:right">
                        <b style="float:left !important; margin-top:10px">@lang('lang_v1.authorized_signatory')</b>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <button type="button" class="btn btn-primary no-print"
                    aria-label="Print"
                    onclick="$(this).closest('div.modal').printThis();">
                <i class="fa fa-print"></i> @lang( 'messages.print' )
            </button>
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">@lang( 'messages.close' )</button>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->