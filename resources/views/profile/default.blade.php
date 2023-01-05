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
                        <div class="col-lg-5">
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
                                                    <input type="text" value="{{auth()->user()->name}}" name="company_name" id="FullName" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Email">البريد الإلكتروني للشركة</label>
                                                    <input type="email" value="{{auth()->user()->email}}" id="Email" name="company_email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone_num">رقم الهاتف</label>
                                                    <input type="tel" placeholder="Company Phone Number" id="phone_num" name="company_phone" class="form-control">
                                                </div>
                                        </div>
                                        </div><!-- main-profile-overview -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
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
                                    <div class="form-group">
                                        <label for="Password">كلمة مرور جديدة</label>
                                        <input type="password" placeholder="Your New Password" id="Password" name="new_password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="RePassword">تأكيد كلمة المرور الجديدة</label>
                                        <input type="password" placeholder="Confirme Your New Password" id="RePassword" name="c_new_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn d-block col-12 mb-2 btn-primary" type="submit">حفظ التغييرات</button>
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
@endsection