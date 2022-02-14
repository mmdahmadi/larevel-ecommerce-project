@extends('admin.layouts.admin')
@section('title','edit coupons')
@section('script')
    <script>
        $('#expireDate').MdPersianDateTimePicker({
            targetTextSelector: '#expireInput',
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش کوپن {{$coupon->name}}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{route('admin.coupons.update' , ['coupon' => $coupon->id])}}" method="post">
                @csrf
                @method('put')
               <div class="form-row">
                   <div class="form-group col-md-3">
                       <label for="name">نام</label>
                       <input type="text" name="name" id="name" value="{{$coupon->name}}" class="form-control">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="code">کد</label>
                       <input type="text" name="code" id="code" value="{{$coupon->code}}" class="form-control" >
                   </div>
                   <div class="form-group col-md-3">
                       <label for="type">نوع</label>
                       <select name="type" id="type" class="form-control" >
                           <option value="amount" {{ $coupon->getRawOriginal('type') == 'amount' ? 'selected' : '' }}>مبلغی</option>
                           <option value="percentage" {{ $coupon->getRawOriginal('type') == 'percentage' ? 'selected' : '' }}>درصدی</option>
                       </select>

                   </div>
                   <div class="form-group col-md-3">
                       <label for="amount">مبلغ</label>
                       <input type="text" name="amount" id="amount" value="{{$coupon->amount}}" class="form-control">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="percentage">درصد</label>
                       <input type="text" name="percentage" id="percentage" value="{{$coupon->percentage}}" class="form-control">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="max_percentage_amount">حداکثر مبلغ برای نوع درصدی</label>
                       <input type="text" name="max_percentage_amount" id="max_percentage_amount" value="{{$coupon->max_percentage_amount}}" class="form-control">
                   </div>

                   <div class="form-group col-md-3">
                       <label> تاریخ انقضا </label>
                       <div class="input-group">
                           <div class="input-group-prepend order-2">
                               <span class="input-group-text" id="expireDate">
                                   <i class="fas fa-clock"></i>
                               </span>
                           </div>
                           <input type="text" class="form-control" id="expireInput"
                                  name="expired_at"
                                  value="{{ $coupon->expired_at }}"
                           >
                       </div>
                   </div>
                   <div class="form-group col-md-12">
                       <label for="description">توضیحات</label>
                       <textarea class="form-control" id="description" name="description">{{ $coupon->description   }}</textarea>
                   </div>
               </div>
                <button class="btn btn-outline-primary mt-4" type="submit">ویرایش</button>
                <a href="{{route('admin.coupons.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
