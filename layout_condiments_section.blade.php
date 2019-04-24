@extends('layouts.adminnavbar')

@section('admin_content')



	<div class="jumbotron" style="background-image: url('./Images/group-ConvertImage.jpg'); height:200px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat;"></div>
	<div class="row">
		<div class="col-md-9">
			<h2>Condiments Section</h2>
		</div>
		<div class="col-md-3">
			<a href="" class="btn btn-primary form-control" id="hoverButton" data-toggle="modal" data-target="#callCondimentSection">Create Group Menu <i class="far fa-edit"></i></a>
		</div>
	</div>
	<br>
  	<div class="jumbotron" style="background-color:white; font-size:14px;">
  		<div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table" id="tables" style="overflow-x: scroll;">
          <thead>
            <tr>
              <th>Id</th>
              <th>Condiments Section Name</th>
              <th>Condiments Section Description</th>
              <th>Action</th>
            </tr>
          </thead>
          	<tbody>
	         	@foreach($condiment_section_table as $condiment_section)
	         		<tr>
	         			<td>{{$condiment_section->condiments_section_id}}</td>
	         			<td>{{$condiment_section->condiment_section_name}}</td>
	         			<td>{{$condiment_section->condiment_section_desc}}</td>
	         			<td>
                           <button class="btn btn-primary" id="condiment_section_editBtn" value="{{$condiment_section->condiments_section_id}}">Edit <i class="far fa-edit"></i></button>
                            <br>
                         	<br>
      
                            <button  class="btn btn-danger" id="condiment_section_deleteBtn" value="{{$condiment_section->condiments_section_id}}">Delete <i class="far fa-trash-alt"></i></button>
                        </td>
	         		</tr>
	         	@endforeach
            </tbody>
        </table>
      </div>
    </div>
  	</div>
  </div>


<form action=""  method="post" enctype="multipart/form-data">
	<div class="modal fade" id="callCondimentSection" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
	        <h5 class="modal-title" id="exampleModalLongTitle">Condiments Section</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    	
		    		<div class="row">
						<div class="col-md-6">
							<label>Condiment Section Name</label>
							<input placeholder="K DIPS"  value="" class="form-control" id="codiment_section_name" type="text" class="validate">
						</div>
						<div class="col-md-6">
						  <label>Condiment Section Desc</label>
					      <textarea class="form-control form-control" value="" id="condiment_section_desc"></textarea>
					    </div>
					</div>
		    	
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="save_condiment_section_button">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>







<form action=""  method="post" enctype="multipart/form-data">
	<div class="modal fade" id="editModalcondiment_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">New Menu Section</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	     	
		      <div class="modal-body">
		    		<input type="hidden" id="hidden_condiment_sec_id" value="" name="">
		    		<div class="row">
						<div class="col-md-6">
							<label>Condiment Section Name</label>
							<input placeholder="K DIPS"  value="" class="form-control" id="edit_codiment_section_name" type="text" class="validate">
						</div>
						<div class="col-md-6">
						  <label>Condiment Section Desc</label>
					      <textarea class="form-control"  value="" id="edit_condiment_section_desc"></textarea>
					    </div>
					</div>
		    	
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-primary" id="update_condiment_section_button">Submit</button>
		      </div>
		    
	    </div>
	  </div>
	</div>
</form>





<br><br><br><br>
@endsection

