@extends('admin.layouts.admin')
@section('title','create permissions')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد پرمیژن</h5>
            </div>
            <hr>
            @include('admin.sections.errors')

            <form action="{{route('admin.permissions.store')}}" method="post">
                @csrf
               <div class="form-row">
                   <div class="form-group col-md-3">
                       <label for="display_name">نام نمایشی</label>
                       <input type="text" name="display_name" value="{{old('display_name')}}" class="form-control">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="name">نام</label>
                       <input type="text" name="name" value="{{old('name')}}" class="form-control">
                   </div>
               </div>
                <button class="btn btn-outline-primary mt-4" type="submit">ثبت</button>
                <a href="{{route('admin.permissions.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
