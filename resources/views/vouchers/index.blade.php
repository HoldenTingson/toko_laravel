@extends('layouts.admin')

@section('title', __('voucher.Voucher_list'))
@section('content-header', __('voucher.Voucher_list'))
@section('content-actions')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <form action="{{route('vouchers.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control"
                                value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary" type="submit">{{ __('voucher.submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('voucher.ID') }}</th>
                    <th>{{ __('voucher.Order_Id') }}</th>
                    <th>{{ __('voucher.Code') }}</th>
                    <th>{{ __('voucher.Customer_Name') }}</th>
                    <th>{{ __('voucher.Amount') }}</th>
                    <th>{{ __('voucher.Status') }}</th>
                    <th>{{ __('voucher.Expired') }}</th>
                    <th>{{ __('voucher.Created_At') }}</th>
                    <th>{{ __('voucher.Expired_At') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vouchers as $voucher)
                <tr>
                    <td>{{$voucher->id}}</td>
                    <td>{{$voucher->order_id}}</td>
                    <td>{{$voucher->code}}</td>
                    <td>{{$voucher->getCustomerName()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$voucher->formattedAmount()}}</td>
                    <td>
                        @if($voucher->is_used == 0)
                        <span class="badge badge-warning">Not Used</span>
                        @else
                        <span class="badge badge-success">Used</span>
                        @endif
                    </td>
                    <td>
                        @if($voucher->expired_at > time())
                        <span class="badge badge-success">No</span>
                        @else
                        <span class="badge badge-danger">Yes</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle">{{
                        \Carbon\Carbon::parse($voucher->created_at)->translatedFormat('l, j F Y H:i:s') }}</td>
                    <td style="vertical-align: middle">{{
                        \Carbon\Carbon::parse($voucher->created_at)->translatedFormat('l, j F Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
        {{ $vouchers->render() }}
    </div>
</div>
@endsection