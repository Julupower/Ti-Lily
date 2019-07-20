@extends('layouts.master')
@section('content')
    <!-- Page Header -->
<!--    <header class="masthead" style="background-image: url('{{asset('assets/img/home-bg.jpg')}}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 mx-auto">
            <div class="site-heading">
              <h1>Tia & Lily Wedding Planning</h1>
             <span class="subheading">Wedding Planning Services for Enfield and North London</span>
            </div>
          </div>
        </div>
      </div>
    </header>-->

<br><br>
<!-- Page Content -->
    <div class="container" >
        <div align="center">
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="{{ asset('/assets/img/wedding-5_slide.jpg') }}" alt="First slide">
              </div>
              <div class="carousel-item ">
                <img class="d-block img-fluid" src="{{ asset('/assets/img/wedding_slide.jpg') }}" alt="Second slide">
              </div>
              <div class="carousel-item ">
                <img class="d-block img-fluid" src="{{ asset('/assets/img/wedding-2_slide.jpg') }}" alt="Third slide">
              </div>
              <div class="carousel-item ">
                <img class="d-block img-fluid" src="{{ asset('/assets/img/wedding-3_slide.jpg') }}" alt="Fourth slide">
              </div>
                <div class="carousel-item ">
                <img class="d-block img-fluid" src="{{ asset('/assets/img/wedding-4_slide.jpg') }}" alt="Fifth slide">
              </div>
<!--                <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
              </div>-->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
            
            <div id="main-header" align="center">
                <h1 class="my-4 text-center text-lg-left main-text">Welcome to Ti & Lily Wedding Planning</h1>
            </div>
        

        <div class="row text-center text-lg-left rounded-corners" align="center">

          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/bloom.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/sunset.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/bride.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/bride-clouds.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/couple.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/couple-mixed.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/flowers.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/wedding-bride.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/heart.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/people.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/wedding.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
              <img class="img-fluid img-thumbnail" src="{{ asset('/assets/img/wedding-2.jpg') }}" alt="">
            </a>
          </div>
        </div>
        </div>
        

      <div class="row ">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($posts as $post)
                <div class="post-preview main-text">
                    <a href="{{route('singlePost', $post->id)}}">
                        <h2 class="post-title">
                            {{$post->title}}
                        </h2>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#"><strong>{{$post->user['name']}}</strong></a> 
                        On:
                        {{ date_format($post->created_at, "F d, Y") }}
                        &nbsp&nbsp&nbsp&nbsp
                        <i class="fa fa-comment" aria-hidden="true"></i>&nbsp&nbsp{{$post->comments->count()}}
                    </p>
                </div>
                
                <hr>
            @endforeach
            
            {{ $posts->links() }}
        </div>
      </div>
    <!-- /.container -->
    </div>
   @endsection
