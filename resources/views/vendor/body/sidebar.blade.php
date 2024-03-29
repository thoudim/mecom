@php
	$id = Auth::user()->id;
	$vendorId = App\Models\User::find($id);
	$status = $vendorId->status;
@endphp
<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{ asset('adminbackend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Vendor</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu">		
		<li>
			<a href="{{ route('vendor.dashboard') }}">
				<div class="parent-icon"><i class='bx bx-home-circle'></i>
				</div>
				<div class="menu-title">Dashboard</div>
			</a>
		</li>
		@if($status === 'active')
		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class='lni lni-fresh-juice'></i>
				</div>
				<div class="menu-title">Product Manage</div>
			</a>
			<ul>
				<li> <a href="{{ route('vendor.all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
				</li>
				<li> <a href="{{ route('vendor.add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
				</li>
			</ul>
		</li>
		
		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class="bx bx-cart"></i>
				</div>
				<div class="menu-title">Order Manage</div>
			</a>
			<ul>
				<li>
					<a href="{{ route('vendor.order') }}"><i class="bx bx-right-arrow-alt"></i>Vendor Order</a>
				</li>
				<li>
					<a href="{{ route('vendor.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Return Order</a>
				</li>
				<li>
					<a href="{{ route('vendor.complete.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Complete Return Order</a>
				</li>
			</ul>
		</li>
		<!-- <li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class="bx bx-category"></i>
				</div>
				<div class="menu-title">Application</div>
			</a>
			<ul>
				<li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>Email</a>
				</li>
				<li> <a href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Chat Box</a>
				</li>
				<li> <a href="app-file-manager.html"><i class="bx bx-right-arrow-alt"></i>File Manager</a>
				</li>
				<li> <a href="app-contact-list.html"><i class="bx bx-right-arrow-alt"></i>Contatcs</a>
				</li>
				<li> <a href="app-to-do.html"><i class="bx bx-right-arrow-alt"></i>Todo List</a>
				</li>
				<li> <a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i>Invoice</a>
				</li>
				<li> <a href="app-fullcalender.html"><i class="bx bx-right-arrow-alt"></i>Calendar</a>
				</li>
			</ul>
		</li>
		<li class="menu-label">UI Elements</li>
		<li>
			<a href="widgets.html">
				<div class="parent-icon"><i class='bx bx-cookie'></i>
				</div>
				<div class="menu-title">Widgets</div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class='bx bx-cart'></i>
				</div>
				<div class="menu-title">eCommerce</div>
			</a>
			<ul>
				<li> <a href="ecommerce-products.html"><i class="bx bx-right-arrow-alt"></i>Products</a>
				</li>
				<li> <a href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>Product Details</a>
				</li>
				<li> <a href="ecommerce-add-new-products.html"><i class="bx bx-right-arrow-alt"></i>Add New Products</a>
				</li>
				<li> <a href="ecommerce-orders.html"><i class="bx bx-right-arrow-alt"></i>Orders</a>
				</li>
			</ul>
		</li> -->
		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class='lni lni-indent-increase'></i>
				</div>
				<div class="menu-title">Review Manage</div>
			</a>
			<ul>
				<li> <a href="{{ route('vendor.all.review') }}"><i class="bx bx-right-arrow-alt"></i>All Review</a>
				</li>
			</ul>
		</li>
		@else

		@endif
		<li>
			<a href="https://themeforest.net/user/codervent" target="_blank">
				<div class="parent-icon"><i class="bx bx-support"></i>
				</div>
				<div class="menu-title">Support</div>
			</a>
		</li>

	</ul>
	<!--end navigation-->
</div>