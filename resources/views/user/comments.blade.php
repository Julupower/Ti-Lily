@extends('layouts.admin')

@section('title')User Comments @endsection

@section('content')
<div class="content">
     <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                User Comments
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
                            <th align='center'>Delete Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Auth::user()->comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td class="text-nowrap"><a href="{{ route('singlePost', $comment->id) }}">{{ $comment->post['title'] }}</a></td>
                                <td>{{ $comment->content }}</td>
                                <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                <td align='center'>
                                    <form method="POST" action="{{ route('deleteComment', $comment->id) }}" id="delete-comment-{{ $comment->id }}">
                                        @csrf
                                        <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-comment-{{ $comment->id }}').submit();">&nbsp;&nbsp; X &nbsp;&nbsp;</button>
                                    </form>
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
@endsection
