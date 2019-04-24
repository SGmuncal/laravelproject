@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white;">
    <div class="container">
    <h2 style="font-weight: 400;">Home Update</h2>
    @if (Session::has('message'))
        <li style="font-size:20px; color:red;">{!! session('message') !!}</li>
   @endif
   <br>
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" >
            <thead>
                <tr style="font-size:14px;">
                    <th>Section</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>File</th>
                    <th>File Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($update_home as $get_home_data)
                <tr style="font-size:14px;">
                    <td><b>{{$get_home_data->content_section}}</b></td>
                    <td>{{$get_home_data->content_title}}</td>
                    <td>
                    {{
                        str_limit($get_home_data->content, $limit = 15, $end = '...')
                    }}
                    </td>
                    <td>{{$get_home_data->link}}</td>
                    <td>
                        @if($get_home_data->file != "")
                            
                            <img src="{{url('/storage/'.$get_home_data->file.'')}}" class="img-fluid" style="">
                        @elseif($get_home_data->file != "")
                            <br>
                            <video class="responsive-video" controls>
                                <source src="{{ url('/storage/'.$get_home_data->file.'') }}" type="video/mp4">
                            </video>
                        @endif
                    </td>
                    <td>{{$get_home_data->file_type}}</td>
                    
                    <td>{{$get_home_data->status}}</td>
                    <td>
                        <a href="{{ url('get_update_home',$get_home_data->content_id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                        <br><br>
                        <form action="/inactive_home" method="get">
                        <a href="{{ url('inactive_home',$get_home_data->content_id) }}" class="btn btn-warning">Inactive <i class="far fa-eye-slash"></i></a>
                        </form>
                        <br>
                        <form action="/delete_home" method="get">
                            <a href="{{ url('delete_home',$get_home_data->content_id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
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