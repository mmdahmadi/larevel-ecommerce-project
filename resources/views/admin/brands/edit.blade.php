@extends('admin.layouts.admin')
@section('title','edit brands')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش برند {{$brand->name}}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{route('admin.brands.update' , ['brand' => $brand->id])}}" method="post">
                @csrf
                @method('put')
               <div class="form-row">
                   <div class="form-group col-md-3">
                       <label for="name">نام</label>
                       <input type="text" name="name" id="name" value="{{$brand->name}}" class="form-control">
                   </div>
                       <div class="form-group col-md-3">
                           <label for="is_active">وضعیت</label>
                           <select name="is_active" id="is_active" class="form-control">
                               <option value="1" {{$brand->getRawOriginal('is_active') ? 'selected' : ''}}>فعال</option>
                               <option value="0" {{$brand->getRawOriginal('is_active') ? '' : 'selected'}} >غیر فعال</option>
                           </select>
                       </div>
               </div>
                <button class="btn btn-outline-primary mt-4">ویرایش</button>
                <a href="{{route('admin.brands.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
