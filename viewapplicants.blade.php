@if(Auth::user()->role == '1')
<script type="text/javascript">
     window.location = "{{ url('/hiflyerdashboard') }}";
</script>
@endif

@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white;">
  <div class="container">
  <h2 style="font-weight: 400;">Employee Application Status</h2>
  <br><br>

  <div class="table-responsive">
  <table id="tables" class="table table-striped table-bordered">
        <thead>
            <tr style="font-size:14px;">
              <th>Status</th>
              <th>Position</th>
              <th>Email</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Middle Name</th>
              <th>Relocate</th>
              <th>Starting Date</th>
              <th>Phone Number</th>
              <th>File</th>
              <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userapplication as $userdata)
          <tr style="font-size:14px;">  
                <td>{{$userdata->Status}}</td>
                <td>{{$userdata->position_name}}</td>
                <td>{{$userdata->email}}</td>
                <td>{{$userdata->firstname}}</td>
                <td>{{$userdata->lastname}}</td>
                <td>{{$userdata->middlename}}</td>
                <td>{{$userdata->relocate}}</td>
                <td>{{$userdata->starting_date}}</td>
                <td>{{$userdata->phonenumber}}</td>
                <td><a href="{{url('/storage/'.$userdata->file_img_name.'')}}" id="hoverButton2" class="btn btn-primary form-control"><i class="fas fa-download" ></i></a></td>
  
                <td><a href="{{ url('viewapplication',$userdata->id) }}" id="hoverButton" class="btn btn-primary form-control"><i class="fab fa-readme" ></i></a></td>
              </tr>
        @endforeach   
        </tbody>
    </table>
  </div>
</div>
</div>
@endsection