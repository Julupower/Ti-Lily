@extends('layouts.admin')

@section('title')Administrator Post @endsection

@section('content')
<div class="content">
     <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Administrator Post
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Created at</th>
                            <th>Updated At</th>
                            <th>Comments</th>
                            <th>Edit Post</th>
                            <th>Delete Post</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td class="text-nowrap"><a href="{{ route('singlePost', $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td>
                                    <a href="{{ route('adminEditPost', $post->id) }}"><button type="button" class="btn btn-success">Edit Post&nbsp;&nbsp;<i class="icon icon-pencil"></i></button></a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-post-model-{{ $post->id }}">&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($posts as $post)
<!-- Modal -->
<div class="modal fade" id="delete-post-model-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete Post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="admin-post-{{ $post->id }}">You are about to delete post "<strong>{{ $post->title }}.</strong>"</h4>
      </div>
      <div class="modal-body text-danger">
          <strong>Do you want this?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <form method="POST" action="{{ route('adminDeletePost', $post->id) }}" id="admin-delete-post-{{ $post->id }}">
        @csrf
            <button type="button" class="btn btn-primary" onclick="document.getElementById('admin-delete-post-{{ $post->id }}').submit();">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection