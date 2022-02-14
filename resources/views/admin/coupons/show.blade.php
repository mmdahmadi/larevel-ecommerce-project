@extends('admin.layouts.admin')
@section('title','show coupons')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold"> کوپن : {{$coupon->name}}</h5>
            </div>
            <hr>
            <div class="row">
                   <div class="form-group col-md-3">
                       <label>نام</label>
                       <input type="text" value="{{$coupon->name}}" disabled class="form-control">
                   </div>
                    <div class="form-group col-md-3">
                        <label for="code">کد</label>
                        <input type="text" name="code" id="code" value="{{$coupon->code}}" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">نوع</label>
                        <select name="type" id="type" class="form-control" disabled>
                            <option value="amount" {{ $coupon->getRawOriginal('type') == 'amount' ? 'selected' : '' }}>مبلغی</option>
                            <option value="percentage" {{ $coupon->getRawOriginal('type') == 'percentage' ? 'selected' : '' }}>درصدی</option>
                        </select>

                    </div>
                    <div class="form-group col-md-3">
                        <label for="amount">مبلغ</label>
                        <input type="text" name="amount" id="amount" value="{{$coupon->amount}}" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="percentage">درصد</label>
                        <input type="text" name="percentage" id="percentage" value="{{$coupon->percentage}}" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="max_percentage_amount">حداکثر مبلغ برای نوع درصدی</label>
                        <input type="text" name="max_percentage_amount" id="max_percentage_amount" value="{{$coupon->max_percentage_amount}}" class="form-control" disabled>
                    </div>

                    <div class="form-group col-md-3">
                        <label>تاریخ انقضا</label>
                        <input type="text" value="{{verta($coupon->expired_at)}}" disabled class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>تاریخ ایجاد</label>
                        <input type="text" value="{{verta($coupon->created_at)}}" disabled class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description" name="description" disabled>{{ $coupon->description   }}</textarea>
                    </div>
                       </div>
                 <a href="{{route('admin.coupons.index')}}" class="btn btn-dark mt-3">بازگشت</a>
               </div>


        </div>

@endsection
