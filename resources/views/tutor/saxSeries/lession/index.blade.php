@extends('layouts.auth.authMaster')
@section('title','Sax Lession')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Sax Lession List ({{$saxSeries->title}})
                            <a class="headerbuttonforAdd" href="{{route('tutor.sax.series')}}"><i class="fa fa-step-backward" aria-hidden="true"></i>BACK</a>
                            <a class="headerbuttonforAdd" href="{{route('tutor.sax.series.lession.create',$saxSeries->id)}}">
                                <i class="fa fa-plus" aria-hidden="true"></i>Add Lesson
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Video Link</th>
                                        <th>GBP</th>
                                        <th>USD</th>
                                        <th>Euro</th>
                                        <th>Keyword</th>
                                        <th>Gener</th>
                                        <th>Item Clean Url</th>
                                        <th>Product Code</th>
                                        <th>Description</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($saxSeries->lession as $key => $lession)
                                        <tr>
                                            <td><img src="{{asset($lession->image)}}" height="200" width="200"></td>
                                            <td>{{$lession->title}}</td>
                                            <td>£{{$lession->price}}</td>
                                            <td><a href="{{$lession->video_url}}" target="_blank">Link</a></td>
                                            <td>{{$lession->gbp}}</td>
                                            <td>{{$lession->usd}}</td>
                                            <td>{{$lession->euro}}</td>
                                            <td>{{$lession->keywords}}</td>
                                            <td>{{$lession->genre}}</td>
                                            <td>{{$lession->item_clean_url}}</td>
                                            <td>{{$lession->product_code}}</td>
                                            <td>{!! substr($lession->description, 0, 100). '.....' !!}</td>
                                            {{-- <td>{{$lession->status}}</td> --}}
                                            <td><a href="{{route('tutor.sax.series.lession.edit',[$saxSeries->id,$lession->id])}}">Edit</a> | <a href="javascript:void(0)" class="text-danger seriesLessionDelete" data-id="{{$lession->id}}">Delete</a></td>
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example4').DataTable();
        });

        $(document).on('click','.seriesLessionDelete',function(){
            var seriesLessionDelete = $(this);
            var seriesLessionId = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Sax Lesson!",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type:'POST',
                        dataType:'JSON',
                        url:"{{route('tutor.sax.series.lession.delete',[$saxSeries->id,"+seriesLessionId+"])}}",
                        data: {id:seriesLessionId,'_token': $('input[name=_token]').val()},
                        success:function(data){
                            if(data.error == false){
                                seriesLessionDelete.closest('tr').remove();
                                swal('Success',"Poof! Your Sax Series Lesson has been deleted!");
                            }else{
                                swal('Error',data.message);
                            }
                        }
                    });
                    
                }
            });
        });
    </script>
@stop
@endsection
