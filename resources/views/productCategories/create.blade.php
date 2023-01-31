@extends('layouts.master')

@section('title')
    أصناف المنتجات
@stop


@section('content')

<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">إنشاء صنف جديد</h2>
        </div>
    </div>
</div>
<!-- row opened -->
				{{-- <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body"> --}}
                            <!-- row -->
				<form action='{{route('productCategories.store')}}' method='POST' class="row">
                    @csrf
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								{{-- <div class="main-content-label mg-b-5">
									Horizontal Alignment
								</div>
								<p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p> --}}
								<div class="pd-30 pd-sm-40 bg-gray-200">
									<div class="row row-xs">
										<div class="col-md-10">
                                            <div>
                                                <input 
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="إسم الصنف" 
                                                    name="name" 
                                                    type="text"
                                                    value="{{ old('title') }}"
                                                    />
                                            </div>
                                            @error('name')
                                                <div class="alert alert-danger mt-2">يجب تحديد إسم الصنف </div>
                                            @enderror
										</div>
										{{-- <div class="col-md-5 mg-t-10 mg-md-t-0">
											<input class="form-control" placeholder="Enter your password" type="password">
										</div> --}}
										<div class="col-md mt-4 mt-xl-0">
											<button class="btn btn-main-primary btn-block">حفظ</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- /row -->
                            {{-- </div>
                        </div>
                    </div>
                </div> --}}
					<!--/div-->					  
@endsection


