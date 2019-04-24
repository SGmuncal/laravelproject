@extends('layouts.adminnavbar')

@section('admin_content')

<div class="jumbotron" style="background-color: white;">
  <div class="container">
  
     <div class="row">
         <div class="col-md-6">
           <h2 style="font-weight: 400;">Store Account List</h2>
           <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-small" id="hoverButton" data-toggle="modal" data-target="#storeModal">
              Add User
            </button>
         </div>
     </div>
      
   
  <br>
    @if (Session::has('message'))
        <li style="font-size:20px;">{!! session('message') !!}</li>
   @endif
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr style="font-size: 14px;">
                    <th>Store Manager Name</th>
                    <th>Store Email</th>
                    <th>Store Name</th>
                    <th>Province</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $get_list)
                    <tr style="font-size: 14px;">

                        <td>{{$get_list->name}}</td>
                        <td>{{$get_list->email}}</td>
                        <td>{{$get_list->store_name}}</td>
                        <td>{{$get_list->manager_location_assign}}</td>
                        
                        <td>{{$get_list->created_at}}</td>
                        <td>{{$get_list->status}}</td>
                        <td>
                            <a href="{{ url('get_update_user',$get_list->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                            <br><br>
                            <form action="/inactive_user" method="get">
                            <a href="{{ url('inactive_user',$get_list->id) }}" class="btn btn-warning">Inactive <i class="far fa-eye-slash"></i></a>
                            </form>
                            <br>
                            <form action="/delete_user" method="get">
                                <a href="{{ url('delete_user',$get_list->id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
                            </form>
                        </td>
                    
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Register</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="/store_registered" method="post">
      <div class="modal-body">
            
                @csrf
                <input type="text" name="user_name" required="" placeholder="Store Manager Name" class="form-control">
                <br>

                <input type="number" name="store_name" required="" placeholder="Store Name" class="form-control">
                <br>

                <input type="email" name="user_email" required=""  placeholder="Store Email" class="form-control">
                <br>

                <input type="password" name="user_password" required="" placeholder="Store Password" class="form-control">
                <br>

                <input type="text" name="store_postal" required="" placeholder="Store Postal" class="form-control">
                <br>
          
                <select class="form-control" id="manager_assign" name="manager_assign">
                    <option selected="" value="" disabled="">Choose Province</option>
                    <option value="Winnipeg">Winnipeg</option>
                    <option value="Edmonton">Edmonton</option>                             
                    <option value="Calgary">Calgary</option>
                </select>

                  <br>
          
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"   data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="hoverButton">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>

@endsection