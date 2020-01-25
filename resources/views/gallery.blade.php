@extends('layouts.master')
@section('content')
<br><br>
<!-- Page Content -->
    <div class="container" >
        <br>
        <div class="col-md-12"  align="center">
            <h1 class="main-text">Picture Gallery</h1>
        </div>
        <br>
        <div class="row col-md-12" align="center">
            @foreach($gallery as $img)
            <div class="col-lg-4 col-md-4 col-xs-4 rounded-corners">
                <img class="gallery-img" src="{{ asset($img->image_filepath) }}" title="{{ $img->title }}" 
                     alt="{!! $img->description !!}" onclick="window.open(this.src)" />
            </div>
            @endforeach
        </div>
    <!-- /.container -->
    </div>
@endsection
