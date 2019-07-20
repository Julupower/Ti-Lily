@extends('layouts.admin')

@section('title')Administrator Users @endsection

@section('content')
<div class="content">
     <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Administrator Users
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Post</th>
                            <th>Comments</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit User</th>
                            <th>Delete User</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="text-nowrap">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->posts->count() }}</td>
                                <td>{{ $user->comments->count() }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('adminEditUser', $user->id) }}">
                                        <button class="btn btn-success">Edit User&nbsp;&nbsp;<i class="icon icon-pencil"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-user-model-{{ $user->id }}">&nbsp;&nbsp; X &nbsp;&nbsp;</button>
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
@foreach($users as $user)
<!-- Modal -->
<div class="modal fade" id="delete-user-model-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete User">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="admin-user-{{ $user->id }}">You are about to delete user "<strong>{{ $user->name }}</strong>"</h4>
      </div>
      <div class="modal-body text-danger">
          <strong>Do you want this?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <form method="POST" action="{{ route('adminDeleteUser', $user->id) }}" id="admin-delete-user-{{ $user->id }}">
        @csrf
            <button type="button" class="btn btn-primary" onclick="document.getElementById('admin-delete-user-{{ $user->id }}').submit();">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
