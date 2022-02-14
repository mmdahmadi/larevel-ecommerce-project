@extends('admin.layouts.admin')
@section('title','show attributes')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold"> ویژگی : {{$attribute->name}}</h5>
            </div>
            <hr>
            <div class="row">
                   <div class="form-group col-md-3">
                       <label>نام</label>
                       <input type="text" value="{{$attribute->name}}" disabled class="form-control">
                   </div>
                        <div class="form-group col-md-3">
                            <label>تاریخ ایجاد</label>
                            <input type="text" value="{{verta($attribute->created_at)}}" disabled class="form-control">
                        </div>
                       </div>
                 <a href="{{route('admin.attributes.index')}}" class="btn btn-dark mt-3">بازگشت</a>
               </div>


        </div>

@endsection
