@extends('superadmin.layouts.master')

@section('main-content')

    <div class="card">
        <h5 class="card-header">เพิ่มโพสต์ Category</h5>
        <div class="card-body">
            <form method="post" action="{{ route('superadminpost-category.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title</label>
                    <input id="inputTitle" type="text" name="title" placeholder="กรอกชื่อหัวข้อ"
                        value="{{ old('title') }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">สถานะ</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning"> รีเซ็ต </button>
                    <button class="btn btn-success" type="submit"> ส่ง </button>
                </div>
            </form>
        </div>
    </div>

@endsection
