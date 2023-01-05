@extends('layouts.master')
@section('css')
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الإعدادات</h4>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<form action="{{route('updatecompanyinfo')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card mg-b-20">
                                <div class="card-header">
                                    <div class="d-flex justify-content-center">
                                        <div class="text-center">
                                            <h3 class="">معلومات الشركة</h3>
                                        </div>
                                    </div>
                                </div>
                                <hr class="m-0">
                                <div class="card-body">
                                    <div class="pl-0">
                                        <div class="main-profile-overview">
                                            <div role="form">
                                                <div class="form-group">
                                                    <label for="FullName">شعار الشركة</label>
                                                    <input type="file" class="dropify" name="image" data-height="150" />
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="FullName">عنوان الشركة</label>
                                                    <input type="text" value="{{company()->address}}" name="c_address" id="FullName" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Email">البريد الإلكتروني للشركة</label>
                                                    <input type="email" value="{{company()->email}}" id="Email" name="c_email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone_num">رقم الهاتف</label>
                                                    <input type="tel" placeholder="Company Phone Number" value="{{company()->phone}}" id="phone_num" name="c_phone" class="form-control">
                                                </div>
                                        </div>
                                        </div><!-- main-profile-overview -->
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn d-block col-5 mb-2 btn-primary" type="submit">حفظ التغييرات</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- <div class=" d-flex justify-content-end">
                        <div>
                            <button class="btn d-block btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                        </div>
                    </div> --}}
				</form>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
{{-- bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection