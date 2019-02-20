@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
    <div class="container">
    <h2 style="font-weight: 400;">Carousel Update</h2>
    <br><br>
    @if (Session::has('message'))
        <li style="font-size:20px; color:red;">{!! session('message') !!}</li>
   @endif
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                  <th>File</th>
                  <th>Link</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($update_slider as $get_slider_data)
                <tr>
                    <td><img src="{{url('/storage/'.$get_slider_data->file.'')}}" class="img-fluid" style="height:250px;"></td>
                    <td>{{$get_slider_data->link}}</td>
                    <td>{{$get_slider_data->status}}</td>
                    <td>
                        <a href="{{ url('get_update_slider',$get_slider_data->content_id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                        <br><br>
                        <form action="/inactive_slider" method="get">
                        <a href="{{ url('inactive_slider',$get_slider_data->content_id) }}" class="btn btn-warning">Inactive <i class="far fa-eye-slash"></i></a>
                        </form> 
                        <br>
                        <form action="/delete_slider" method="get">
                            <a href="{{ url('delete_slider',$get_slider_data->content_id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
                        </form>
                    </td>
                     
                    
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
</div>
<br><br><br><br>
@endsection