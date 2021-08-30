@extends('layouts.auth.authMaster')
@section('title','Difficulty')
@section('content')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Difficulty List
                        <a class="headerbuttonforAdd" href="{{route('admin.difficulty.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Add Genre
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                	{{-- <th>Image</th> --}}
                                    <th>Name</th>
                                    <th>Date</th>
                                    {{-- <th>Status</th>
                                    <th>Category</th>
                                    <th>Slug</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($difficulty as $key => $dif)
                            		<tr>
                            			{{-- <td><img src="{{asset($gen->image)}}" height="200" width="200"></td> --}}
                            			<td>{{$dif->title}}</td>
                                        <td>{{$dif->created_at}}</td>
                                        {{-- <td>{{$gen->status}}</td> --}}
                                        {{-- <td>{{$gen->category}}</td> --}}
                                        {{-- <td>{{$gen->category->name}}</td> --}}
                                        {{-- <td>{{$gen->slug}}</td> --}}
                            			<td><a href="{{route('admin.difficulty.edit',$dif->id)}}">Edit</a> | <a href="javascript:void(0)" class="text-danger difficultyDelete" data-id="{{$dif->id}}">Delete</a></td>
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

        $(document).on('click','.difficultyDelete',function(){
            var difficultyDelete = $(this);
            var difficultyId = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this difficulty!",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type:'POST',
                        dataType:'JSON',
                        url:"{{route('admin.difficulty.delete',"+difficultyId+")}}",
                        data: {id:difficultyId,'_token': $('input[name=_token]').val()},
                        success:function(data){
                            if(data.error == false){
                                difficultyDelete.closest('tr').remove();
                                swal('Success',"Poof! Your Difficulty has been deleted!");
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