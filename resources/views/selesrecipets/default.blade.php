@extends('layouts.master')

@section('title')
المبيعات
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
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">المبيعات !</h2>
        </div>
    </div>
</div>
<!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p ">رقم السند</th>
                                    <th class="wd-13p ">رقم الفاتورة</th>
                                    <th class="wd-15p ">التاريخ</th>
                                    <th class="wd-12p ">قيمة السند</th>
                                    <th class="wd-14p ">طريقة الدفع</th>
                                    <th class="wd-12p ">رقم الشيك او التحويل</th>
                                    <th class="wd-10p ">التحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($paidDetails))
                                    @foreach ($paidDetails as $paidDetail)
                                        <tr>
                                            <td >{{$paidDetail->reciept_code}}</td>
                                            <td>{{$paidDetail->sele->invoice_code}}</td>
                                            <td>{{ explode(' ' , $paidDetail->created_at)[1]}} {{explode(' ' , $paidDetail->created_at)[0]}}</td>
                                            <td>{{$paidDetail->pyment_amount}}</td>
                                            <td>{{pyment_type($paidDetail->pyment_type)}}</td>
                                            <td>{{$paidDetail->check_number}}</td>
                                            <td class="text-center">
                                                @if (!$sele->is_client_received)
                                                    
                                                <div class="btn-group dropend">
                                                    <i class="bi bi-caret-left-square-fill dropdown-toggle-split control-btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                    <ul class="dropdown-menu my-drop-down">
                                                        <!-- Dropdown menu links -->
                                                        <li><a href="{{route('selesrecipets.edit' , $paidDetail->id)}}"><i class="bi bi-eye-fill"></i>تعديل الفاتورة</a></li>
                                                        <li>
                                                            <form action="{{route('selesrecipets.destroy' , $paidDetail->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"  onclick="return confirm('هل تريد حذف هذه الفاتورة')">
                                                                    <i class="bi bi-eye-fill"></i>حذف الفاتورة
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @else
                                                <div class="btn-group dropend">
                                                    <i class="bi bi-caret-left-square-fill dropdown-toggle-split control-btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                    <ul class="dropdown-menu my-drop-down">
                                                        <!-- Dropdown menu links -->
                                                        {{-- <li><a href="{{route('selesrecipets.edit' , $paidDetail->id)}}"><i class="bi bi-eye-fill"></i>تعديل الفاتورة</a></li> --}}
                                                        <li class="p-2">لا يمكنك التعديل على هدا السجل لان الزبون قد إستلم بضاعته</li>
                                                    </ul>
                                                </div>
                                                @endif

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