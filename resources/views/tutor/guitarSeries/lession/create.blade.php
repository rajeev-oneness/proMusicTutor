@extends('layouts.auth.authMaster')
@section('title','Add Guitar Lession')
@section('content')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Add Guitar Lession ({{$guitarSeries->title}})
                        <a class="headerbuttonforAdd" href="{{route('tutor.guitar.series.lession',$guitarSeries->id)}}"><i class="fa fa-step-backward" aria-hidden="true"></i>BACK</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('tutor.guitar.series.lession.save',$guitarSeries->id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="guitarSeriesId" value="{{$guitarSeries->id}}">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="image" class="col-form-label">Image:</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                @error('image')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="media_link" class="col-form-label">Media Link:</label>
                                <input type="text" class="form-control @error('media_link') is-invalid @enderror" id="media_link" name="media_link" placeholder="Video Media Link" value="{{old('media_link')}}">
                                @error('media_link')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="title" class="col-form-label">Title:</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Series Title" value="{{old('title')}}">
                                @error('title')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="price" class="col-form-label">Price:</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" value="{{old('price')}}"  onkeypress="return isNumberKey(event)" maxlength="5">
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

                            <div class="form-group col-md-4">
                                <label for="keywords" class="col-form-label">Keywords:</label>
                                <input type="text" class="form-control @error('keywords') is-invalid @enderror" id="keywords" name="keywords" placeholder="Keywords" value="{{old('keywords')}}">
                                @error('keywords')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            {{-- <div class="form-group col-md-4">
                                <label for="genre" class="col-form-label">Genre:</label>
                                <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" placeholder="Genre" value="{{old('genre')}}">
                                @error('genre')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div> --}}

                            {{-- <td>
                                <span class="error" id="genre" style="display:none;"></span>
                                <div class="select2-container select2-container-multi form-control genre-select" id="s2id_autogen1">
                                    <ul class="select2-choices">
                                      <li class="select2-search-field">
                                              <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" id="s2id_autogen2" style="width: 20px;">
                                       </li>
                                    </ul>
                                </div>
                                        <select name="genre" class="form-control genre-select select2-offscreen" multiple="" tabindex="-1">
                                            <option value="1">Guitar - Rock</option>
                                            <option value="2">Guitar - Blues</option>
                                            <option value="10">Sax - Blues</option>
                                            <option value="3">Guitar - Funk</option>
                                            <option value="12">Sax - Funk</option>
                                            <option value="4">Guitar - Jazz</option>
                                            <option value="11">Sax - Jazz</option>
                                            <option value="5">Guitar - Country</option>
                                            <option value="6">Sax - Latin</option>
                                            <option value="7">Guitar - Metal</option>
                                            <option value="8">Guitar - Soul</option>
                                            <option value="9">Guitar - Fusion</option>
                                        </select>
                            </td> --}}
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
                                <label for="product_code" class="col-form-label">Product Code:</label>
                                <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="product_code" name="product_code" placeholder="Product Code" value="{{old('product_code')}}">
                                @error('product_code')<span class="text-danger" role="alert">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="product_code" class="col-form-label">Status:</label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="item_clean_url" class="col-form-label">Item Clean Url:</label>
                                <input type="text" class="form-control @error('item_clean_url') is-invalid @enderror" id="item_clean_url" name="item_clean_url" placeholder="Item Clean Url" value="{{old('item_clean_url')}}" >
                                @error('item_clean_url')<span class="text-danger" role="alert">{{$message}}</span>@enderror
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