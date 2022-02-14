@extends('admin.layouts.admin')
@section('title','index coupons')
@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class=" d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-4 mb-md-0">لیست کوپن ها ({{$coupons->total()}})</h5>
                <div class="">
                    <a class="btn btn-sm btn-outline-primary" href="{{route('admin.coupons.create')}}">
                        <i class="fa fa-plus"></i>
                        ایجاد کوپن
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>کد</th>
                            <th>نوع</th>
                            <th>تاریخ انقضا</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $key => $coupon)
                            <tr>
                                <th>{{$coupons->firstItem() + $key}}</th>
                                <th>{{$coupon->name}}</th>
                                <th>{{$coupon->code}}</th>
                                <th>{{$coupon->type}}</th>
                                <th>{{verta($coupon->expired_at)}}</th>
                                <th>
                                    <a href="{{route('admin.coupons.show',['coupon'=>$coupon->id])}}" class="btn btn-sm btn-outline-success">نمایش</a>
                                    <a href="{{route('admin.coupons.edit',['coupon'=>$coupon->id])}}" class="btn btn-sm btn-outline-info mr-3">ویرایش</a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{$coupons->render()}}
            </div>
        </div>
    </div>
@endsection
