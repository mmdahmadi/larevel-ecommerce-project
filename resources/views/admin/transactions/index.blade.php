@extends('admin.layouts.admin')
@section('title','index transactions')
@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class=" d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-4 mb-md-0">لیست سفارشات ({{$transactions->total()}})</h5>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربر</th>
                            <th>شماره سفارش</th>
                            <th>مبلغ</th>
                            <th>ref_id</th>
                            <th>نام درگاه پرداخت</th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $key => $transaction)
                            <tr>
                                <th>{{$transactions->firstItem() + $key}}</th>
                                <th>{{$transaction->user->name == null ? 'کاربر' : $transaction->user->name}}</th>
                                <th>{{ $transaction->order_id }}</th>
                                <th>{{ number_format($transaction->amount) }}</th>
                                <th>{{$transaction->ref_id}}</th>
                                <th>{{$transaction->gateway_name}}</th>
                                <th>
                                    <span
                                        class="{{ $transaction->getRawOriginal('status') ? 'text-success' : 'text-danger' }}">
                                        {{ $transaction->status }}
                                    </span>
                                </th>
{{--                                <th>--}}
{{--                                    <a href="{{route('admin.transactions.show',['transaction'=>$transaction->id])}}" class="btn btn-sm btn-outline-success">نمایش</a>--}}
{{--                                    <a href="{{route('admin.transactions.edit',['transaction'=>$transaction->id])}}" class="btn btn-sm btn-outline-info mr-3">ویرایش</a>--}}
{{--                                </th>--}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{$transactions->render()}}
            </div>
        </div>
    </div>
@endsection
