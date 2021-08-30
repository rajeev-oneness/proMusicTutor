<label for="image" class="col-form-label">Update Image:</label>
@extends('layouts.auth.authMaster')
@section('title','Edit Difficulty')
@section('content')
<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Difficulty
                        <a class="headerbuttonforAdd" href="{{route('admin.difficulty.view')}}"><i class="fa fa-step-backward" aria-hidden="true"></i>BACK</a>
                    </h5>
                    <!-- <p>This example shows FixedHeader being styled by the Bootstrap 4 CSS framework.</p> -->
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.difficulty.update',$difficulty->id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="difficultyId" value="{{$difficulty->id}}">
                        @error('difficultyId')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                        <img src="{{asset($difficulty->image)}}" height="300" width="300">
                        <div class="form-group">
                            <label for="image" class="col-form-label">Update Image:</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="col-form-label">Genre Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="image" name="name" value="{{$difficulty->title}}" placeholder="Genre Name">
                            @error('name')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="col-form-label">Slug:</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{$difficulty->title}}" placeholder="Slug">
                            @error('slug')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_code" class="col-form-label">Status:</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-form-label">Category:</label>
                            <select class="form-control" name="category">
                                <option value="Guiter">Guiter</option>
                                <option value="Sax">Sax</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{$difficulty->description}}" placeholder="Description">
                            @error('description')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script type="text/javascript">
        
    </script>
@stop
@endsection