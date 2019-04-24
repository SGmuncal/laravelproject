@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white; font-size:14px;">
    <div class="container">
    <h2 style="font-weight: 400;">Community Update</h2>
    
    @if (Session::has('message'))
        <li style="font-size:20px; color:red;">{!! session('message') !!}</li>
   @endif
   <br><br>
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Section</th>
                  <th>Link</th>
                  <th>File</th>
                  <th>File Type</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($update_community as $get_community_data)
                <tr>
                    <td>{{$get_community_data->content_title}}</td>
                    <td>
                    {{
                        str_limit($get_community_data->content, $limit = 25, $end = '...')
                    }}
                    </td>
                    <td>{{$get_community_data->content_section}}</td>
                    <td>
                    {{
                        str_limit($get_community_data->link, $limit = 15, $end = '...')
                    }}
                    </td>
                    <td>
                        @if($get_community_data->file != "")
                            
                            <img src="{{url('/storage/'.$get_community_data->file.'')}}" class="responsive-img" style="width:100px;">
                        @elseif($get_community_data->file != "")
                            <br>
                            <video class="responsive-video" controls>
                                  <source src="{{ url('/storage/'.$get_community_data->file.'') }}" type="video/mp4">
                            </video>
                        @endif
                    </td>
                    <td>{{$get_community_data->file_type}}</td>
                    <td>{{$get_community_data->status}}</td>
                   
                    <td>
                        <a href="{{ url('get_update_community',$get_community_data->content_id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                        <br><br>
                        <form action="/inactive_community" method="get">
                        <a href="{{ url('inactive_community',$get_community_data->content_id) }}" class="btn btn-warning">Inactive <i class="far fa-eye-slash"></i></a>
                        </form>
                        <br>
                        <form action="/delete_community" method="get">
                            <a href="{{ url('delete_community',$get_community_data->content_id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
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