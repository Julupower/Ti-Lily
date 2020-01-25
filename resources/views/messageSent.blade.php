@extends('layouts.master')

@section('title')Message Sent @endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{asset('assets/img/wedding-6.jpg')}}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading main-text">
                <h1>Thank you for sending the message&nbsp;<i class="icon icon-emotsmile"></i></h1>
              <span class="subheading">I will try and contact you as soon as possible </span>
            </div>
          </div>
        </div>
      </div>
    </header>
@endsection
