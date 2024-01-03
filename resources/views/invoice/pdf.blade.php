<!DOCTYPE html>
<html>

<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 200px;
        height: 60px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0">Invoice</h1>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">{{$order->id}}</span></p>
            <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color"> {{
                    \Carbon\Carbon::parse($order->created_at)->translatedFormat('l, j F Y H:i:s') }}</span></p>
            <p class="m-0 pt-5 text-bold w-100">Status - <span class="gray-color">@if($order->receivedAmount() == 0)
                    {{ __('order.Not_Paid') }}
                    @elseif($order->receivedAmount() < $order->totalPrice())
                        {{ __('order.Partial') }}
                        @elseif($order->receivedAmount() == $order->totalPrice())
                        {{ __('order.Paid') }}
                        @elseif($order->receivedAmount() > $order->totalPrice())
                        {{ __('order.Change') }}
                        @endif
                </span>
            </p>
            <p class="m-0 pt-5 text-bold w-100">Customer Name - <span
                    class="gray-color">{{$order->getCustomerName()}}</span></p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">Price</th>
                <th class="w-50">Discount</th>
                <th class="w-50">Total Price</th>
                <th class="w-50">Received Amount</th>
                <th class="w-50">New Voucher Code</th>
            </tr>
            <tr align="center">
                <td>{{ config('settings.currency_symbol') }} {{$order->formattedTotal()}}</td>
                <td>{{ config('settings.currency_symbol') }} {{$order->discount}}</td>
                <td>{{ config('settings.currency_symbol') }} {{$order->formattedTotalPrice()}}</td>
                <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                <td>{{$order->getVoucherCode()}}</td>
            </tr>
        </table>
    </div>
</body>

</html>