@extends('layouts.master')

@section('title')Display Product-- {{ $product->title }} @endsection

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset('assets/img/wedding-5.jpg')}}')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 mx-auto">
        <div class="site-heading main-text">
          <h1>{{ $product->title }}</h1>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row main-text">
        <div class="col-md-3 rounded-corners">
            <img src="{{ asset($product->thumbnail) }}" width="100" alt="{{ $product->title }}">
        </div>
        <div class="col-md-9">
            {{ $product->description }}
        </div>
    </div>
    <br>
    <div class="row" align='center'>
        <div class="col-md-12 ">
            <a  href="{{ route('shopOrderProduct', $product->id) }}" class="btn btn-primary rounded-corners">Checkout&nbsp;&nbsp;<i class="fa fa-paypal" style="font-size:25px"></i></a>
        </div>
    </div>
</div>
@endsection