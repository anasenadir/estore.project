@extends('layouts.master')

@section('title')
{{ trans('purchases/default.page_title') }}
@stop

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/button-info.css')}}" rel="stylesheet">
<!---Internal  Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!--- Internal Sweet-Alert css-->
<link href="{{URL::asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ trans('purchases/default.purchases_title') }}</h2>
        </div>
    </div>
</div>

<!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-end">
                        <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
                            <button class="btn btn-secondary btn-block">
                                <a class="text-decoration-none text-light" href="{{route('purchases.create')}}">{{ trans('purchases/default.add_new_purchases_invoice') }}</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-12p ">{{ trans('purchases/default.invoice_number') }}</th>
                                    <th class="wd-12p ">{{ trans('purchases/default.supplier_name') }}</th>
                                    <th class="wd-10p ">{{ trans('purchases/default.date') }}</th>
                                    <th class="wd-12p ">{{ trans('purchases/default.added_to_store') }}</th>
                                    <th class="wd-12p ">{{ trans('purchases/default.product_count') }}</th>
                                    <th class="wd-14p ">{{ trans('purchases/default.invoice_total') }}</th>
                                    <th class="wd-12p ">{{ trans('purchases/default.pyment_status') }}</th>
                                    <th class="wd-12p ">{{ trans('purchases/default.paid_up') }}</th>
                                    <th class="wd-10p ">{{ trans('purchases/default.controle') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($purchases))
                                    @foreach ($purchases as $purchase)
                                        <tr 
                                        @if ($purchase->purchases_received)
                                            style="background-color : #94ecc242;"
                                        @endif>
                                            <td >{{$purchase->invoice_code}}</td>
                                            <td>{{$purchase->supplier->name}}</td>
                                            <td>{{ explode(' ' , $purchase->created_at)[1]}} {{explode(' ' , $purchase->created_at)[0]}}</td>
                                            <td>{{purchases_received($purchase->purchases_received)}}</td>
                                            <td>{{$purchase->details->count()}}</td>
                                            <td>{{$purchase->getInvoiceTotal()}}</td>
                                            <td>{{pyment_status($purchase->pyment_status)}}</td>
                                            <td>{{$purchase->totalPaidAmmount()}}</td>
                                            <td class="text-center">
                                                <div class="btn-group dropend">
                                                    <!-- <button type="button" class="dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                    </button> -->
                                                    <i class="bi bi-caret-left-square-fill dropdown-toggle-split control-btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                    <ul class="dropdown-menu my-drop-down">
                                                        <!-- Dropdown menu links -->
                                                        @if (!$purchase->purchases_received)
                                                            <li><a href="{{route('purchases.edit' , $purchase->id)}}"><i class="las la-pencil-alt"></i>{{ trans('purchases/default.edit_invoice') }}</a></li>
                                                        @endif
                                                        @if (!$purchase->pyment_status)
                                                            <li><a href="{{route('purchasesrecipets.create' , $purchase->id)}}"><i class="las la-hand-holding-usd"></i>{{ trans('purchases/default.pay_the_bill') }}</a></li>
                                                        @endif
                                                        <li><a href="{{route('purchasesrecipets.show' ,$purchase->id)}}"><i class="las la-newspaper"></i>{{ trans('purchases/default.paid_off_invoice') }}</a></li>
                                                        <li><a href="{{route('purchaseInvoiceDounload', $purchase->id)}}"><i class="las la-arrow-alt-circle-down"></i>{{ trans('purchases/default.download') }}</a></li>
                                                        <li><a target='_blanck'href="{{route('viewPurchaseInvoice', $purchase->id)}}"><i class="las la-eye"></i>{{ trans('purchases/default.see_the_invoice') }}</a></li>
                                                        <li><a href="{{route('sendPurchaseByMail', $purchase->id)}}"><i class="las la-paper-plane"></i>  {{ trans('purchases/default.send_invoice') }}</a></li>
                                                        @if (!$purchase->purchases_received)
                                                            <li><a href="{{route('purchasesReceived', $purchase->id)}}" id='swal-parameter'>
                                                                <i class="las la-truck"></i> {{ trans('purchases/default.goods_delivered') }}</a></li>
                                                            <li>
                                                                <form action="{{route('purchases.destroy' , $purchase->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"  onclick="return confirm('هل تريد حذف هذه الوثيقة')">
                                                                        <i class="las la-trash-alt"></i>{{ trans('purchases/default.delete_invoice') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
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
<!--Internal  Sweet-Alert js-->
<script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
<!-- Sweet-alert js  -->
<script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{URL::asset('assets/js/sweet-alert.js')}}"></script>
@endsection