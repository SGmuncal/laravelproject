@extends('layouts.adminnavbar')

@section('admin_content')

<!-- <div class="container-fluid">
	<div class="row">
        <div class="col-md-10">
            <h3>Driver Account List</h3>
        </div>
        <div class="col-md-2">
            
        </div>
    </div>
    <br>
</div> -->

<br><br>


<div class="jumbotron" style="background-color:white;">
    <div class="row">
            <div class="col-md-10">
                 <h4>In Active Drivers</h4>
             </div>
             <div class="col-md-2">
                 <button class="form-control btn btn-primary" id="addDriver" data-toggle="modal" data-target="#driverModal">Add Driver <i class="fas fa-motorcycle"></i></button>
             </div>
        <div class="col-md-12">
             
            <br>
            
                
                <div class="table-responsive">
                    <table id="drivertable" class="table table-striped dt-responsive nowrap" style="width:100%; font-size: 14px;">
                        <thead style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white;">
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Contact Number</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($drivers as $driver)
                              @if($driver->driver_status == 'Offline')
                                <tr id="driverClicked">
                                    

                                    <td>
     
                                        <center><span class="badge badge-pill badge-danger">{{$driver->driver_status}}</span></center>
                                        
                                    </td>
                                    <td class="driver_name">
                                        {{$driver->driver_name}}
                                    </td>
                                    <td class="driver_email">
                                        {{$driver->driver_email}}
                                    </td>
                                    <td class="driver_number">
                                        {{$driver->driver_number}}
                                    </td>
                                    
                                    <td width="25">
                                        <button id="assigndriverButton"  class="form-control btn btn-primary" value="{{$driver->driver_id}}"><i class="fas fa-angle-double-right"{{--  data-toggle="modal" data-target="#driverAssignOrderModal" --}}></i></button>
                                    </td>
                                    

                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
             <br><br>
             <h4>Active Drivers</h4>

               <br>
               
                <div class="table-responsive">
                    <table id="driversLineupTable" class="table table-hover" style="font-size:14px;">
                            <thead style="background: linear-gradient(-25deg, #00e4d0, #5983e8); color:white; font-size:13px;">
                                <tr> 
                                <th scope="col">Status</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact Number</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
            
                                @foreach($drivers as $driver)
                                    <tr id="driverClicked">
                                        @if($driver->driver_status == 'Available')
                                        <td>
         
                                            <center><span class="badge badge-pill badge-primary">{{$driver->driver_status}}</span></center>
                                            
                                        </td>
                                        <td class="driver_name">
                                            {{$driver->driver_firstname}} &nbsp;{{$driver->driver_lastname}}
                                        </td>
                                        <td class="driver_email">
                                            {{$driver->driver_email}}
                                        </td>
                                        <td class="driver_number">
                                            {{$driver->driver_number}}
                                        </td>
                                        
                                        <td width="25">
                                            <button class="form-control btn btn-danger" id="lineupdriverButton" value="{{$driver->driver_id}}"><i class="fas fa-user-times"></i></button>
                                        </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>




<form action=""  method="post" enctype="multipart/form-data">
    <div class="modal fade" id="driverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <br>
                     
                     <div class="row">
                        <div class="col-md-10"><h3 style="color:#3204ad">Basic Details</h3></div>
                        <div class="col-md-2"><button type="button" class="btn btn-primary" id="registerDriverButton">Save Changes</button></div>
                     </div>
                     <hr>
                     
                     <div class="row">
                         <div class="col-md-6">
                            <label>First Name</label>
                             <input type="text" name="driver_name" id="driver_firstname" required="" placeholder="First Name" class="form-control">
                             
                         </div>
                         <div class="col-md-6">
                            <label>Last Name</label>
                             <input type="text" name="driver_lastname" id="Lykax" required="" placeholder="Last Name" class="form-control">
                             
                         </div>
                        
                     </div>
                     <br><br>
                     <div class="row">
                          <div class="col-md-6">
                            <label>Email</label>
                             <input type="email" name="driver_email" id="driver_email" required="" placeholder="Carin@gmail.com" class="form-control">
                         </div>
                         <div class="col-md-6">
                            <label>Contact Number</label>
                             <input type="number" name="driver_number" id="driver_number" axlength="11"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="customer_number" required="" value="" placeholder="Driver Contact" class="form-control">
                         </div>
                     </div>
                </div>
                <br><br>
            </div>
        </div>
      </div>
    </div>
</form>



<form action=""  method="post" enctype="multipart/form-data">
    <div class="modal fade" id="driverAssignOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeDriverAssign">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
                <div class="modal-body">
                    <center>
                        <div class="find_driver">
                            <img src="{{asset('/Images/Ripple.gif')}}" class="img-fluid" alt="" id="">
                            {{-- <div class="container"><h3>Wait for <span id="countdowntimer">5</span> seconds to gather data of driver.</h3></div> --}}
                            <h4>Wait for <span id="count">10</span> seconds to gather data of driver.</h4>
                        </div>
                        <div class="driver_info">
                            <input type="hidden" name="" id="driver_details" value="">
                            <br>
                            <h2>Yay,we found you a driver!</h2>
                            <h3>Lawrence</h3>
                            <p>Store of 1790</p>
                            <div style="color:yellow;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <img src="{{asset('/Images/kfc-rider.png')}}" height="30" class="img-fluid" alt="" id="">
                            <button type="button" class="btn btn-primary" id="registerDriverButton" style="background: linear-gradient(-25deg, #00e4d0, #5983e8); border-color:transparent; height:50px;">Add to line up</button>
                        </div>
                    </center>
                </div>
            

              <div class="modal-footer">
                
              </div>
            
        </div>
      </div>
    </div>
</form>


<br><br><br><br>
@endsection