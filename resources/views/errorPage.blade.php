@extends('layouts.master')

@section('title')Ooops Error @endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{asset('assets/img/error.jpg')}}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
                <h1>An error has occured</h1>
              <span class="subheading">Sorry there seems to be some technical problems, the message was not sent. We will try to fix this as soon as possible.</span>
            </div>
          </div>
        </div>
      </div>
    </header>
@endsection
