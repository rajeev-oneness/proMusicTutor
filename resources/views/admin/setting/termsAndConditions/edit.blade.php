@extends('layouts.auth.authMaster')
@section('title','Terms & Conditions')
@section('content')
<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Terms & Conditions
                        <a class="headerbuttonforAdd" href="{{route('admin.setting.termsandConditions')}}"><i class="fa fa-step-backward" aria-hidden="true"></i>BACK</a>
                    </h5>
                    <!-- <p>This example shows FixedHeader being styled by the Bootstrap 4 CSS framework.</p> -->
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.setting.termsAndConditions.update',$termsandCondition->id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="settingId" value="{{$termsandCondition->id}}">
                        @error('settingId')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                        {{-- <div class="row">
                            <img src="{{asset($termsandCondition->image)}}" height="250" width="250">
                            <div class="form-group">
                                <label for="image" class="col-form-label">Change Image:</label>
                                <input type="file" name="image">
                            </div>    
                        </div> --}}
                        
                        <div class="form-group">
                            <label for="title" class="col-form-label">Heading:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Heading" value="@if(old('title')){{old('title')}}@else{{$termsandCondition->title}}@endif">
                            @error('heading')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">@if(old('description')){{old('description')}}@else{{$termsandCondition->description}}@endif</textarea>
                            @error('description')
                                <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="page_cleane_url" class="col-form-label">Media Link:</label>
                            <textarea class="form-control @error('page_cleane_url') is-invalid @enderror" id="page_cleane_url" name="page_cleane_url" placeholder="page_cleane_url">@if(old('page_cleane_url')){{old('page_cleane_url')}}@else{{$termsandCondition->page_cleane_url}}@endif</textarea>
                            @error('page_cleane_url')
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
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description');  
    </script>
@stop
@endsection