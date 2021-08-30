@extends('layouts.auth.authMaster')
@section('title','Terms & Conditions')
@section('content')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Terms & Conditions</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                	{{-- <th>Image</th> --}}
                                    <th>Heading</th>
                                    <th>Description</th>
                                    <th>Item Clean URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($termsAndConditions as $key=>$term)
                            		<tr>
                            			{{-- <td><img src="{{asset($term->image)}}" height="200" width="200"></td> --}}
                            			<td>{{$term->title}}</td>
                            			<td>{!! $term->description !!}</td>
                            			<td>{{ $term->page_cleane_url }}</td>
                            			<td><a href="{{route('admin.setting.termsAndConditions.edit',$term->id)}}">Edit</a></td>
                            		</tr>
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection