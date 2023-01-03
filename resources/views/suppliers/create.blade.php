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
    <form action='{{route('suppliers.store')}}' method='POST' class="row">
        @csrf
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">إسم المورد : <span class="tx-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="أدخل إسم المورد" value="{{old('name')}}"   required="" type="text">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">supplier name is importent</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">البريد الإلكروني : <span class="tx-danger">*</span></label>
                                <input class="form-control" name="email" placeholder="أدخل البريد الإلكروني" required="" value="{{old('email')}}"  type="email">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">email is importent</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-group mg-b-0">
                                <label class="form-label">رقم الهاتف : <span class="tx-danger">*</span></label>
                                <input class="form-control" name="phone_number" placeholder="أدخل رقم الهاتف " required=""  type="tel" value="{{old('phone_number')}}" step='0.01'>
                            </div>
                            @error('phone_number')
                                <div class="alert alert-danger">phone number is importent</div>
                            @enderror
                        </div>
                        <div class="col-6 mg-b-0">
                            <div class="form-group">
                                <label class="form-label">العنوان : <span class="tx-danger">*</span></label>
                                <input class="form-control" name="address" placeholder="أدخل العنوان" required=""  type="text" value='{{old('address')}}' step='0.01'>
                            </div>
                            @error('sell_price')
                                <div class="alert alert-danger">sell price is importent</div>
                            @enderror
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

