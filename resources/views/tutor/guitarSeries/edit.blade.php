@extends('layouts.auth.authMaster')
@section('title','Edit Guitar Series')
@section('content')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Guitar Series
                        <a class="headerbuttonforAdd" href="{{route('tutor.guitar.series')}}"><i class="fa fa-step-backward" aria-hidden="true"></i>BACK</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('tutor.guitar.series.update',$guitarSeries->id)}}" enctype="multipart/form-data">
                        <input type="hidden" name="guitarSeriesId" value="{{$guitarSeries->id}}">
                        @error('guitarSeriesId')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                        @csrf
                        <div class="row">
                            <img src="{{asset($guitarSeries->image)}}" height="250" width="250">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="category" class="col-form-label">Category:</label>
                                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                                    <option value="" hidden="" selected="">Select Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}" {{($guitarSeries->categoryId == $cat->id ? 'selected':'')}}>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                @error('category')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image" class="col-form-label">Change Image:</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                @error('image')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title" class="col-form-label">Title:</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Series Title" value="{{$guitarSeries->title}}">
                                @error('title')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="media_link" class="col-form-label">Media Link:</label>
                                <input type="text" class="form-control @error('media_link') is-invalid @enderror" id="media_link" name="media_link" placeholder="Video Media Link" value="{{$guitarSeries->video_url}}">
                                @error('media_link')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="price" class="col-form-label">Price:</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" value="{{$guitarSeries->price}}"  onkeypress="return isNumberKey(event)" maxlength="5">
                                @error('price')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="gbp" class="col-form-label">GBP:</label>
                                <input type="text" class="form-control @error('gbp') is-invalid @enderror" id="gbp" name="gbp" placeholder="GBP" value="{{$guitarSeries->gbp}}"  onkeypress="return isNumberKey(event)" maxlength="5">
                                @error('gbp')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="usd" class="col-form-label">USD:</label>
                                <input type="text" class="form-control @error('usd') is-invalid @enderror" id="usd" name="usd" placeholder="USD" value="{{$guitarSeries->usd}}"  onkeypress="return isNumberKey(event)" maxlength="5">
                                @error('usd')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="euro" class="col-form-label">Euro:</label>
                                <input type="text" class="form-control @error('euro') is-invalid @enderror" id="euro" name="euro" placeholder="Euro" value="{{$guitarSeries->euro}}"  onkeypress="return isNumberKey(event)" maxlength="5">
                                @error('euro')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label for="genre" class="col-form-label">Genre:</label>
                                <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" placeholder="Genre" value="{{$guitarSeries->genre}}">
                                @error('genre')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div> --}}

                            <div class="form-group col-md-4">
                                <label for="genre" class="col-form-label">Genre:</label>
                                <select  class="form-control genre-select select2-offscreen " id="genre" name="genre" multiple tabindex="-1" >
                                    <option value="Guitar - Rock" <?=$guitarSeries->genre  == 'Guitar - Rock' ? ' selected="selected"' : '';?> >Guitar - Rock </option>
                                    <option value="Guitar - Blues" <?=$guitarSeries->genre  == 'Guitar - Blues' ? ' selected="selected"' : '';?> >Guitar - Blues </option>
                                    <option value="Sax - Blues" <?=$guitarSeries->genre  == 'Sax - Blues' ? ' selected="selected"' : '';?> >Sax - Blues </option>
                                    <option value="Guitar - Funk" <?=$guitarSeries->genre  == 'Guitar - Funk' ? ' selected="selected"' : '';?> >Guitar - Funk </option>
                                    <option value="Sax - Funk" <?=$guitarSeries->genre  == 'Sax - Funk' ? ' selected="selected"' : '';?> >Sax - Funk </option>
                                    <option value="Guitar - Jazz" <?=$guitarSeries->genre  == 'Guitar - Jazz' ? ' selected="selected"' : '';?> >Guitar - Jazz </option>
                                    <option value="Sax - Jazz" <?=$guitarSeries->genre  == 'Sax - Jazz' ? ' selected="selected"' : '';?> >Sax - Jazz </option>
                                    <option value="Guitar - Country" <?=$guitarSeries->genre  == 'Guitar - Country' ? ' selected="selected"' : '';?> >Guitar - Country </option>
                                    <option value="Sax - Latin" <?=$guitarSeries->genre  == 'Sax - Latin' ? ' selected="selected"' : '';?> >Sax - Latin </option>
                                    <option value="Guitar - Metal" <?=$guitarSeries->genre  == 'Guitar - Metal' ? ' selected="selected"' : '';?> >Guitar - Metal </option>
                                    <option value="Guitar - Soul" <?=$guitarSeries->genre  == 'Guitar - Soul' ? ' selected="selected"' : '';?> >Guitar - Soul </option>
                                    <option value="Guitar - Fusion" <?=$guitarSeries->genre  == 'Guitar - Fusion' ? ' selected="selected"' : '';?> >Guitar - Fusion </option>
                                </select>
                                @error('genre')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label for="difficulty" class="col-form-label">Difficulty:</label>
                                <input type="text" class="form-control @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty" placeholder="Difficulty" value="{{$guitarSeries->difficulty}}">
                                @error('difficulty')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div> --}}

                            <div class="form-group col-md-4">
                                <label for="difficulty" class="col-form-label">Difficulty:</label>
                                <select  class="form-control @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty" value="{{old('difficulty')}}">
                                    <option value="Medium" <?=$guitarSeries->difficulty  == 'Medium' ? ' selected="selected"' : '';?> >Medium </option>
                                    <option value="Easy" <?=$guitarSeries->difficulty  == 'Easy' ? ' selected="selected"' : '';?> >Easy </option>
                                    <option value="Other" <?=$guitarSeries->difficulty  == 'Other' ? ' selected="selected"' : '';?> >Other </option>
                                    {{-- <option value="Medium">Medium</option>
                                    <option value="Easy">Easy</option>
                                    <option value="Other">Other</option> --}}
                                </select>
                                @error('difficulty')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="seo_meta_description" class="col-form-label">SEO-Meta Description:</label>
                                <input type="text" class="form-control @error('seo_meta_description') is-invalid @enderror" id="seo_meta_description" name="seo_meta_description" placeholder="SEO-Meta Description" value="{{$guitarSeries->seo_meta_description}}">
                                @error('seo_meta_description')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="seo_meta_keywords" class="col-form-label">SEO-Meta Keywords:</label>
                                <input type="text" class="form-control @error('seo_meta_keywords') is-invalid @enderror" id="seo_meta_keywords" name="seo_meta_keywords" placeholder="SEO-Meta Keywords" value="{{$guitarSeries->seo_meta_keywords}}">
                                @error('seo_meta_keywords')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label for="related_series" class="col-form-label">Related Series:</label>
                                <input type="text" class="form-control @error('related_series') is-invalid @enderror" id="related_series" name="related_series" placeholder="Related Series" value="{{$guitarSeries->related_series}}">
                                @error('related_series')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div> --}}
                           

                            <div class="form-group col-md-4">
                                 <label for="related_series" class="col-form-label">Related Series:</label>
                                <select name="related_series" data-placeholder="Select Related Series" style="width:350px;" class="chosen-select select2-offscreen form-control @error('related_series') is-invalid @enderror" multiple="" tabindex="-1" value="[<Series: Moody's Slant On The Blues Series 1>, <Series: Whitesnake - Fool For Your Loving >, <Series: Whitesnake - Slow &amp; Easy >]" id="related_series" name="related_series" placeholder="Related Series" value="{{old('related_series')}}">
                                    <optgroup label="Pro Licks">
                                        <option value="Acoustic Series 1" <?=$guitarSeries->related_series  == 'Acoustic Series 1' ? ' selected="selected"' : '';?> >Acoustic Series 1 </option>
                                        <option value="Country Blues Series 2" <?=$guitarSeries->related_series  == 'Country Blues Series 2' ? ' selected="selected"' : '';?> >Country Blues Series 2</option>
                                        <option value="Building The Blues Series 1" <?=$guitarSeries->related_series  == 'Building The Blues Series 1' ? ' selected="selected"' : '';?> >Building The Blues Series 1 </option>
                                        <option value="Jazz Rock Series 1" <?=$guitarSeries->related_series  == 'Jazz Rock Series 1' ? ' selected="selected"' : '';?> >Jazz Rock Series 1 </option>
                                        <option value="Rock Series 1" <?=$guitarSeries->related_series  == 'Rock Series 1' ? ' selected="selected"' : '';?> >Rock Series 1 </option>
                                        <option value="Blues Rock Slide Series 1" <?=$guitarSeries->related_series  == 'Blues Rock Slide Series 1' ? ' selected="selected"' : '';?> >Blues Rock Slide Series 1 </option>
                                        <option value="Progressive Lead Series 1" <?=$guitarSeries->related_series  == 'Progressive Lead Series 1' ? ' selected="selected"' : '';?> >Progressive Lead Series 1 </option>
                                        <option value="Chuck &amp; Roll Series 1" <?=$guitarSeries->related_series  == 'Chuck &amp; Roll Series 1' ? ' selected="selected"' : '';?> >Chuck &amp; Roll Series 1 </option>
                                        <option value="Funk Rock Series 1" <?=$guitarSeries->related_series  == 'Funk Rock Series 1' ? ' selected="selected"' : '';?> >Funk Rock Series 1 </option>
                                        <option value="Pentatonic Brutality Series 1" <?=$guitarSeries->related_series  == 'Pentatonic Brutality Series 1' ? ' selected="selected"' : '';?> >Pentatonic Brutality Series 1 </option>
                                        <option value="Blues Experience Series 1" <?=$guitarSeries->related_series  == 'Blues Experience Series 1' ? ' selected="selected"' : '';?> >Blues Experience Series 1 </option>
                                        <option value="Building the Blues Series 2" <?=$guitarSeries->related_series  == 'Building the Blues Series 2' ? ' selected="selected"' : '';?> >Building the Blues Series 2 </option>
                                        <option value="Country Blues Series 1" <?=$guitarSeries->related_series  == 'Country Blues Series 1' ? ' selected="selected"' : '';?> >Country Blues Series 1 </option>
                                        <option value="Minor Blues Series 1" <?=$guitarSeries->related_series  == 'Minor Blues Series 1' ? ' selected="selected"' : '';?> >Minor Blues Series 1 </option>
                                        <option value="Blues Series 1" <?=$guitarSeries->related_series  == 'Blues Series 1' ? ' selected="selected"' : '';?> >Blues Series 1 </option>
                                        <option value="Jazz and Blues Concepts Series 1" <?=$guitarSeries->related_series  == 'Jazz and Blues Concepts Series 1' ? ' selected="selected"' : '';?> >Jazz and Blues Concepts Series 1 </option>
                                        <option value="Jazz and Blues Concepts Series 2" <?=$guitarSeries->related_series  == 'Jazz and Blues Concepts Series 2' ? ' selected="selected"' : '';?> >Jazz and Blues Concepts Series 2 </option>
                                    </optgroup>
                                    <optgroup label="Techniques">
                                        <option value="Pure Funk Series 1" <?=$guitarSeries->related_series  == 'Pure Funk Series 1' ? ' selected="selected"' : '';?> >Pure Funk Series 1 </option>
                                        <option value="Moody's Slant On The Blues Series 1" >Moody's Slant On The Blues Series 1 </option>
                                        <option value="Rhythm Series 1" <?=$guitarSeries->related_series  == 'Rhythm Series 1' ? ' selected="selected"' : '';?> >Rhythm Series 1 </option>
                                         <option value="Country Blues Techniques Series 1" <?=$guitarSeries->related_series  == 'Country Blues Techniques Series 1' ? ' selected="selected"' : '';?> >Country Blues Techniques Series 1 </option>
                                    </optgroup>
                                    <optgroup label="Popular Songs">
                                        <option value="Fool For Your Loving" <?=$guitarSeries->related_series  == 'Fool For Your Loving' ? ' selected="selected"' : '';?> >Fool For Your Loving </option>
                                        <option value="Slow And Easy" <?=$guitarSeries->related_series  == 'Slow And Easy' ? ' selected="selected"' : '';?> >Slow And Easy </option>
                                    </optgroup>
                                    <optgroup label="Backing Tracks">
                                        <option value="ACDC - Back In Black" <?=$guitarSeries->related_series  == 'ACDC - Back In Black' ? ' selected="selected"' : '';?> >ACDC - Back In Black </option>
                                        <option value="ACDC - You Shook Me All Night Long" <?=$guitarSeries->related_series  == 'ACDC - You Shook Me All Night Long' ? ' selected="selected"' : '';?> >ACDC - You Shook Me All Night Long </option>
                                        <option value="ACDC - TNT" <?=$guitarSeries->related_series  == 'ACDC - TNT' ? ' selected="selected"' : '';?> >ACDC - TNT </option>
                                        <option value="ACDC - Stiff Upper Lip" <?=$guitarSeries->related_series  == 'ACDC - Stiff Upper Lip' ? ' selected="selected"' : '';?> >ACDC - Stiff Upper Lip </option>
                                        <option value="ACDC - Highway To Hell" <?=$guitarSeries->related_series  == 'ACDC - Highway To Hell' ? ' selected="selected"' : '';?> >ACDC - Highway To Hell </option>
                                        <option value="Whitesnake - Fool For Your Loving" <?=$guitarSeries->related_series  == 'Whitesnake - Fool For Your Loving' ? ' selected="selected"' : '';?> >Whitesnake - Fool For Your Loving </option>
                                        <option value="Whitesnake - Slow &amp; Easy" <?=$guitarSeries->related_series  == 'Whitesnake - Slow &amp; Easy' ? ' selected="selected"' : '';?> >Whitesnake - Slow &amp; Easy</option>
                                        <option value="ACDC - Shot Down In Flames" <?=$guitarSeries->related_series  == 'ACDC - Shot Down In Flames' ? ' selected="selected"' : '';?> >ACDC - Shot Down In Flames </option>
                                        <option value="ACDC - Hells Bells" <?=$guitarSeries->related_series  == 'ACDC - Hells Bells' ? ' selected="selected"' : '';?> >ACDC - Hells Bells </option>
                                    </optgroup>
                                </select>
                                @error('related_series')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>
 
                            <div class="form-group col-md-6">
                                <label for="item_clean_url" class="col-form-label">Item Clean Url:</label>
                                <input type="text" class="form-control @error('item_clean_url') is-invalid @enderror" id="item_clean_url" name="item_clean_url" placeholder="Item Clean Url" value="{{$guitarSeries->item_clean_url}}">
                                @error('item_clean_url')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">{{$guitarSeries->description}}</textarea>
                            @error('description')<span class="text-danger" role="alert">{{$message}}</span>@enderror
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