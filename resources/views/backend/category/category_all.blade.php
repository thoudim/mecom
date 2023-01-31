@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	<!--breadcrumb-->
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
		<div class="breadcrumb-title pe-3">Tables</div>
		<div class="ps-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-0 p-0">
					<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Add Category</li>
				</ol>
			</nav>
		</div>
		<div class="ms-auto">
			<div class="btn-group">
				<a href="{{ route('add.category') }}" class="btn btn-primary">Add Category</a>
				<!-- <button type="button" class="btn btn-primary">Add Brand</button> -->
				<!-- <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
				</button> -->
				<!-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
					<a class="dropdown-item" href="javascript:;">Another action</a>
					<a class="dropdown-item" href="javascript:;">Something else here</a>
					<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
				</div> -->
			</div>
		</div>
	</div>
	<!--end breadcrumb-->
	<h6 class="mb-0 text-uppercase">List Categorys</h6>
	<hr/>
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="brandTable" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th>Sl</th>
							<th>Category Name</th>
							<th>Category Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categorys as $key => $item)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $item->category_name }}</td>
							<td> <img src="{{ (!empty($item->category_image)) ? url($item->category_image) : url('upload/no_image.jpg')}}" style="width: 70px;"></td>
							<td>
								<a href="{{ route('edit.category', $item->id) }}" class="btn btn-info">Edit</a>
								<a href="{{ route('delete.category', $item->id) }}" id="delete" class="btn btn-danger">Delete</a>
							</td>
						</tr>	
						@endforeach					
					</tbody>
					<tfoot>
						<tr>
							<th>Sl</th>
							<th>Category Name</th>
							<th>Category Image</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>	
</div>

@endsection