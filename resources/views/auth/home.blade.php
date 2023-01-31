@extends('frontend.master_dashboard') 
@section('main')     


@include('frontend.home.home_slider')
<!--End hero slider-->

@include('frontend.home.home_features_category')
<!--End category slider-->

@include('frontend.home.home_banner')
<!--End banners-->

@include('frontend.home.home_new_product')
<!--Products Tabs-->

@include('frontend.home.home_features_product')
<!--End Best Sales-->

<!-- TV Category -->
@include('frontend.home.home_tv_category')
<!--End TV Category -->

<!-- Tshirt Category -->
@include('frontend.home.home_tshirt_category')
<!--End Tshirt Category -->

<!-- Computer Category -->
@include('frontend.home.home_computer_category')
<!--End Computer Category -->

@include('frontend.home.home_section_padding')
<!--End 4 columns-->

<!--Vendor List -->
@include('frontend.home.home_vendor_list')
<!--End Vendor List -->
@endsection