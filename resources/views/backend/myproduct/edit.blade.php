@extends('backend.layouts.master')

@section('main-content')

    <div class="card">
        <h5 class="card-header">แก้ไขสินค้า</h5>
        <div class="card-body">
            <form method="post" action="{{ route('myproduct.update', $product->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="owner_id" value={{ Auth::user()->id }}>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label"> หัวข้อ <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="กรอกชื่อหัวข้อ"
                        value="{{ $product->title }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">คำอธิบายสั้นๆ<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{ $product->summary }}</textarea>
                    @error('summary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label"> คำอธิบาย </label>
                    <textarea class="form-control" id="description"
                        name="description">{{ $product->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="is_featured"> กำลังมาแรง </label><br>
                    <input type="checkbox" name='is_featured' id='is_featured' value='{{ $product->is_featured }}'
                        {{ $product->is_featured ? 'checked' : '' }}> ใช่
                </div>
                {{-- {{$categories}} --}}

                <div class="form-group">
                    <label for="cat_id"> หมวดหมู่ <span class="text-danger">*</span></label>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="">--เลือกหมวดหมู่ใดก็ได้--</option>
                        @foreach ($categories as $key => $cat_data)
                            <option value='{{ $cat_data->id }}'
                                {{ $product->cat_id == $cat_data->id ? 'selected' : '' }}>
                                {{ $cat_data->title }}</option>
                        @endforeach
                    </select>
                </div>
                @php
                    $sub_cat_info = DB::table('categories')
                        ->select('title')
                        ->where('id', $product->child_cat_id)
                        ->get();
                    // dd($sub_cat_info);
                @endphp
                {{-- {{$product->child_cat_id}} --}}
                <div class="form-group {{ $product->child_cat_id ? '' : 'd-none' }}" id="child_cat_div">
                    <label for="child_cat_id"> หมวดหมู่ย่อย </label>
                    <select name="child_cat_id" id="child_cat_id" class="form-control">
                        <option value="">--เลือกหมวดหมู่ย่อยใด ๆ--</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">ราคา(THB) <span class="text-danger">*</span></label>
                    <input id="price" type="number" name="price" placeholder="กรอกราคาสินค้า"
                        value="{{ $product->price }}" class="form-control">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="discount" class="col-form-label">ส่วนลด(%)</label>
                    <input id="discount" type="number" name="discount" min="0" max="100" placeholder="กรอกส่วนลด"
                        value="{{ $product->discount }}" class="form-control">
                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="size">ขนาดสินค้า</label>
                    <select name="size[]" class="form-control selectpicker" multiple data-live-search="true">
                        <option value="">--เลือกขนาดใดก็ได้--</option>
                        @foreach ($items as $item)
                            @php
                                $data = explode(',', $item->size);
                                // dd($data);
                            @endphp
                            <option value="S" @if (in_array('S', $data)) selected @endif>เล็ก</option>
                            <option value="M" @if (in_array('M', $data)) selected @endif>ปานกลาง</option>
                            <option value="L" @if (in_array('L', $data)) selected @endif>ใหญ่</option>
                            <option value="XL" @if (in_array('XL', $data)) selected @endif>>ใหญ่มาก</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id">ยี่ห้อ</label>
                    <select name="brand_id" class="form-control">
                        <option value="">--เลือกยี่ห้อ--</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="condition"> เงื่อนไข <span class="text-danger">*</label>
                    <select name="condition" class="form-control">
                        <option value="">--เลือกเงื่อนไข--</option>
                        <option value="default" {{ $product->condition == 'default' ? 'selected' : '' }}>Default</option>
                        <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>ใหม่</option>
                        <option value="hot" {{ $product->condition == 'hot' ? 'selected' : '' }}>Hot</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock"> ปริมาณสินค้า <span class="text-danger">*</span></label>
                    <input id="quantity" type="number" name="stock" min="0" placeholder="กรอกจำนวนสินค้าที่จะลงขาย"
                        value="{{ $product->stock }}" class="form-control">
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label"> รูป<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                <i class="fas fa-image"></i> เลือก
                            </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo"
                            value="{{ $product->photo }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">สถานะ <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">อัปเดต</button>
                </div>
            </form>
        </div>
    </div>

@endsection

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
                height: 150
            });
        });
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write detail Description.....",
                tabsize: 2,
                height: 150
            });
        });

    </script>

    <script>
        var child_cat_id = '{{ $product->child_cat_id }}';
        // alert(child_cat_id);
        $('#cat_id').change(function() {
            var cat_id = $(this).val();

            if (cat_id != null) {
                // ajax call
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (typeof(response) != 'object') {
                            response = $.parseJSON(response);
                        }
                        var html_option = "<option value=''>--เลือกคนใดคนหนึ่ง--</option>";
                        if (response.status) {
                            var data = response.data;
                            if (response.data) {
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data, function(id, title) {
                                    html_option += "<option value='" + id + "' " + (
                                            child_cat_id == id ? 'selected ' : '') + ">" +
                                        title + "</option>";
                                });
                            } else {
                                console.log('no response data');
                            }
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                });
            } else {

            }

        });
        if (child_cat_id != null) {
            $('#cat_id').change();
        }

    </script>
@endpush
