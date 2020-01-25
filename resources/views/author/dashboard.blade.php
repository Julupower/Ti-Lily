@extends('layouts.admin')
        
@section('title') Author Dashboard @endsection

@section('content')
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">{{ Auth::user()->postsToday->count() }}</span>
                                    <span class="font-weight-light">Post Today</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-paper-clip"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">{{ Auth::user()->posts->count() }}</span>
                                    <span class="font-weight-light">Total Post</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-paper-clip"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">{{ $todaysComments->count() }}</span>
                                    <span class="font-weight-light">Comments Today</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-bubble"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">{{ $totalComments->count() }}</span>
                                    <span class="font-weight-light">Total Comments</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-bubbles"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Posts by days</strong>
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
