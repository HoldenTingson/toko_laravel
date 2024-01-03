@extends('layouts.admin')

@section('title', __('customer.Update_Customer'))
@section('content-header', __('customer.Update_Customer'))

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">{{ __('customer.First_Name') }}</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    id="first_name" placeholder="{{ __('customer.First_Name') }}"
                    value="{{ old('first_name', $customer->first_name) }}">
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">{{ __('customer.Last_Name') }}</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                    id="last_name" placeholder="{{ __('customer.Last_Name') }}"
                    value="{{ old('last_name', $customer->last_name) }}">
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('customer.Email') }}</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    placeholder="{{ __('customer.Email') }}" value="{{ old('email', $customer->email) }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">{{ __('customer.Phone') }}</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    placeholder="{{ __('customer.Phone') }}" value="{{ old('phone', $customer->phone) }}">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">{{ __('customer.Address') }}</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                    id="address" placeholder="{{ __('customer.Address') }}"
                    value="{{ old('address', $customer->address) }}">
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label>{{__('customer.Avatar')}}</label>
                    <div class="preview mb-2" style="display: none">
                        <img id="coverPreview" style="height: 100px" width="70px">
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="avatar" id="customFile" accept="image/*"
                                onchange="showImageName(this); previewImage(this)">
                            <label class="custom-file-label" for="customFile"
                                id="customImageLabel">{{__('customer.Choose_file')}}</label>
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


            <button class="btn btn-primary" type="submit">Update</button>
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