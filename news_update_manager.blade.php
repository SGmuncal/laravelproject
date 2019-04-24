@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white; font-size:14px;">
    <div class="container">
    <h2 style="font-weight: 400;">News Update</h2>
    
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
                  <th>News Images Category</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($update_news as $get_news_data)
                <tr>
                    <td>
                    {{
                        str_limit($get_news_data->content_title, $limit = 15, $end = '...')
                    }}
                    </td>
                    <td>
                    {{
                        str_limit($get_news_data->content, $limit = 15, $end = '...')
                    }}
                    </td>
                    <td><a href="{{ url('news_update_image_manager',$get_news_data->content_id) }}"><i class="far fa-images" style="color:#6a11cb;"></i></a></td>
                    <td>{{$get_news_data->status}}</td>
                    <td>
                        <a href="{{ url('get_update_news',$get_news_data->content_id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>

                        <br><br>

                        <form action="/inactive_news" method="get">
                            <a href="{{ url('inactive_news',$get_news_data->content_id) }}" class="btn btn-warning">Inactive <i class="far fa-eye-slash"></i></a>
                        </form>

                        <br>
                        <form action="/delete_news" method="get">
                            <a href="{{ url('delete_news',$get_news_data->content_id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
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