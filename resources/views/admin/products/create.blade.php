@extends('admin.layouts.admin')
@section('title','create products')
@section('script')
    <script>
        $ ('#brandSelect').selectpicker({
            'title' : 'انتخاب برند'
        });
        $ ('#tagSelect').selectpicker({
            'title' : 'انتخاب تگ'
        });

        $('#primary_image').change(function (){
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });
        $('#images').change(function (){
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });
        $ ('#categorySelect').selectpicker({
            'title' : 'انتخاب دسته بندی'
        });
        $('#attributesContainer').hide();
        $('#categorySelect').on('changed.bs.select', function() {
            let categoryId = $(this).val();

            $.get(`{{ url('/admin-panel/management/category-attributes/${categoryId}') }}` , function(response , status){
                if(status == 'success'){

                    $('#attributesContainer').fadeIn();
                    // Empty Attribute Container
                    $('#attributes').find('div').remove();

                    // Create and Append Attributes Input
                    response.attributes.forEach(attribute => {
                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3'
                        });
                        attributeFormGroup.append($('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type: 'text',
                            class : 'form-control',
                            id : attribute.name,
                            name : `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);
                    });

                    $('#variationName').text(response.variation.name);

                }else{
                    alert('مشکل در دریافت لیست ویژگی ها');
                }
            }).fail(function(){
                alert('مشکل در دریافت لیست ویژگی ها');
            })





        });
        $("#czContainer").czMore();

    </script>
@endsection
@section('content')
    <div class="row">
        <div class=" col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد محصول</h5>
            </div>
            <hr>
            @include('admin.sections.errors')

            <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
               <div class="form-row">
                   <div class="form-group col-md-3">
                       <label for="name">نام</label>
                       <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="brand_id">برند</label>
                       <select id="brandSelect" name="brand_id" class="form-control" data-live-search="true">
                           @foreach ($brands as $brand)
                               <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                           @endforeach
                       </select>
                   </div>
                   <div class="form-group col-md-3">
                       <label for="is_active">وضعیت</label>
                       <select class="form-control" id="is_active" name="is_active">
                           <option value="1" selected>فعال</option>
                           <option value="0">غیرفعال</option>
                       </select>
                   </div>
                   <div class="form-group col-md-3">
                       <label for="tags_ids">تگ</label>
                       <select id="tagSelect" name="tags_ids[]" class="form-control" multiple
                               data-live-search="true">
                           @foreach ($tags as $tag)
                               <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                           @endforeach
                       </select>
                   </div>
                   <div class="form-group col-md-12">
                       <label for="description">توضیحات</label>
                       <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                   </div>

                   <div class="col-md-12">
                       <hr>
                         <p>  تصاویر محصول :</p>
                   </div>

                   <div class="form-group col-md-3">
                       <label for="primary_image">انتخاب تصویر اصلی</label>
                       <div class="custom-file">
                           <input type="file" name="primary_image" id="primary_image" class="custom-file-input">
                           <label for="primary-image" class="custom-file-label">انتخاب فایل</label>
                       </div>
                   </div>

                   <div class="form-group col-md-3">
                   <label for="images">انتخاب تصاویر</label>
                   <div class="custom-file">
                       <input type="file" name="images[]" multiple id="images" class="custom-file-input">
                       <label for="images" class="custom-file-label"> انتخاب فایل ها</label>
                   </div>
               </div>

                   <div class="col-md-12">
                       <hr>
                       <p>  دسته بندی و ویژگی ها :</p>
                   </div>

                   <div class="col-md-12">
                       <div class="row justify-content-center">
                           <div class="form-group col-md-3">
                               <label for="category_id">دسته بندی</label>
                               <select id="categorySelect" name="category_id" class="form-control" data-live-search="true">
                                   @foreach ($categories as $category)
                                       <option value="{{ $category->id }}">{{ $category->name }} - {{$category->parent->name}} </option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                   </div>

                   <div id="attributesContainer" class="col-md-12">
                       <div id="attributes" class="row"></div>
                        <div class="col-md-12">
                            <hr>
                            <p>افزودن قیمت و موجودی برای متغیر <span id="variationName" class="font-weight-bold"></span> : </p>
                        </div>
                       <div id="czContainer">
                           <div id="first">
                               <div class="recordset">
                                   <div class="row">
                                       <div class="form-group col-md-3">
                                           <label >نام</label>
                                           <input type="text" name="variation_values[value][]" class="form-control">
                                       </div>
                                       <div class="form-group col-md-3">
                                           <label >قیمت</label>
                                           <input type="text" name="variation_values[price][]" class="form-control">
                                       </div>
                                       <div class="form-group col-md-3">
                                           <label >تعداد</label>
                                           <input type="text" name="variation_values[quantity][]" class="form-control">
                                       </div>
                                       <div class="form-group col-md-3">
                                           <label >شناسه انبار</label>
                                           <input type="text" name="variation_values[sku][]" class="form-control">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>

                   </div>

                   <div class="col-md-12">
                       <hr>
                       <p>  هزینه ارسال :</p>
                   </div>
                   <div class="form-group col-md-3">
                       <label for="delivery_amount">هزینه ارسال</label>
                       <input type="text" name="delivery_amount" id="delivery_amount" class="form-control" value="{{old('delivery_amount')}}">
                   </div>
                   <div class="form-group col-md-3">
                       <label for="delivery_amount-per-product">هزینه ارسال به ازای محصول اضافی</label>
                       <input type="text" name="delivery_amount_per_product" id="delivery_amount-per-product" class="form-control" value="{{old('delivery_amount-per-product')}}">
                   </div>


               </div>
                <button class="btn btn-outline-primary mt-4" type="submit">ثبت</button>
                <a href="{{route('admin.products.index')}}" class="btn btn-dark mt-4 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
