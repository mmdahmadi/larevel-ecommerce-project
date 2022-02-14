@extends('admin.layouts.admin')
@section('title','index orders')
@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class=" d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-4 mb-md-0">لیست سفارشات ({{$orders->total()}})</h5>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربر</th>
                            <th>وضعیت</th>
                            <th>مبلغ</th>
                            <th>نوع پرداخت</th>
                            <th>وضعیت پرداخت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                            <tr>
                                <th>{{$orders->firstItem() + $key}}</th>
                                <th>{{$order->user->name == null ? 'کاربر' : $order->user->name}}</th>
                                <th>{{ $order->status }}</th>
                                <th>{{ number_format($order->total_amount) }}</th>
                                <th>{{$order->payment_type}}</th>
                                <th>
                                    <span
                                        class="{{ $order->getRawOriginal('payment_status') ? 'text-success' : 'text-danger' }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </th>
                                <th>
                                    <a href="{{route('admin.orders.show',['order'=>$order->id])}}" class="btn btn-sm btn-outline-success">نمایش</a>
{{--                                    <a href="{{route('admin.orders.edit',['order'=>$order->id])}}" class="btn btn-sm btn-outline-info mr-3">ویرایش</a>--}}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{$orders->render()}}
            </div>
        </div>
    </div>
@endsection
