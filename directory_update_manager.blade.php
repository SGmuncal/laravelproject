@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color: white; font-size: 14px;">
    
<div class="container">
    <h2 style="font-weight: 400;">Directory Update</h2>
    
    @if (Session::has('message'))
        <li style="font-size:20px;">{!! session('message') !!}</li>
   @endif
   <br><br>
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>City</th>
                    <th>Branch Name</th>
                    <th>Store Address</th>
                    <th>Store Number</th>
                    <th>Store Business Hour</th>
                    <th>Store Type</th>
                    <th>Store Image</th>
                    <th>Store Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($store_table as $get_value)
                    <tr>
                        <td>{{$get_value->city}}</td>
                        <td>
                        {{
                            str_limit($get_value->branch_name, $limit = 5, $end = '...')
                        }}
                        </td>
                        <td>
                        {{
                            str_limit($get_value->store_address, $limit = 15, $end = '...')
                        }}
                        </td>
                        <td>
                        {{
                            str_limit($get_value->store_contactnumber, $limit = 15, $end = '...')
                        }}
                        </td>
                        <td>
                        {{
                            str_limit($get_value->store_businesshour, $limit = 8, $end = '...')
                        }}
                        </td>
                        <td>
                        {{
                            str_limit($get_value->store_type, $limit = 15, $end = '...')
                        }}
                        </td>
                        <td>{{$get_value->image}}</td>
                        <td>{{$get_value->store_status}}</td>
                        <td>
                            <a href="{{ url('get_update_store',$get_value->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i>
                            </a>
                            <br><br>
                            <form action="/inactive_store" method="get">
                            <a href="{{ url('inactive_store',$get_value->id) }}" class="btn btn-warning" >Inactive <i class="far fa-eye-slash"></i></a>
                            </form>
                            <br>
                            <form action="/delete_store" method="get">
                                <a href="{{ url('delete_store',$get_value->id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
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