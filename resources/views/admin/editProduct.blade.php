@extends('layouts.admin')

@section('title')Edit Product @endsection


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4><strong>Edit Product-- {{ $product->title }}</strong></h4>
                    </div>
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}&nbsp;<i class="icon icon-emotsmile"></i></div>
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
                    <form method="POST" action="{{ route('adminEditProductPost', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">Thumbnail</label>
                                        <input type="file" name="thumbnail" id="normal-input" class="form-control">
                                    </div>
                                    <img src="{{ asset($product->thumbnail) }}" width="100" alt="Product {{ $product->title }}">
                                </div>   
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">Product Name</label>
                                        <input name="product-name" id="normal-input" class="form-control" value="{{ $product->title }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">Product Description</label>
                                        <textarea name="description" class="form-control summernote" id="post-content" cols="30" rows="10">{{ $product->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">Price</label>
                                        <input name="price" id="normal-input" class="form-control" value="{{ $product->price }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-8" align='center'>
                                <button type="submit" class="btn btn-primary">Update Product&nbsp;&nbsp;<i class="icon icon-arrow-up-circle"></i></button>
                            </div>  
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
