@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white; font-size:14px;">
    
<div class="container">
    <h2 style="font-weight: 400;">Job Update</h2>
    @if (Session::has('message'))
        <li style="font-size:20px; color:red;">{!! session('message') !!}</li>
   @endif
   <br><br>
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                  <th>Position Name</th>
                  <th>Position Description</th>
                  <th>Position Requirements</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($update_job as $get_job_data)
                <tr>
                    <td>
                    {!!
                        str_limit($get_job_data->position_name, $limit = 10, $end = '...')
                    !!}
                    </td>
                    <td>
                    {!!
                        str_limit($get_job_data->position_desc, $limit = 10, $end = '...')
                    !!}
                    </td>
                    <td>
                    {!!
                        str_limit($get_job_data->position_requirements, $limit = 10, $end = '...')
                    !!}
                    </td>
                    <td>{{$get_job_data->location}}</td>
                    <td>{{$get_job_data->status}}</td>
                    <td>
                        <a href="{{ url('get_update_job',$get_job_data->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                        <br><br>
                        <form action="/inactive_job" method="get">
                        <a href="{{ url('inactive_job',$get_job_data->id) }}" class="btn btn-warning">Inactive <i class="far fa-eye-slash"></i></a>
                        </form>
                        <br>
                        <form action="/delete_job" method="get">
                            <a href="{{ url('delete_job',$get_job_data->id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
                        </form>
                    </td>
                     
                    
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection