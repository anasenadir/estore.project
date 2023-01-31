@extends('layouts.master')

@section('title')
{{ trans('expensesCategories/create.page_title') }}
@stop
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ trans('expensesCategories/create.E_category_title') }}</h2>
        </div>
    </div>
</div>
<!-- row opened -->
    <form action='{{route('expensesCategories.store')}}' method='POST' class="row">
        @csrf
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mg-b-0">
                                    <label class="form-label">{{ trans('expensesCategories/create.E_category_name') }}: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="E_category_name" placeholder="{{ trans('expensesCategories/create.E_category_name') }}" value="{{old('E_category_name')}}"  maxlength='40' required="" type="text">
                                </div>
                                @error('E_category_name')
                                    <div class="alert alert-danger">You must choose the name of the Expense Category</div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mg-b-0">
                                    <label class="form-label">{{ trans('expensesCategories/create.E_category_name') }}: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="E_category_minimum_amount" placeholder="{{ trans('expensesCategories/create.E_category_minimum_amount') }}" value="{{old('E_category_minimum_amount')}}"    min='0' required step="0.1" type="number">
                                </div>
                                @error('E_category_minimum_amount')
                                    <div class="alert alert-danger">You must declare a Minimum Amount</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end"><button class="col-2 btn btn-main-primary pd-x-20 mg-t-10" type="submit">{{ trans('seles/create.save_btn') }}</button></div>
                    </div>
            </div>
        </div>
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

<script src="{{URL::asset('assets/js/my-table-configuration.js')}}"></script>
@endsection