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
					<li class="breadcrumb-item active" aria-current="page">All Inactive Vendor</li>
				</ol>
			</nav>
		</div>
		<div class="ms-auto">
			<div class="btn-group">
				<!-- <a href="{{ route('add.subcategory') }}" class="btn btn-primary">Inactive Vendor</a> -->
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
							<th>Shop Name</th>
							<th>Vendor Username</th>
							<th>Join Date</th>
							<th>Vendor Email</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($inActiveVendor as $key => $item)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->username }}</td>
							<td>{{ $item->vendor_join }}</td>
							<td>{{ $item->email }}</td>
							<td><div class="badge rounded-pill bg-light-danger text-danger w-100">{{ $item->status }}</div></td>
							<!-- <td><span class="badge rounded-pill bg-secondary">{{ $item->status }}</span></td> -->
							
							<td>
								<a  href="{{ route('actived.vendor', $item->id) }}" id="activated" class="btn btn-success">Activated</a>
								<a href="{{ route('inactive.vendor.details', $item->id) }}" class="btn btn-info">Vendor Details</a>
							</td>
						</tr>	
						@endforeach					
					</tbody>
					<tfoot>
						<tr>
							<th>Sl</th>
							<th>Shop Name</th>
							<th>Vendor Username</th>
							<th>Join Date</th>
							<th>Vendor Email</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>	
</div>

@endsection