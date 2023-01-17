@extends('layouts.master')

@section('title')
{{ trans('pricing/default.page_title') }}
@stop

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/button-info.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ trans('pricing/default.pricing_title') }}</h2>
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
                                            <a class="text-decoration-none text-light" href="{{route('pricing.create')}}">{{ trans('pricing/default.add_new_pricing_invoice') }}</a>
                                        </button>
                                    </div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">{{ trans('pricing/default.pricing_number') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('pricing/default.client_name') }}</th>
												<th class="wd-17p border-bottom-0">{{ trans('pricing/default.date') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('pricing/default.product_count') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('pricing/default.pricing_total') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('pricing/default.controle') }}</th>
											</tr>
										</thead>
										<tbody>
                                            @if (isset($pricings))
                                                @foreach ($pricings as $pricing)
                                                    <tr>
                                                        <td>{{$pricing->invoice_code}}</td>
                                                        <td>{{$pricing->client->name}}</td>
                                                        <td>{{$pricing->created_at}}</td>
                                                        <td>{{$pricing->prDetials->count()}}</td>
                                                        <td>{{$pricing->getPricingTotal()}}</td>
                                                        
                                                        {{-- <td class="d-flex ">
                                                            <button class="btn btn-primary ml-3">
                                                                <a class="text-decoration-none text-light" href="{{URL::to('ProductCategories/' . $supplier->id . '/edit') }}">تعديل</a>
                                                            </button>

                                                            <form action="ProductCategories/{{$supplier->id}}" method="POST" >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button onclick="return confirm('هل تريد حذف هذا الصنف');" type='submit'class="btn btn-danger ">حدف</button>
                                                            </form>
                                                        </td> --}}

                                                        <td class="text-center">
                                                            <div class="btn-group dropend">
                                                                <!-- <button type="button" class="dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                                </button> -->
                                                                <i class="bi bi-caret-left-square-fill dropdown-toggle-split control-btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                                <ul class="dropdown-menu my-drop-down">
                                                                    <!-- Dropdown menu links -->
                                                                    <li><a href="{{route('pricing.edit' , $pricing->id)}}"><i class="las la-pencil-alt"></i>{{ trans('pricing/default.edit_pricing') }} </a></li>
                                                                    <li><a href="{{route('viewPricingInvoice' , $pricing->id)}}" target="_blanck"><i class="las la-eye"></i>{{ trans('pricing/default.see_the_pricing') }}</a></li>
                                                                    <li><a href="{{route('dounload' , $pricing->id)}}"><i class="las la-arrow-alt-circle-down"></i>{{ trans('pricing/default.download') }}</a></li>
                                                                    <li><a href="{{route('convertToSeleContract' , $pricing->id)}}"><i class="las la-recycle"></i>{{ trans('pricing/default.convert_to_sele_contract') }}</a></li>
                                                                    <li><a href="{{route('sendMail' , $pricing->id)}}"><i class="las la-paper-plane"></i>{{ trans('pricing/default.send_pricing') }}</a></li>
                                                                    <li>
                                                                        <form action="{{route('pricing.destroy' , $pricing->id)}}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"  onclick="return confirm('هل تريد حذف هذا التسعير')">
                                                                                <i class="las la-trash-alt"></i>{{ trans('pricing/default.delete_pricing') }}
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
{{-- <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script> --}}
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

@endsection