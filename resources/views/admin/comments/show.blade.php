@extends('admin.layouts.admin')
@section('title','show comments')

@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold"> کامنت :</h5>
            </div>
            <hr>
            <div class="row">
                   <div class="form-group col-md-3">
                       <label>نام کاربر</label>
                       <input type="text" value="{{$comment->user->name}}" disabled class="form-control">
                   </div>
                    <div class="form-group col-md-3">
                        <label>نام محصول</label>
                        <input type="text" value="{{$comment->product->name}}" disabled class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>وضعیت</label>
                        <input type="text" value="{{$comment->approved}}" disabled class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>تاریخ ایجاد</label>
                        <input type="text" value="{{verta($comment->created_at)}}" disabled class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>متن کامنت</label>
                        <textarea class="form-control" disabled>{{ $comment->text }}</textarea>
                    </div>

                       </div>
                <a href="{{route('admin.comments.index')}}" class="btn btn-dark mt-3">بازگشت</a>
                @if($comment->getRawOriginal('approved'))
                    <a href="{{route('admin.comments.change-approve' , ['comment' => $comment->id])}}" class="btn btn-danger mt-3">عدم تایید</a>
                @else
                    <a href="{{route('admin.comments.change-approve' , ['comment' => $comment->id])}}" class="btn btn-success mt-3">تایید</a>
                @endif
               </div>


        </div>

@endsection
