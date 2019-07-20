@extends('layouts.master')
@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{asset('assets/img/bridal.jpg')}}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading main-text">
              <h1>{{$posts->title}}</h1> 
              <span class="meta">{{$posts->user['name']}}
                {{date_format($posts->created_at, 'F d, Y')}}</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container main-text">
        <div class="row">
        <!-- Post Content -->
          <div class="col-lg-8 col-md-10 mx-auto">
            {!! nl2br($posts->content) !!}
          </div>
        </div>
      </div>
    </article>
    <div class="container">
        <div class="comments main-text">
            <hr>
            <h3>Comments</h3>
            <hr>
            @foreach($posts->comments as $comment)
                <p>{!! $comment->content !!}</p>
                <p><small>By <strong>{{$comment->user->name}}</strong> <br>on {{date_format($comment->created_at, 'F d, Y')}}</small></p>
                <hr>
            @endforeach
            <!-- check id the user has permission to create a comment -->
            @if(Auth::check())
                <form method="POST" action="{{ route('userNewComment') }}" class="">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control summernote" name="new-comment" id="" rows="5" placeholder="Type Comment Here..."></textarea>
                        <input type="hidden" name="new-comment-post" value="{{ $posts->id }}">
                    </div>
                    <div class="col-md-12" align='center'>
                        <button type="submit" class="btn btn-primary">Create Comment&nbsp;<i class="icon icon-arrow-up-circle"></i></button>
                    </div>
                </form>
            @endif
        </div>   
    </div>   
@endsection