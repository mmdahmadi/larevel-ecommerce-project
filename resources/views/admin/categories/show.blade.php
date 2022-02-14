@extends('admin.layouts.admin')
@section('title','show attributes')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold"> دسته بندی : {{$category->name}}</h5>
            </div>
            <hr>
            <div class="row">
                   <div class="form-group col-md-3">
                       <label>نام</label>
                       <input type="text" value="{{$category->name}}" disabled class="form-control">
                   </div>
                    <div class="form-group col-md-3">
                        <label>نام انگلیسی</label>
                        <input type="text" value="{{$category->slug}}" disabled class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>والد</label>
                        <div class="form-control div-disable">
                            @if($category->parent_id == 0)
                                {{$category->name}}
                            @else
                                {{$category->parent->name}}
                            @endif
                        </div>
                    </div>
                        <div class="form-group col-md-3">
                            <label>وضعیت</label>
                            <input type="text" value="{{$category->is_active}}" disabled class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>آیکون</label>
                            <input type="text" value="{{$category->icon}}" disabled class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label>تاریخ ایجاد</label>
                            <input type="text" value="{{verta($category->created_at)}}" disabled class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control" disabled>{{ $category->description }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">ویژگی ها</label>
                                    <div class="form-control div-disable">
                                        @foreach($category->attributes as $attribute)
                                            {{$attribute->name}}{{$loop->last ? '' : '،'}}
                                        @endforeach
                                    </div>
                                </div>
                                    <div class="col-md-3">
                                        <label for="">ویژگی های قابل فیلتر</label>
                                        <div class="form-control div-disable">
                                            @foreach($category->attributes()->wherePivot('is_filter' , 1)->get() as $attribute)
                                                {{$attribute->name}}{{$loop->last ? '' : '،'}}
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">ویژگی متغیر</label>
                                        <div class="form-control div-disable">
                                            @foreach($category->attributes()->wherePivot('is_variation' , 1)->get() as $attribute)
                                                {{$attribute->name}}{{$loop->last ? '' : '،'}}
                                            @endforeach
                                        </div>
                                    </div>

                        </div>

                       </div>
                 <a href="{{route('admin.categories.index')}}" class="btn btn-dark mt-3">بازگشت</a>
               </div>


        </div>

@endsection
