@extends('layouts.admin')
        
@section('title') Administrator Dashboard @endsection

@section('content')
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">{{ \App\Post::all()->count() }}</span>
                                    <span class="font-weight-light">Post</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-paper-clip"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">{{ \App\Comment::all()->count() }}</span>
                                    <span class="font-weight-light">Comments</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-bubbles"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">{{ \App\user::all()->count() }}</span>
                                    <span class="font-weight-light">Users</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-people"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Post by Day</strong>
                            </div>
                            <div class="card-body p-0">
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{!! $chart->script() !!}
@endsection


