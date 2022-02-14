@extends('admin.layouts.admin')
@section('title','edit banners')
@section('script')
    <script>
        $('#banner_image').change(function (){
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش بنر : {{ $banner->image }}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <div class="row justify-content-center mb-5">
                <div class="col-md-4 ">
                    <img src="{{ url(env('BANNER_IMAGE_UPLOAD_PATH').$banner->image)}}" alt="{{ $banner->image }}" class="card-img-top">
                </div>
            </div>

            <form action="{{route('admin.banners.update' , ['banner' => $banner])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="banner_image">انتخاب تصویر </label>
                        <div class="custom-file">
                            <input type="file" name="image" id="banner_image" class="custom-file-input">
                            <label for="banner_image" class="custom-file-label">انتخاب فایل</label>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="title">عنوان</label>
                        <input type="text" name="title" id="title" value="{{$banner->title}}" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="text">متن</label>
                        <input type="text" name="text" id="text" value="{{$banner->text}}" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="priority">الویت</label>
                        <input type="number" name="priority" id="priority" value="{{$banner->priority}}" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" {{ $banner->getRawOriginal('is_active') == 1 ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ $banner->getRawOriginal('is_active') == 0 ? 'selected' : '' }}>غیر فعال</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">نوع بنر</label>
                        <input type="text" name="type" id="type" value="{{$banner->type}}" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_text">متن دکمه</label>
                        <input type="text" name="button_text" id="button_text" value="{{$banner->button_text}}" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_link">لینک دکمه</label>
                        <input type="text" name="button_link" id="button_link" value="{{$banner->button_link}}" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_icon">آیکون دکمه</label>
                        <input type="text" name="button_icon" id="button_icon" value="{{$banner->button_icon}}" class="form-control">
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-4">ثبت</button>
                <a href="{{route('admin.banners.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
