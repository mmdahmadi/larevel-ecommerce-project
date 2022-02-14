@extends('admin.layouts.admin')
@section('title','show roles')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">نمایش نقش {{ $role->display_name }}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')

               <div class="form-row">
                   <div class="form-group col-md-3">
                       <label for="display_name">نام نمایشی</label>
                       <input type="text" name="display_name" disabled value="{{$role->display_name}}" class="form-control">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="name">نام</label>
                       <input type="text" name="name" disabled value="{{$role->name}}" class="form-control">
                   </div>
                   <div class="accordion col-md-12 mt-3" id="accordionPermission">
                       <div class="card">
                           <div class="card-header p-1" id="headingOne">
                               <h2 class="mb-0">
                                   <button class="btn btn-link btn-block text-right" type="button" data-toggle="collapse" data-target="#collapsePermission" aria-expanded="true" aria-controls="collapsePermission">
                                       مجوز های دسترسی
                                   </button>
                               </h2>
                           </div>

                           <div id="collapsePermission" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionPermission">
                               <div class="card-body row">
                                   @foreach($role->permissions as $permission)
                                       <span>{{ $permission->display_name }}{{ $loop->last ? '' : '،' }} </span>
                                   @endforeach
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
                <a href="{{route('admin.roles.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
        </div>
    </div>
@endsection
