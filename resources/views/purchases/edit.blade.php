@extends('layouts.master')

@section('title')
تعديل الوثيقة
@stop
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">تعديل الوثيقة</h2>
        </div>
    </div>
</div>
<!-- row opened -->
    <form action='{{route('purchases.update' , $purchase->id)}}' method='POST' class="row">
        @csrf
        @method('PATCH')
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mg-b-0">
                                <div class="main-content-label mg-b-5 mb-2">
									المزود
								</div>
                                <div class="parsley-select" id="slWrapper">
                                    <select class="form-control select2" name='supplier_id'  data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="chosse one" required="">
                                        <option label="chosse one">
                                        </option>
                                        @if (isset($suppliers))
                                            @foreach ($suppliers as  $supplier)
                                                <option @if ($supplier->id == $purchase->supplier_id)
                                                    selected
                                                @endif
                                                value="{{$supplier->id}}">
                                                    {{$supplier->name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="slErrorContainer"></div>
                                </div>
                                @error('product_unit')
                                    <div class="alert alert-danger">product unit is importent</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group mg-b-0">
                                <div class="main-content-label mg-b-5 mb-2">
									المنتجات
								</div>
                                <div class="parsley-select" id="slWrapper">
                                    <select class="form-control select2 product"   data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="chosse one">
                                        <option label="chosse one">
                                        </option>
                                        @if (isset($products))
                                            @foreach ($products as $product)
                                                @if (!in_array( $product->id ,$productsID))
                                                    <option value="{{$product->id}}" data-price='{{$product->sell_price}}' data-name='{{$product->name}}'>
                                                        {{$product->name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="slErrorContainer"></div>
                                </div>
                                @error('product_unit')
                                    <div class="alert alert-danger">product unit is importent</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row my-2">
                    </div> --}}
                    <div class="btn btn-primary mt-2 add">click</div>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>إسم المنتج</th>
                                    <th>الكمية المرادة</th>
                                    <th>سعر المنتج</th>
                                    <th>التحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if (isset($request))

                                   
                                @endif --}}

                                @if (isset($request) && !is_null($request->products_id))
                                    @foreach ($request->products_id as $index=> $item)
                                        <tr>
                                            <td><input class='form-control ' type="test" name='products_names[]'  readonly  value='{{$request->products_names[$index]}}' min='0' step='1'/></td>
                                            <td class="d-none"><input class='form-control' type="test" hidden name='products_id[]' value='{{$item}}' min='0' step='1'/></td>
                                            <td><input class='form-control' type="test" name='sele_quantities[]' value='{{$request->sele_quantities[$index]}}' min='0' step='1'/></td>
                                            <td><input class='form-control ' type="test" readonly name='expene_prices[]' value='{{$request->expene_prices[$index]}}'/></td>
                                            <td class="mx-auto d-flex justify-content-center align-items-center" style="height: 65px; cursor:pointer"><div class="badge badge-danger" onclick="removeItem(this)">delete</div></td>
                                        </tr>
                                    @endforeach
                                @else
                                    @if (isset($purchaseDetails))
                                    @foreach ($purchaseDetails as $purchaseDetail)
                                        <tr>
                                            <td><input class='form-control ' type="test" readonly  name='products_names[]'  value='{{$purchaseDetail->product->name}}' min='0' step='1'/></td>
                                            <td class="d-none"><input class='form-control ' type="test" hidden name='products_id[]' value='{{$purchaseDetail->product_id}}' min='0' step='1'/></td>
                                            <td><input class='form-control ' type="test" name='sele_quantities[]' value='{{$purchaseDetail->quantity}}' min='0' step='1'/></td>
                                            <td><input class='form-control ' type="test" readonly name='expene_prices[]' value='{{$purchaseDetail->product_price}}'/></td>
                                            <td class="mx-auto d-flex justify-content-center align-items-center" style="height: 65px; cursor:pointer"><div class="badge badge-danger" onclick="removeItem(this)">delete</div></td>
                                        </tr>
                                    @endforeach
                                @endif
                                @endif
                                
                            </tbody>
                        </table>
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
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
{{-- <script src="{{URL::asset('assets/js/table-data.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!--Internal  Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Parsley.min js -->
{{-- <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script> --}}
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/js/my-table-configuration.js')}}"></script>
@endsection