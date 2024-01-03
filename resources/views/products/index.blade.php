@extends('layouts.admin')

@section('title', __('product.Product_List'))
@section('content-header', __('product.Product_List'))
@section('content-actions')
<a href="{{route('products.create')}}" class="btn btn-primary">{{ __('product.Create_Product') }}</a>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card product-list">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('product.ID') }}</th>
                    <th>{{ __('product.Name') }}</th>
                    <th>{{ __('product.Image') }}</th>
                    <th>{{ __('product.Barcode') }}</th>
                    <th>{{ __('product.Price') }}</th>
                    <th>{{ __('product.Quantity') }}</th>
                    <th>{{ __('product.Status') }}</th>
                    <th>{{ __('product.Created_At') }}</th>
                    <th>{{ __('product.Updated_At') }}</th>
                    <th>{{ __('product.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td style="vertical-align: middle">{{$product->id}}</td>
                    <td style="vertical-align: middle">{{$product->name}}</td>
                    <td style="vertical-align: middle"><img class="product-img"
                            src="{{ Storage::url($product->image) }}" alt=""></td>
                    <td style="vertical-align: middle">{{$product->barcode}}</td>
                    <td style="vertical-align: middle">{{ config('settings.currency_symbol') }}
                        {{number_format($product->price,2)}}</td>
                    <td style="vertical-align: middle">{{$product->quantity}}</td>
                    <td style="vertical-align: middle">
                        <span class="right badge badge-{{ $product->status ? 'success' : 'danger' }}">{{$product->status
                            ? __('common.Active') : __('common.Inactive') }}</span>
                    </td>
                    <td style="vertical-align: middle">{{
                        \Carbon\Carbon::parse($product->created_at)->translatedFormat('l, j F Y H:i:s') }}</td>
                    <td style="vertical-align: middle">{{
                        \Carbon\Carbon::parse($product->updated_at)->translatedFormat('l, j F Y H:i:s') }}</td>
                    <td style="vertical-align: middle">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('products.destroy', $product)}}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->render() }}
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="module">
    $(document).ready(function() {
        $(document).on('click', '.btn-delete', function() {
            var $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this products?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText:'No',
                reverseButtons: true,
                customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2' 
    },
            }).then (function (result) {
                if (result.value) {
                    $.post($this.data('url'), {
                        _method: 'DELETE',
                        _token: '{{csrf_token()}}'
                    }, function(res) {
                        $this.closest('tr').fadeOut(500, function() {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection