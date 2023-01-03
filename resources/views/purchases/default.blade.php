@extends('layouts.master')

@section('title')
المشتريات
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
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">المشتريات !</h2>
        </div>
    </div>
</div>
{{-- <div class="row row-sm mt-3">

    <div class="col-lg-12">
        <div class="card mg-b-20">
            <div class="card-body d-flex p-3">
                <h5 class="main-content-label mb-0 mg-t-8">المبيعات</h5>
                <div class="mr-auto"><a class="d-block tx-20" data-placement="top" data-toggle="tooltip" title="فاتورة مبيعات جديدة" href="{{route('seles.create')}}"><i class="si si-plus text-muted"></i></a></div>
            </div>
        </div>
    </div>
</div> --}}
<!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-end">
                        <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
                            <button class="btn btn-secondary btn-block">
                                <a class="text-decoration-none text-light" href="{{route('purchases.create')}}">فاتورة مشتريات جديدة</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-12p ">رقم الفاتورة</th>
                                    <th class="wd-12p ">المورد</th>
                                    <th class="wd-10p ">التاريخ</th>
                                    <th class="wd-12p ">أضيفة للمخزن</th>
                                    <th class="wd-12p ">عدد الأصناف</th>
                                    <th class="wd-14p ">إجمالي الفاتورة</th>
                                    <th class="wd-12p ">حالة الدفع</th>
                                    <th class="wd-12p ">المدفوع</th>
                                    <th class="wd-10p ">التحكم</th>
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
                                                            <li><a href="{{route('purchases.edit' , $purchase->id)}}"><i class="bi bi-eye-fill"></i>تعديل الوثيقة</a></li>
                                                        @endif
                                                        @if (!$purchase->pyment_status)
                                                            <li><a href="{{route('purchasesrecipets.create' , $purchase->id)}}"><i class="bi bi-eye-fill"></i>أداء الفاتورة</a></li>
                                                        @endif
                                                        <li><a href="{{route('purchasesrecipets.show' ,$purchase->id)}}"><i class="bi bi-eye-fill"></i>المدفوع من الفاتورة</a></li>
                                                        <li><a href="{{route('purchaseInvoiceDounload', $purchase->id)}}"><i class="bi bi-eye-fill"></i>تحميل الوصل</a></li>
                                                        <li><a target='_blanck'href="{{route('viewPurchaseInvoice', $purchase->id)}}"><i class="bi bi-eye-fill"></i>رأية الوصل</a></li>
                                                        <li><a href="{{route('sendPurchaseByMail', $purchase->id)}}"><i class="bi bi-eye-fill"></i> ارسال الفاتورة</a></li>
                                                        @if (!$purchase->purchases_received)
                                                            <li><a href="{{route('purchasesReceived', $purchase->id)}}" id='swal-parameter'>
                                                                <i class="bi bi-eye-fill"  ></i> تم تسليم البضاعة</a></li>
                                                            <li>
                                                                <form action="{{route('purchases.destroy' , $purchase->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"  onclick="return confirm('هل تريد حذف هذه الوثيقة')">
                                                                        <i class="bi bi-eye-fill"></i>حذف الفاتورة
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>

                                            {{-- <div class="col-sm-6 col-md-6 col-lg-3">
                                                <div class="card custom-card text-center">
                                                    <div class="card-body">
                                                        <div>
                                                            <h6 class="card-title mb-1">Warning alert</h6>
                                                            <p class="text-muted card-sub-title">A warning message</p>
                                                        </div>
                                                        <div class="btn ripple btn-warning-gradient" id='swal-warning'>
                                                            Click me !
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

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