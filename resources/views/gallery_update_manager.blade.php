@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
  <div class="container">
  <h2 style="font-weight: 400;">Gallery Update</h2>
  
    @if (Session::has('message'))
        <li style="font-size:20px;">{!! session('message') !!}</li>
   @endif
   <br><br>
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                  <th>Title</th>
                  <th>Event Place</th>
                  <th>Event Date</th>
                  <th>File</th>
                  <th>Gallery Images</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($table_gallery as $get_gallery)
                    <tr>
                        
                        <td>
                        {{
                            str_limit($get_gallery->content_title, $limit = 15, $end = '...')
                        }}
                        </td>

                        <td>{{$get_gallery->event_place}}</td>

                        <td>{{$get_gallery->event_date}}</td>

                        <td><img src="{{url('/storage/'.$get_gallery->file.'')}}" class="img-fluid"></td>
                        
                        <td><a href="{{ url('gallery_update_image_manager',$get_gallery->content_id) }}"><i class="far fa-images" style="color:#6a11cb;"></i></a></td>

                        <td>{{$get_gallery->status}}</td>

                        <td>
                            <a href="{{ url('get_update_gallery',$get_gallery->content_id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                            <br><br>
                            <form action="/inactive_gallery" method="get">
                            <a href="{{ url('inactive_gallery',$get_gallery->content_id) }}" class="btn btn-warning">Inactive <i class="far fa-eye-slash"></i></a>
                            </form>
                            <br>
                            <form action="/delete_gallery" method="get">
                                <a href="{{ url('delete_gallery',$get_gallery->content_id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
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