@extends('layouts.admin')

@section('title')Author Post @endsection

@section('content')
<div class="content">
     <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Author Post
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
                            <th>Edit Comment</th>
                            <th>Delete Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Auth::user()->posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td class="text-nowrap"><a href="{{ route('singlePost', $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td>
                                    <a href="{{ route('editPost', $post->id) }}"><button type="button" class="btn btn-success">&nbsp;Edit Comment &nbsp;</button></a>
                                </td>
                                <form method="POST" action="{{ route('deletePost', $post->id) }}" id="delete-post-{{ $post->id }}">
                                @csrf
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-post-{{ $post->id }}').submit();">&nbsp; Delete Post &nbsp;</button>
                                    </td>
                                </form>
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