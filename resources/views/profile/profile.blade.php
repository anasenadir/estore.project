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
				<form action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-center">
                                        <div class="text-center">
                                            {{-- <p   >Admin Info</p> --}}
                                            <h3 class="">معلومات مدير التطبيق</h3>
                                        </div>
                                    </div>
                                </div>
                                <hr class="m-0">
                                <div class="card-body" >
                                    <div class="form-group">
                                        <label for="FullName">الإسم</label>
                                        <input type="text" value="{{auth()->user()->name}}" id="FullName" name="admin_name" class="form-control">
                                    </div>
                                    @error('title')
                                        <div class="alert alert-danger">الإسم يجب أن يحتوي على قيمة نصية لا تتجاوز ثلاثين حرفا</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="Email">البريد الإلكتروني</label>
                                        <input type="email" disabled value="{{auth()->user()->email}}" id="Email" name="admin_email" class="form-control">
                                    </div>
                                    <hr class="mt-4">
                                    <div class="mb-3 p-1 bg-gray-100 text-center border-top border-2">
                                        <h5 class="tx-medium">تغيير كلمة السر</h5>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="Password">كلمة المرور</label>
                                        <input type="password" placeholder="Your Password" id="Password" name="password" class="form-control">
                                    </div>
                                    @if (Session::has('password'))                                    
                                        <div class="alert alert-danger">{{Session::get('password')}}</div>
                                    @endif


                                    <div class="form-group">
                                        <label for="Password">كلمة مرور جديدة</label>
                                        <input type="password" placeholder="Your New Password" id="Password" name="new_password" class="form-control">
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="RePassword">تأكيد كلمة المرور الجديدة</label>
                                        <input type="password" placeholder="Confirme Your New Password" id="RePassword" name="c_new_password" class="form-control">
                                    </div>
                                    @if (Session::has('c_new_password'))                                    
                                        <div class="alert alert-danger">{{Session::get('c_new_password')}}</div>
                                    @endif
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