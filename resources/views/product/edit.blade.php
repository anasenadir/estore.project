@extends('layouts.master')

@section('title')
    إنشاء منتج جديد
@stop
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">إنشاء منتج جديد</h2>
        </div>
    </div>
</div>
<!-- row opened -->
    <form action='{{route('products.update' , $product->id)}}' method='POST' class="row">
        @csrf
        @method('PUT')
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-3">
                            <div class="form-group mg-b-0">
                                <label class="form-label">إسم المنتج: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="product_name" placeholder="أدخل إسم المنتج" value="{{$product->name}}"   required="" type="text">
                            </div>
                            @error('product_name')
                                <div class="alert alert-danger">product name is importent</div>
                            @enderror
                        </div>
                        <div class="col-3">
                            <div class="form-group mg-b-0">
                                <label class="form-label">كمية المنتج: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="product_quantity" placeholder="أدخل كمية المنتج" required="" value="{{$product->quatity}}" min='0' type="number">
                            </div>
                            @error('product_quantity')
                                <div class="alert alert-danger">product quantity is importent</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-group ">
                                <label class="form-label">نوع المنتج: <span class="tx-danger">*</span></label>
                                {{-- <input class="form-control" name="lastname" placeholder="Enter lastname" required="" type="text"> --}}
                                <div class="parsley-select mg-b-0" id="slWrapper">
                                    <select class="form-control select2" data-parsley-class-handler="#slWrapper" name='category' value="{{old('category')}} data-parsley-errors-container="#slErrorContainer" data-placeholder="chosse one" required="">
                                        <option label="chosse one">
                                        </option>
                                        @if (isset($productCategories))
                                            @foreach ($productCategories as $productCategory)
                                                <option value="{{$productCategory->id}}" @if ($product->category_id == $productCategory->id)
                                                        selected
                                                    @endif>
                                                    {{$productCategory->name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="slErrorContainer"></div>
                                </div>
                                @error('category')
                                    <div class="alert alert-danger">category is importent</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group mg-b-0">
                                <label class="form-label">ثمن الشراء : <span class="tx-danger">*</span></label>
                                <input class="form-control" name="buy_price" placeholder="أدخل ثمن الشراء " required="" min='0' type="number" value="{{$product->buy_price}}" step='0.01'>
                            </div>
                            @error('buy_price')
                                <div class="alert alert-danger">buy price is importent</div>
                            @enderror
                        </div>
                        <div class="col-3 mg-b-0">
                            <div class="form-group">
                                <label class="form-label">ثمن البيع : <span class="tx-danger">*</span></label>
                                <input class="form-control" name="sell_price" placeholder="أدخل ثمن البيع" required="" min='0' type="number" value='{{$product->sell_price}}' step='0.01'>
                            </div>
                            @error('sell_price')
                                <div class="alert alert-danger">sell price is importent</div>
                            @enderror
                        </div>
                        <div class="col-3">
                            <div class="form-group mg-b-0">
                                <label class="form-label">رقم المنتج : <span class="tx-danger">*</span></label>
                                <input class="form-control" name="product_code" placeholder="أدخل رقم المنتج" required="" value='{{$product->product_code}}' type="text">
                            </div>
                            @error('product_code')
                                <div class="alert alert-danger">product number is importent</div>
                            @enderror
                        </div>
                                {{-- <input class="form-control" name="product_quantity" placeholder="أدخل رقم المنتج" required="" type="text"> --}}
                        <div class="col-3">
                            <div class="form-group mg-b-0">
                                <label class="form-label">وحدة القياس : <span class="tx-danger">*</span></label>
                                {{-- <input class="form-control" name="lastname" placeholder="Enter lastname" required="" type="text"> --}}
                                <div class="parsley-select" id="slWrapper">
                                    <select class="form-control select2" name='product_unit'  data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="chosse one" required="">
                                        <option label="chosse one">
                                        </option>
                                        <option value="1" @if ($product->unit == '1')
                                            selected
                                        @endif>
                                            للمتر 
                                        </option>
                                        <option value="2"@if ($product->unit == '2')
                                            selected
                                        @endif>
                                            للوحدة
                                        </option>
                                    </select>
                                    <div id="slErrorContainer"></div>
                                </div>
                                @error('product_unit')
                                    <div class="alert alert-danger">product unit is importent</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end"><button class="col-2 btn btn-main-primary pd-x-20 mg-t-10" type="submit">حفظ</button></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
        </div> --}}
    </form>
@endsection


@section('js')
<!--Internal  Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection

