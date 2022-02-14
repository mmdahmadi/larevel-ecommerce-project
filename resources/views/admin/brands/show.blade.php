@extends('admin.layouts.admin')
@section('title','show brands')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold"> برند : {{$brand->name}}</h5>
            </div>
            <hr>
            <div class="row">
                   <div class="form-group col-md-3">
                       <label>نام</label>
                       <input type="text" value="{{$brand->name}}" disabled class="form-control">
                   </div>
                       <div class="form-group col-md-3">
                           <label>وضعیت</label>
                           <input type="text" value="{{$brand->is_active}}" disabled class="form-control">
                       </div>
                        <div class="form-group col-md-3">
                            <label>تاریخ ایجاد</label>
                            <input type="text" value="{{verta($brand->created_at)}}" disabled class="form-control">
                        </div>
                       </div>
            <a href="{{route('admin.brands.index')}}" class="btn btn-dark mt-3">بازگشت</a>
               </div>


        </div>
    </div>
@endsection
