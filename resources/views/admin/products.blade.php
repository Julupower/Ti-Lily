@extends('layouts.admin')

@section('title')Administrator Products @endsection

@section('content')
<div class="content">
     <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Administrator Post
                <a href="{{ route('adminNewProduct') }}" class="btn btn-primary">Create New Product&nbsp;&nbsp;<i class="icon icon-wrench"></i></a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit Product</th>
                            <th>Delete Product</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ asset($product->thumbnail) }}" width="100"></td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td><i class="fa fa-gbp"></i>&nbsp;{{ $product->price }}</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($product->updated_at)->diffForHumans() }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('adminEditProduct', $product->id) }}"><button type="button" class="btn btn-success">Edit Product&nbsp;&nbsp;<i class="icon icon-pencil"></i></button></a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-product-model-{{ $product->id }}">&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
@foreach($products as $product)
<!-- Modal -->
<div class="modal fade" id="delete-product-model-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete Post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="admin-product-{{ $product->id }}">You are about to delete product "<strong>{{ $product->title }}.</strong>"</h4>
      </div>
      <div class="modal-body text-danger">
          <strong>Do you want this?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <form method="POST" action="{{ route('adminDeleteProduct', $product->id) }}" id="admin-delete-product-{{ $product->id }}">
        @csrf
            <button type="button" class="btn btn-primary" onclick="document.getElementById('admin-delete-product-{{ $product->id }}').submit();">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection