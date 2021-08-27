@extends('layouts.auth.authMaster')
@section('title','Add Sax Series')
@section('content')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Add Sax Series
                        <a class="headerbuttonforAdd" href="{{route('tutor.sax.series')}}"><i class="fa fa-step-backward" aria-hidden="true"></i>BACK</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('tutor.sax.series.save')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="category" class="col-form-label">Category:</label>
                                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                                    <option value="" hidden="" selected="">Select Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}" {{old('category')== $cat->id?'selected':''}}>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                @error('category')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image" class="col-form-label">Image:</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                @error('image')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title" class="col-form-label">Title:</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Series Title" value="{{old('title')}}">
                                @error('title')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="media_link" class="col-form-label">Media Link:</label>
                                <input type="text" class="form-control @error('media_link') is-invalid @enderror" id="media_link" name="media_link" placeholder="Video Media Link" value="{{old('media_link')}}">
                                @error('media_link')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="price" class="col-form-label">Price:</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" value="{{old('price')}}"onkeypress="return isNumberKey(event)" maxlength="5">
                                @error('price')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>


                            <div class="form-group col-md-4">
                                <label for="gbp" class="col-form-label">GDP(default):</label>
                                <input type="text" class="form-control @error('gbp') is-invalid @enderror" id="gbp" name="gbp" placeholder="GDP" value="{{old('gbp')}}"onkeypress="return isNumberKey(event)" maxlength="5">
                                @error('gbp')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="usd" class="col-form-label">USD:</label>
                                <input type="text" class="form-control @error('usd') is-invalid @enderror" id="usd" name="usd" placeholder="USD" value="{{old('usd')}}"onkeypress="return isNumberKey(event)" maxlength="5">
                                @error('usd')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="euro" class="col-form-label">Euro:</label>
                                <input type="text" class="form-control @error('euro') is-invalid @enderror" id="euro" name="euro" placeholder="Euro" value="{{old('euro')}}" onkeypress="return isNumberKey(event)" maxlength="5">
                                @error('euro')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            {{-- <div class="form-group col-md-4">
                                <label for="genre" class="col-form-label">Genre:</label>
                                <select  class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" multiple="" value="{{old('genre')}}">
                                    <option value="Rock">Rock</option>
                                    <option value="Blues">Blues</option>
                                    <option value="Funk">Funk</option>
                                    <option value="Jazz">Jazz</option>
                                    <option value="Country">Country</option>
                                    <option value="Latin">Latin</option>
                                    <option value="Metal">Metal</option>
                                    <option value="Soul">Soul</option>
                                    <option value="Fusion">Fusion</option>
                                </select>
                                @error('genre')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div> --}}

                            <div class="form-group col-md-4">
                                <label for="genre" class="col-form-label">Genre:</label>
                                <select  class="form-control genre-select select2-offscreen " id="genre" name="genre" multiple tabindex="-1" >
                                    <option value="Guitar - Rock">Guitar - Rock</option>
                                    <option value="Guitar - Blues">Guitar - Blues</option>
                                    <option value="Sax - Blues">Sax - Blues</option>
                                    <option value="Guitar - Funk">Guitar - Funk</option>
                                    <option value="Sax - Funk">Sax - Funk</option>
                                    <option value="Guitar - Jazz">Guitar - Jazz</option>
                                    <option value="Sax - Jazz">Sax - Jazz</option>
                                    <option value="Guitar - Country">Guitar - Country</option>
                                    <option value="Sax - Latin">Sax - Latin</option>
                                    <option value="Guitar - Metal">Guitar - Metal</option>
                                    <option value="Guitar - Soul">Guitar - Soul</option>
                                    <option value="Guitar - Fusion">Guitar - Fusion</option>
                                </select>
                                @error('genre')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="difficulty" class="col-form-label">Difficulty:</label>
                                <select  class="form-control @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty" value="{{old('difficulty')}}">
                                    <option value="Medium">Medium</option>
                                    <option value="Easy">Easy</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('difficulty')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="item_clean_url" class="col-form-label">Item Clean Url:</label>
                                <input type="text" class="form-control @error('item_clean_url') is-invalid @enderror" id="item_clean_url" name="item_clean_url" placeholder="Item Clean Url" value="{{old('item_clean_url')}}" >
                                @error('item_clean_url')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="seo_meta_description" class="col-form-label">SEO-meta Description:</label>
                                <input type="text" class="form-control @error('seo_meta_description') is-invalid @enderror" id="seo_meta_description" name="seo_meta_description" placeholder="SEO-meta Description" value="{{old('seo_meta_description')}}">
                                @error('seo_meta_description')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="seo_meta_keywords" class="col-form-label">SEO-meta Keywords:</label>
                                <input type="text" class="form-control @error('seo_meta_keywords') is-invalid @enderror" id="seo_meta_keywords" name="seo_meta_keywords" placeholder="SEO-meta Keywords" value="{{old('seo_meta_keywords')}}">
                                @error('seo_meta_keywords')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            {{-- <div class="form-group col-md-4">
                                <label for="related_series" class="col-form-label">Related Series:</label>
                                <input type="text" class="form-control @error('related_series') is-invalid @enderror" id="related_series" name="related_series" placeholder="Related Series" value="{{old('related_series')}}">
                                @error('related_series')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div> --}}

                            <div class="form-group col-md-4">
                                <select name="related_series" data-placeholder="Select Related Series" style="width:350px;" class="chosen-select select2-offscreen form-control @error('related_series') is-invalid @enderror" multiple="" tabindex="-1" value="[<Series: Moody's Slant On The Blues Series 1>, <Series: Whitesnake - Fool For Your Loving >, <Series: Whitesnake - Slow &amp; Easy >]" id="related_series" name="related_series" placeholder="Related Series" value="{{old('related_series')}}">
                                    <optgroup label="Pro Licks">
                                        <option value="Acoustic Series 1">Acoustic Series 1</option>
                                        <option value="Country Blues Series 2">Country Blues Series 2</option>
                                        <option value="Building The Blues Series 1">Building The Blues Series 1</option>
                                        <option value="Jazz Rock Series 1">Jazz Rock Series 1</option>
                                        <option value="Rock Series 1">Rock Series 1</option>
                                        <option value="Blues Rock Slide Series 1">Blues Rock Slide Series 1</option>
                                        <option value="Progressive Lead Series 1">Progressive Lead Series 1</option>
                                        <option value="Chuck &amp; Roll Series 1">Chuck &amp; Roll Series 1</option>
                                        <option value="Funk Rock Series 1">Funk Rock Series 1</option>
                                        <option value="Pentatonic Brutality Series 1">Pentatonic Brutality Series 1</option>
                                        <option value="Blues Experience Series 1">Blues Experience Series 1</option>
                                        <option value="Building the Blues Series 2">Building the Blues Series 2</option>
                                        <option value="Country Blues Series 1">Country Blues Series 1</option>
                                        <option value="Minor Blues Series 1">Minor Blues Series 1</option>
                                        <option value="Blues Series 1">Blues Series 1</option>
                                        <option value="Jazz and Blues Concepts Series 1">Jazz and Blues Concepts Series 1</option>
                                        <option value="Jazz and Blues Concepts Series 2">Jazz and Blues Concepts Series 2</option>
                                    </optgroup>
                                    <optgroup label="Techniques">
                                        <option value="Pure Funk Series 1">Pure Funk Series 1</option>
                                        <option value="Moody's Slant On The Blues Series 1">Moody's Slant On The Blues Series 1</option>
                                        <option value="Rhythm Series 1">Rhythm Series 1</option>
                                        <option value="Country Blues Techniques Series 1">Country Blues Techniques Series 1</option>
                                    </optgroup>
                                    <optgroup label="Popular Songs">
                                        <option value="Fool For Your Loving">Fool For Your Loving</option>
                                        <option value="Slow And Easy">Slow And Easy</option>
                                    </optgroup>
                                    <optgroup label="Backing Tracks">
                                        <option value="ACDC - Back In Black">ACDC - Back In Black</option>
                                        <option value="ACDC - You Shook Me All Night Long">ACDC - You Shook Me All Night Long</option>
                                        <option value="ACDC - TNT">ACDC - TNT</option>
                                        <option value="ACDC - Stiff Upper Lip">ACDC - Stiff Upper Lip</option>
                                        <option value="ACDC - Highway To Hell">ACDC - Highway To Hell</option>
                                        <option value="Whitesnake - Fool For Your Loving">Whitesnake - Fool For Your Loving </option>
                                        <option value="Whitesnake - Slow &amp; Easy">Whitesnake - Slow &amp; Easy </option>
                                        <option value="ACDC - Shot Down In Flames">ACDC - Shot Down In Flames</option>
                                        <option value="ACDC - Hells Bells">ACDC - Hells Bells</option>
                                    </optgroup>
                                </select>
                                @error('related_series')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">{{old('description')}}</textarea>
                            @error('description')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
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