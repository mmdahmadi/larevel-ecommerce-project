@extends('admin.layouts.admin')
@section('title','create attributes')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد ویژگی</h5>
            </div>
            <hr>
            @include('admin.sections.errors')

            <form action="{{route('admin.attributes.store')}}" method="post">
                @csrf
               <div class="form-row">
                   <div class="form-group col-md-3">
                       <label for="name">نام</label>
                       <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control">
                   </div>
               </div>
                <button class="btn btn-outline-primary mt-4" type="submit">ثبت</button>
                <a href="{{route('admin.attributes.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
