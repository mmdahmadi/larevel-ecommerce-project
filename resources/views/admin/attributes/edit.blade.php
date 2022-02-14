@extends('admin.layouts.admin')
@section('title','edit attributes')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش ویژگی {{$attribute->name}}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{route('admin.attributes.update' , ['attribute' => $attribute->id])}}" method="post">
                @csrf
                @method('put')
               <div class="form-row">
                   <div class="form-group col-md-3">
                       <label for="name">نام</label>
                       <input type="text" name="name" id="name" value="{{$attribute->name}}" class="form-control">
                   </div>
               </div>
                <button class="btn btn-outline-primary mt-4" type="submit">ویرایش</button>
                <a href="{{route('admin.attributes.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
