@extends('layouts.admin')

@section('title', __('product.Create_Product'))
@section('content-header', __('product.Create_Product'))

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">{{ __('product.Name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    required placeholder="{{ __('product.Name') }}" value="{{ old('name') }}">
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
                            <input type="file" class="custom-file-input" name="image" required id="customFile"
                                accept="image/*" onchange="showImageName(this); previewImage(this)">
                            <label class="custom-file-label" for="customFile"
                                id="customImageLabel">{{__('product.Choose_file')}}</label>
                        </div>
                    </div>
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
                <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror" required
                    id="barcode" placeholder="{{ __('product.Barcode') }}" value="{{ old('barcode') }}">
                @error('barcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">{{ __('product.Price') }}</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                    required placeholder="{{ __('product.Price') }}" value="{{ old('price') }}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">{{ __('product.Quantity') }}</label>
                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                    required id="quantity" placeholder="{{ __('product.Quantity') }}" value="{{ old('quantity', 1) }}">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">{{ __('product.Status') }}</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                    <option value="1" {{ old('status')===1 ? 'selected' : '' }}>{{ __('common.Active') }}</option>
                    <option value="0" {{ old('status')===0 ? 'selected' : '' }}>{{ __('common.Inactive') }}</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">{{ __('common.Create') }}</button>
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