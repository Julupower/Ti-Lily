@extends('layouts.admin')
   
@section('title')Administrator Edit User- {{ $user->name }} @endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4><strong>Edit User- {{ $user->name }}</strong></h4>
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
                    <form method="POST" action="{{ route('adminPostEditUser', $user->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">Username</label>
                                        <input name="name" id="edit-normal-input" class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">email</label>
                                        <input name="email" type="email" id="edit-normal-input-2" class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">User Permissions</label>
                                        <input name="author" type="checkbox" class="form-control" value=1 {{ $user->author == true ? 'checked' : ''  }}>Author
                                        <br>
                                        <input name="admin" type="checkbox" class="form-control" value=1 {{ $user->admin == true ? 'checked' : ''  }}>Administrator
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6" align='center'>
                                <button type="submit" class="btn btn-primary">Update User &nbsp;<i class="icon icon-arrow-up-circle"></i></button>
                            </div>  
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection