@extends('layouts.app')
@section('title', __('restricts.show_restrict'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('restricts.show_restrict')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <p></p>
                <p></p>
            </div>

            <div class="col-md-6">
                <p><strong>@lang( 'restricts.id' ):</strong>{{$restrict['id'] ?? ''}}</p>
                <p><strong>@lang( 'restricts.reference_number' ):</strong> {{$restrict['reference_number'] ?? ''}} </p>
                {{-- <p><strong>@lang( 'restricts.currency_id' ):</strong> {{$restrict->currency_id ?? ''}} </p> --}}
                <p><strong>@lang( 'restricts.date' ):</strong>{{@format_date($restrict['date']) ?? ''}} </p>
            </div>

            <div class="col-md-6">
                <p><strong>@lang( 'restricts.notes' ):</strong> {{$restrict['notes'] ?? ''}} </p>
                <p><strong>@lang( 'restricts.status' ):</strong> {{$restrict['status'] ?? ''}} </p>
                <p><strong>@lang( 'restricts.created by' ):</strong> {{$restrict1->user->username ?? ''}} </p>
            </div>

            <div class="col-md-12">

{{-- @can('restrict.view') --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="restricts_table">
                    <thead>
                        <tr>
                            <th>@lang( 'restricts.account_number' )</th>
                            <th>@lang( 'restricts.description' )</th>
                            <th>المدين</th>

                            <th>"الدائن"</th>
                        </tr>
                    </thead>
                    
                    <tbody>


                        @for($i = 1 ; $i<=$counter ;$i++)

                            @if ($restrict['debit'.$i] || $restrict['credit'.$i] )
                                <tr>
                                    
                                    <td>
                                        <select disabled id="account_number.$i" name="account_number".$i class="form-control">
                                                @foreach ($accounts as $account)
                                                <option class="form-control select2" value="{{$account->id}}" {{ $restrict['account_number'.$i] == $account->id?"selected": "" }}> {{$account->name}} </option>
                                                @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $restrict['description'.$i] }}</td>
                                    <td>{{$restrict['credit'.$i]}}</td>
                                    <td>{{$restrict['debit'.$i]}}</td>
                                    
                                </tr>
                            @endif
                        @endfor


                            {{-- @if ($restrict->debit2 || $restrict->credit2)
                            <tr>
                                <td>
                                    <select disabled id="account_number2" name="account_number2" class="form-control">
                                            @foreach ($accounts as $account)
                                            <option class="form-control select2" value="{{$account->id}}" {{ $restrict->account_number2 == $account->id?"selected": "" }}> {{$account->name}} </option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>{{$restrict->description2 }}</td>
                                <td>{{$restrict->credit2}}</td>
                                <td>{{$restrict->debit2}}</td>
                            </tr>
                            @endif
                            @if ($restrict->debit3 || $restrict->credit3)
                            <tr>
                                <td>
                                    <select disabled id="account_number3" name="account_number3" class="form-control">
                                            @foreach ($accounts as $account)
                                            <option class="form-control select2" value="{{$account->id}}" {{ $restrict->account_number3 == $account->id?"selected": "" }}> {{$account->name}} </option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>{{$restrict->description3 }}</td>
                                 <td>{{$restrict->credit3}}</td>
                                <td>{{$restrict->debit3}}</td>
                            </tr>
                            @endif
                            @if ($restrict->debit4 || $restrict->credit4)
                            <tr>
                                <td>
                                    <select disabled id="account_number4" name="account_number4" class="form-control">
                                            @foreach ($accounts as $account)
                                            <option class="form-control select2" value="{{$account->id}}" {{ $restrict->account_number4 == $account->id?"selected": "" }}> {{$account->name}} </option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>{{$restrict->description4 }}</td>
                                 <td>{{$restrict->credit4}}</td>
                                <td>{{$restrict->debit4}}</td>
                            </tr>
                            @endif
                            @if ($restrict->debit5 || $restrict->credit5)
                            <tr>
                                <td>
                                    <select disabled id="account_number5" name="account_number5" class="form-control">
                                            @foreach ($accounts as $account)
                                            <option class="form-control select2" value="{{$account->id}}" {{ $restrict->account_number5 == $account->id?"selected": "" }}> {{$account->name}} </option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>{{$restrict->description5}}</td>
                                <td>{{$restrict->credit5}}</td>

                                <td>{{$restrict->debit5}}</td>
                            </tr>
                            @endif
                            --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th></th>
                                <th>{{"المجموع الكلي :"}}</th>
                                    @php
                                        $credits =0 ;
                                        $debits = 0;
                                            for($i = 1 ; $i<=$counter ;$i++){
                                                $credits = $credits + $restrict['credit'.$i];
                                                $debits = $debits + $restrict['debit'.$i];

                                            }
                                        $sub = $debits - $credits; 
                                    @endphp

                                <th>{{$credits}}</th>
                                <th>{{$debits}}</th>
                            </tr> 
                             <tr>
                                <th></th>
                                <th>{{" الفرق الكلي :"}}</th>

                            
                                @if($sub<=0)
                                <th>{{$sub}}</th>
                                <th></th>
                                @else
                                <th></th>
                                <th>{{$sub}}</th>
                                @endif
                            </tr>
                            
                    </tbody>
                </table>
            </div>
            </div>
        {{-- @endcan --}}

            </div>
        </div>
    
</section>
@endsection
