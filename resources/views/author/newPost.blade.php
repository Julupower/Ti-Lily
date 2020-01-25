@extends('layouts.admin')

@section('title')New Post @endsection
@section('links')
<!-- summernote WYSIWYG editor -->
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/summernote/summernote-lite.css') }} "/>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4><strong>New Post</strong></h4>
                    </div>
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('createNewPost') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">Title</label>
                                        <input name="title" id="normal-input" class="form-control" placeholder="Post Title">
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">Content</label>
                                        <textarea name="content" class="form-control summernote" id="post-content" cols="30" rows="10" placeholder="Post Content..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" align='center'>
                                <button type="submit" class="btn btn-primary">Create Post</button>
                            </div>  
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- summernote WYSIWYG editor -->
<script src="{{ asset('/assets/summernote/summernote-lite.js') }}"></script>
<script type="text/javascript">
    //summernote script
      $('.summernote').summernote({
      tabsize: 2,
      height: 200
    });
</script>
@endsection