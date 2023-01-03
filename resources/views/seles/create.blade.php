@extends('layouts.master')

@section('title')
فاتورة مبيعات جديدة
@stop
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">فاتورة مبيعات جديدة</h2>
        </div>
    </div>
</div>
<!-- row opened -->
    <form action='{{route('seles.store')}}' method='POST' class="row">
        @csrf
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="row m-1 ">
                        <div class="main-content-label mg-b-5">
                            طريقة الدفع
                        </div>
                    </div>
                    <div class="row mt-2  mb-4">
                        <div class="col-lg-3">
                            <label class="rdiobox"><input checked name="pyment_type" type="radio" value="1" @if (isset($request) && $request->pyment_type == 1)
                                checked
                            @endif  name='pyment_type'> <span>كاش</span></label>
                        </div>
                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                            <label class="rdiobox"><input  name="pyment_type" value="2" @if (isset($request) && $request->pyment_type == 2) 
                                checked
                            @endif name='pyment_type' type="radio"> <span>شيك</span></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mg-b-0">
                                {{-- <label class="form-label">العميل : <span class="tx-danger">*</span></label> --}}
                                <div class="main-content-label mg-b-5 mb-2">
									العميل
								</div>
                                {{-- <input class="form-control" name="lastname" placeholder="Enter lastname" required="" type="text"> --}}
                                <div class="parsley-select" id="slWrapper">
                                    <select class="form-control select2" name='client_id'  data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="chosse one" required="">
                                        <option label="chosse one">
                                        </option>
                                        @if (isset($clients))
                                            @foreach ($clients as  $client)
                                                <option @if (isset($request) &&$request->client_id == $client->id)
                                                    selected
                                                @endif
                                                value="{{$client->id}}">
                                                    {{$client->name}}
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
                                {{-- <label class="form-label">المنتجات : <span class="tx-danger">*</span></label> --}}
                                <div class="main-content-label mg-b-5 mb-2">
									المنتجات
								</div>
                                {{-- <input class="form-control" name="lastname" placeholder="Enter lastname" required="" type="text"> --}}
                                <div class="parsley-select" id="slWrapper">
                                    <select class="form-control select2 product"   data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="chosse one">
                                        <option label="chosse one">
                                        </option>
                                        @if (isset($products))
                                            @foreach ($products as $product)
                                                @if (isset($request))
                                                    @if (!in_array($product->id ,$request->products_id ))
                                                        <option value="{{$product->id}}" data-price='{{$product->sell_price}}' data-name='{{$product->name}}'>
                                                            {{$product->name}}
                                                        </option>
                                                    @endif
                                                @else
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
                    <div class="btn btn-primary add my-2">click</div>
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
                                @if (isset($request))

                                    @foreach ($request->products_id as $index=> $item)
                                        <tr>
                                            <td><input class='form-control ' type="test" name='products_names[]'  readonly  value='{{$request->products_names[$index]}}' min='0' step='1'/></td>
                                            <td class="d-none"><input class='form-control' type="test" hidden name='products_id[]' value='{{$item}}' min='0' step='1'/></td>
                                            <td><input class='form-control' type="test" name='sele_quantities[]' value='{{$request->sele_quantities[$index]}}' min='0' step='1'/></td>
                                            <td><input class='form-control ' type="test" readonly name='expene_prices[]' value='{{$request->expene_prices[$index]}}'/></td>
                                            <td class="mx-auto d-flex justify-content-center align-items-center" style="height: 65px; cursor:pointer"><div class="badge badge-danger" onclick="removeItem(this)">delete</div></td>
                                        </tr>
                                    @endforeach
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
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>


<script src="{{URL::asset('assets/js/my-table-configuration.js')}}"></script>
@endsection