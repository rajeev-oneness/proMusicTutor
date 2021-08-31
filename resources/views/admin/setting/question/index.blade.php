@extends('layouts.auth.authMaster')
@section('title','Frequently Asked Questions')
@section('content')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Frequently Asked Questions</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                	{{-- <th>Image</th> --}}
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Media Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($question as $key=>$ques)
                            		<tr>
                            			{{-- <td><img src="{{asset($term->image)}}" height="200" width="200"></td> --}}
                            			<td>{{ $ques->title }}</td>
                            			<td>{!! $ques->description !!}</td>
                            			<td>{{ $ques->video_url }}</td>
                            			<td><a href="{{route('admin.setting.question.edit',$ques->id)}}">Edit</a></td>
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