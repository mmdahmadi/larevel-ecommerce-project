@extends('admin.layouts.admin')
@section('title','edit users')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش کاربر {{$user->name}}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{route('admin.users.update' , ['user' => $user->id])}}" method="post">
                @csrf
                @method('put')
               <div class="form-row">
                   <div class="form-group col-md-3">
                       <label for="name">نام</label>
                       <input type="text" name="name" value="{{$user->name}}" class="form-control">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="email">ایمیل</label>
                       <input type="email" name="email"value="{{$user->email}}" class="form-control">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="role">نقش کاربر</label>
                       <select class="form-control" name="role" id="role">
                           <option></option>
                           @foreach($roles as $role)
                               <option value="{{ $role->name }}" {{ in_array($role->id , $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                           @endforeach
                       </select>
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

                           <div id="collapsePermission" class="collapse" aria-labelledby="headingOne" data-parent="#accordionPermission">
                               <div class="card-body row">
                                   @foreach($permissions as $permission)
                                       <div class="form-group form-check col-md-3">
                                           <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}"
                                                  name="{{ $permission->name }}" value="{{ $permission->name }}"
                                               {{ in_array($permission->id , $user->permissions->pluck('id')->toArray() ) ? 'checked' : '' }}
                                           >
                                           <label class="form-check-label mr-3" for="permission_{{ $permission->id }}">{{ $permission->display_name }}</label>
                                       </div>
                                   @endforeach
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
                <button class="btn btn-outline-primary mt-4" type="submit">ویرایش</button>
                <a href="{{route('admin.users.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
