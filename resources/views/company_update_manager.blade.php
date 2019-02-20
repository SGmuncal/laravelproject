@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
    <div class="container">
    <h2 style="font-weight: 400;">Company Story Update</h2>
    
    @if (Session::has('message'))
        <li style="font-size:20px; color:red;">{!! session('message') !!}</li>
   @endif
   <br>
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Position Type</th>
                    <th>History Date</th>
                    <th>History Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($update_history as $get_history_data)
                <tr>
                    <td><b>{{$get_history_data->content_section}}</b></td>
                    <td>{{$get_history_data->content_title}}</td>
                    <td>
                    {{
                        str_limit($get_history_data->content, $limit = 25, $end = '...')
                    }}
                    </td>
                    <td>{{$get_history_data->status}}</td>
                    <td>
                        <a href="{{ url('get_update_company',$get_history_data->content_id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                        <br><br>
                        <form action="/inactive_company" method="get">
                        <a href="{{ url('inactive_company',$get_history_data->content_id) }}" class="btn btn-warning">Inactive <i class="far fa-eye-slash"></i></a>
                        </form>
                        <br>
                        <form action="/delete_company" method="get">
                            <a href="{{ url('delete_company',$get_history_data->content_id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
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