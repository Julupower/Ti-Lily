@extends('layouts.admin')

@section('title')Administrator Comments @endsection

@section('content')
<div class="content">
     <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Administrator Comments
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post</th>
                            <th>Content</th>
                            <th>Created At</th>
                            <th>Delete Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td class="text-nowrap"><a href="{{ route('singlePost', $comment->id) }}">{{ $comment->post['title'] }}</a></td>
                                <td>{{ $comment->content }}</td>
                                <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-comment-model-{{ $comment->id }}">&nbsp;&nbsp; X &nbsp;&nbsp;</button>
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
@foreach($comments as $comment)
<!-- Modal -->
<div class="modal fade" id="delete-comment-model-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete Comment">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="admin-comment-{{ $comment->id }}">You are about to delete this comment for post "<strong>{{ $comment->post['title'] }}</strong>"</h4>
      </div>
      <div class="modal-body text-danger">
          <strong>Do you want this?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <form method="POST" action="{{ route('adminDeleteComment', $comment->id) }}" id="admin-delete-comment-{{ $comment->id }}">
        @csrf
            <button type="button" class="btn btn-primary" onclick="document.getElementById('admin-delete-comment-{{ $comment->id }}').submit();">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
