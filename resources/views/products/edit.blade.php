@extends('layouts.admin')

@section('title', __('product.Edit_Product'))
@section('content-header', __('product.Edit_Product'))

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">{{ __('product.Name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="{{ __('product.Name') }}" value="{{ old('name', $product->name) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label>{{__('product.Image')}}</label>
                    <div class="preview mb-2" style="display: none">
                        <img id="coverPreview" style="height: 100px" width="70px">
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="customFile" accept="image/*"
                                onchange="showImageName(this); previewImage(this)">
                            <label class="custom-file-label" for="customFile"
                                id="customImageLabel">{{__('product.Choose_file')}}</label>
                        </div>
                    </div>
                    <div style="color: red">Upload a new image, if you want to change.</div>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="barcode">{{ __('product.Barcode') }}</label>
                <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror"
                    id="barcode" placeholder="{{ __('product.Barcode') }}"
                    value="{{ old('barcode', $product->barcode) }}">
                @error('barcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">{{ __('product.Price') }}</label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                    placeholder="{{ __('product.Price') }}" value="{{ old('price', $product->price) }}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">{{ __('product.Quantity') }}</label>
                <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                    id="quantity" placeholder="{{ __('product.Quantity') }}"
                    value="{{ old('quantity', $product->quantity) }}">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">{{ __('product.Status') }}</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                    <option value="1" {{ old('status', $product->status) === 1 ? 'selected' : ''}}>{{
                        __('common.Active') }}</option>
                    <option value="0" {{ old('status', $product->status) === 0 ? 'selected' : ''}}>{{
                        __('common.Inactive') }}</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">{{ __('common.Update') }}</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
    function showImageName(input) {
        var fileName = input.files[0].name;
        var label = document.getElementById('customImageLabel');
        label.innerText = fileName;
    }

    function showFileName(input) {
        var fileName = input.files[0].name;
        var label = document.getElementById('customFileLabel');
        label.innerText = fileName;
    }

    function previewImage(input) {
        var preview = document.getElementById('coverPreview');
        var file = input.files[0];
        var reader = new FileReader();

        if (file) {
            document.querySelector('.preview').style.display = 'block';

            reader.onloadend = function () {
                preview.src = reader.result;
            }
            reader.readAsDataURL(file);
        } else {
            document.querySelector('.preview').style.display = 'none';
            preview.src = "";
        }
    }

</script>
@endsection