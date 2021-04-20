@extends('superadmin.layouts.master')

@section('main-content')

    <div class="card">
        <h5 class="card-header">Edit Post Tag</h5>
        <div class="card-body">
            <form method="post" action="{{ route('superadminpost-tag.update', $postTag->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title</label>
                    <input id="inputTitle" type="text" name="title" placeholder="กรอกชื่อหัวข้อ"
                        value="{{ $postTag->title }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">สถานะ</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $postTag->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $postTag->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
