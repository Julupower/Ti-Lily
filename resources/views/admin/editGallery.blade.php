@extends('layouts.admin')

@section('title')Edit Product @endsection


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row" align="center">
            
            @if(Session::has('success'))
            <div class="alert alert-success col-md-12">{{ Session::get('success') }}&nbsp;<i class="icon icon-emotsmile"></i></div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger col-md-12">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header bg-light col-md-12" align="center">
                <h4><strong>Edit Gallery</strong></h4>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="card col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <form method="POST" action="{{ route('adminAddGalleryImg') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="normal-input" class="form-control-label">Select Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>   
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="normal-input" class="form-control-label">Image Title</label>
                                    <input name="title" class="form-control" value="" placeholder="Please enter image title here...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="normal-input" class="form-control-label">Position</label>
                                    <input name="position" class="form-control" value="{{ !$last_image ? '1' : $last_image->sort_order + 1 }}" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea name="desc" class="form-control summernote" id="post-content" cols="30" rows="10" placeholder="Enter description here..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8" align='center'>
                            <button type="submit" class="btn btn-primary rounded-corners">Update Gallery&nbsp;&nbsp;<i class="icon icon-arrow-up-circle"></i></button>
                        </div>  
                    </div>
                </form>  
            </div>
            <div class="card col-xs-12 col-sm-8 col-md-8 col-lg-8 display_img">
                <div class="row col-md-12">
                    @foreach($gallery_images as $img)
                    <div class="col-sm-4">
                        <form method="POST" action="#" enctype="multipart/form-data">
                        <table>   
                            @csrf
                                <tbody>
                                    <tr>
                                        <td>
                                            <label class="form-control-label">Change image position</label>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <select class="btn btn-secondary dropdown-toggle rounded-corners"  name="sort-order" onchange="if (this.selectedIndex) alert('Testing 1,2,3...');">
                                                <option value="{{ $img->sort_order }}">{{ $img->sort_order }}</option>
                                                @foreach($gallery_images as $img_order)
                                                    @if($img_order->sort_order != $img->sort_order)
                                                    <option value="{{ $img_order->sort_order }}" class="">{{ $img_order->sort_order }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <button type="button" class="btn btn-danger rounded-corners" data-toggle="modal" data-target="#delete-img-model-{{ $img->id }}">Delete&nbsp;&nbsp;<i class="icon icon-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>
                        </form>
                        <br>
                        <img src="{{ asset($img->image_filepath) }}" alt="{!! $img->description !!}" data-toggle="tooltip" title="{{ $img->title }}" class="gallery-img rounded-corners">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@foreach($gallery_images as $img)
<!------------------------ START MODAL --------------------------------->
<div class="modal fade" id="delete-img-model-{{ $img->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete Image">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gallery-img-{{ $img->id }}">You are about to delete this image "<strong>{{ $img->title }}.</strong>"</h4>
      </div>
      <div class="modal-body text-danger">
          <strong>Do you want this?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <form method="POST" action="{{ route('adminDeleteImg', $img->id) }}" id="admin-delete-img-{{ $img->id }}">
        @csrf
            <button type="button" class="btn btn-primary" onclick="document.getElementById('admin-delete-img-{{ $img->id }}').submit();">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!------------------------ END   MODAL --------------------------------->
@endforeach
@endsection
