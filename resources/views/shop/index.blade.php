@extends('layouts.master')
@section('title')Ti & Lilly Services @endsection

@section('content')
<!-- Page Header -->
    <header class="masthead" style="background-image: url('{{asset('assets/img/restaurant.jpg')}}')">
      <div class="overlay"></div>
      <div class="container ">
        <div class="row">
          <div class="col-lg-12 col-md-12 mx-auto">
            <div class="site-heading main-text">
              <h1>Tia&Lily Events Hiring Services</h1>
             <span class="subheading">Events Services for Enfield and North London</span>
            </div>
          </div>
        </div>
      </div>
    </header>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($products as $product)
            <div class="post-preview">
                <div class="row">
                    <div class="col-md-3 rounded-corners ">
                    <a href="{{route('shopSingleProduct', $product->id)}}">
                        <img src="{{ asset($product->thumbnail) }}" width="100" alt="{{ $product->title }}">
                    </a>
                    </div>
                    <div class="col-md-7">
                        <a href="{{route('shopSingleProduct', $product->id)}}">
                        <h2 class="post-title main-text">
                            {{$product->title}}
                        </h2>
                        </a>
                        <p class="post-meta">
                            <a href="{{route('shopSingleProduct', $product->id)}}">
                                Price:&nbsp;<i class="fa fa-gbp"></i>&nbsp;{{ $product->price }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
  </div>
</div>

@endsection
