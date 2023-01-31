@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Admin Change Password</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Change Password</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">							
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<form method="POST" action="{{ route('admin.update.password') }}">
											@csrf
											
											@if(session('status'))
											<div class="alert alert-success" role="alert">
												{{session('status')}}
											</div>
											@elseif(session('error'))
											<div class="alert alert-danger" role="alert">
												{{session('error')}}
											</div>
											@endif
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Old Password</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<!-- <input type="password" name="old_password" id="current_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password"/> -->
													<div class="input-group"> 
														<span class="input-group-text bg-transparent"><i class="bx bxs-lock"></i></span>
														<input type="password" name="old_password" class="form-control border-start-0 @error('old_password') is-invalid @enderror" id="current_password" placeholder="Old Password">
													</div>
													@error('old_password')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">New Password</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<!-- <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password"/> -->
													<div class="input-group"> 
														<span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
														<input type="password" name="new_password" class="form-control border-start-0 @error('old_password') is-invalid @enderror" id="new_password" placeholder="New Password">
													</div>
													@error('new_password')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Confirm New Password</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<!-- <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Confirm New Password"/> -->
													<div class="input-group"> 
														<span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
														<input type="password" name="new_password_confirmation" class="form-control border-start-0" id="new_password_confirmation" placeholder="Confirm Password">
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-3"></div>
												<div class="col-sm-9 text-secondary">
													<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
												</div>
											</div>
										</form>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>
@endsection
