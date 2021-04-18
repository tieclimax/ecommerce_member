@extends('user.layouts.master')

@section('title', 'Payment Update')

@section('main-content')
    <div class="card mx-4">

        <h5 class="card-header"> อัปโหลดรูปภาพการชำระเงิน </h5>
        <div class="card-body">
            <form action="{{ route('user.order.slipupload', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">

                    <label for="status">สลิปการโอนเงิน :</label>
                    <div class="form-group">
                        <label for="inputPhoto" class="col-form-label"> รูป<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                    เลือก
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="slip_photo"
                                value="{{ old('slip_photo') }}">
                        </div>
                        <div id="holder" class="my-3" style="width: 256px"></div>
                        @error('slip_photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">อัปโหลด</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info,
        .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4,
        .shipping-info h4 {
            text-decoration: underline;
        }

    </style>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $('#lfm').filemanager('image');

        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "เขียนบรรยายสั้น ๆ ..... ",
                tabsize: 2,
                height: 100
            });
        });

        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "เขียนคำอธิบายรายละเอียด ..... ",
                tabsize: 2,
                height: 150
            });
        });

    </script>
@endpush
