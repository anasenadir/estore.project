@extends('layouts.master')

@section('title')
     المنتجات
@stop

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/button-info.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">المنتجات !</h2>
        </div>
    </div>
</div>
<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-end">
                                    {{-- <i class="mdi mdi-dots-horizontal text-gray"></i> --}}
									{{-- <h4 class="card-title mg-b-0 text-end">SIMPLE TABLE</h4> --}}
                                    <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
                                        <button class="btn btn-secondary btn-block">
                                            <a class="text-decoration-none text-light" href="{{URL::to('products/create')}}">إضافة منتج جديد</a>
                                        </button>
                                    </div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-13p border-bottom-0">إسم المنتج</th>
												<th class="wd-13p border-bottom-0">نوع المنتج</th>
												<th class="wd-13p border-bottom-0">كمية المنتج</th>
												<th class="wd-13p border-bottom-0">ثمن الشراء</th>
												<th class="wd-13p border-bottom-0">ثمن البيع</th>
												<th class="wd-13p border-bottom-0">وحدة القياس</th>
												<th class="wd-13p border-bottom-0">رقم المنتج</th>
												<th class="wd-10p border-bottom-0">التحكم</th>
											</tr>
										</thead>
										<tbody>
                                            @if (isset($products))
                                                {{-- mdfljfkjfkjfkjkfkjf --}}
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{$product->name}}</td>
                                                        <td>{{$product->productCategory->name}}</td>
                                                        <td>{{$product->quatity}}</td>
                                                        <td>{{$product->buy_price}}</td>
                                                        <td>{{$product->sell_price}}</td>
                                                        <td>{{unit_name($product->unit)}}</td>
                                                        {{-- <td>{{$product->unit}}</td> --}}
                                                        <td>{{$product->product_code}}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group dropend">
                                                                <!-- <button type="button" class="dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                                </button> -->
                                                                <i class="bi bi-caret-left-square-fill dropdown-toggle-split control-btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                                <ul class="dropdown-menu my-drop-down">
                                                                    <!-- Dropdown menu links -->
                                                                    <li><a href="{{route('products.edit' , $product->id)}}"><i class="bi bi-eye-fill"></i>تعديل المنتج</a></li>
                                                                    <li>
                                                                        <form action="{{route('products.destroy' , $product->id)}}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"  onclick="return confirm('هل تريد حذف هذا المنتج')">
                                                                                <i class="bi bi-eye-fill"></i>حذف المنتج
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->					  
@endsection


@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

@endsection