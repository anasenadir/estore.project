@extends('layouts.master')

@section('title')
{{ trans('seles/default.page_title') }}
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
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ trans('seles/default.seles_title') }}</h2>
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
                                <a class="text-decoration-none text-light" href="{{route('seles.create')}}">{{ trans('seles/default.add_new_seles_invoice') }}</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p ">{{ trans('seles/default.invoice_number') }}</th>
                                    <th class="wd-13p ">{{ trans('seles/default.client_name') }}</th>
                                    <th class="wd-15p ">{{ trans('seles/default.date') }}</th>
                                    <th class="wd-12p ">{{ trans('seles/default.product_count') }}</th>
                                    <th class="wd-14p ">{{ trans('seles/default.invoice_total') }}</th>
                                    <th class="wd-12p ">{{ trans('seles/default.pyment_status') }}</th>
                                    <th class="wd-10p ">{{ trans('seles/default.paid_up') }}</th>
                                    <th class="wd-10p ">{{ trans('seles/default.controle') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($seles))
                                    @foreach ($seles as $sele)
                                        <tr 
                                        @if ($sele->is_client_received)
                                            style="background-color : #94ecc242;"
                                        @endif>
                                            <td >{{$sele->invoice_code}}</td>
                                            <td>{{$sele->client->name}}</td>
                                            <td>{{ explode(' ' , $sele->created_at)[1]}} {{explode(' ' , $sele->created_at)[0]}}</td>
                                            <td>{{$sele->details->count()}}</td>
                                            <td>{{$sele->getInvoiceTotal()}}</td>
                                            <td>{{pyment_status($sele->pyment_status)}}</td>
                                            <td>{{$sele->totalPaidAmmount()}}</td>
                                            <td class="text-center">
                                                <div class="btn-group dropend">
                                                    <!-- <button type="button" class="dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                    </button> -->
                                                    <i class="bi bi-caret-left-square-fill dropdown-toggle-split control-btn" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                    <ul class="dropdown-menu my-drop-down">
                                                        <!-- Dropdown menu links -->
                                                        @if (!$sele->is_client_received)
                                                            <li><a href="{{route('seles.edit' , $sele->id)}}"><i class="las la-pencil-alt"></i>{{ trans('seles/create.edit_invoice') }}</a></li>
                                                        @endif
                                                        @if (!$sele->pyment_status)
                                                            <li>
                                                                <a href="{{route('selesrecipets.create' , $sele->id)}}">
                                                                <i class="las la-hand-holding-usd"></i>
                                                                {{ trans('seles/create.pay_the_bill') }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li><a href="{{route('selesrecipets.index', $sele->id)}}"><i class="las la-newspaper"></i>{{ trans('seles/create.paid_off_invoice') }}</a></li>
                                                        <li><a href="{{route('seleInvoiceDounload', $sele->id)}}"><i class="las la-arrow-alt-circle-down"></i>{{ trans('seles/create.download') }}</a></li>
                                                        <li><a target='_blanck'href="{{route('viewSeleInvoice', $sele->id)}}"><i class="las la-eye"></i>{{ trans('seles/create.see_the_invoice') }}</a></li>
                                                        <li><a href="{{route('sendSeleByMail', $sele->id)}}"><i class="las la-paper-plane"></i> {{ trans('seles/create.send_invoice') }}</a></li>
                                                        @if (!$sele->is_client_received)
                                                            <li><a href="{{route('invoiceTooked', $sele->id)}}"><i class="las la-truck"></i> {{ trans('seles/create.goods_delivered') }}</a></li>
                                                            <li>
                                                                <form action="{{route('seles.destroy' , $sele->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"  onclick="return confirm('هل تريد حذف هذه الفاتورة')">
                                                                        <i class="las la-trash-alt"></i>{{ trans('seles/create.delete_invoice') }}
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

@endsection