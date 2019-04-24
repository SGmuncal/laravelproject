@extends('layouts.adminnavbar')

@section('admin_content')



	<div class="jumbotron" style="background-image: url('./Images/condiments.jpg'); height:200px; background-size: 100% 100%; background-attachment: fixed; background-repeat: no-repeat;"></div>
	<div class="row">

		<div class="col-md-9">
			<h3>Chaining Group</h3>
		</div>
		<div class="col-md-3">
			<button href="" class="btn btn-primary form-control" id="createChainingbtn">Create Chaining  <i class="far fa-edit"></i></button>
		</div>
	</div>
	<br>
  	<div class="jumbotron" style="background-color:white; font-size: 14px;">
  		<div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table" id="tables" style="overflow-x: scroll;">
          <thead>
            <tr style="font-size:15px;">
              <th>Id</th>
              <th>Chain Name</th>
              <th>Action</th>
            </tr>
          </thead>
          	<tbody>
          		@foreach($chain_table as $chain)
          			<tr style="font-size:14px;">
          				<td>{{$chain->menu_builder_properties_id}}</td>
          				<td>{{$chain->chain_name}}</td>
          				<td>
          					<button class="btn btn-primary" id="chain_editBtn" value="{{$chain->noun_builder_id}}">Edit <i class="far fa-edit"></i></button>
                            <br>
                         	<br>
      
                            <button  class="btn btn-danger data-attribute-menu_builder-details" id="condiment_deleteBtnLayout" data-attribute-menu_builder-details="{{$chain->menu_builder_properties_id}}" value="{{$chain->noun_builder_id}}">Delete <i class="far fa-trash-alt"></i></button>
          				</td>
          			</tr>
          		@endforeach
            </tbody>
        </table>
      </div>
    </div>
  	</div>
  </div>



<div class="modal fade" id="chainingBuilderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	  <div class="modal-dialog modal-lg role="document" style="float:right; height:700px; width:490px; ">
	    <div class="modal-content">
		      <div class="modal-header" style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
		      	<h5 class="modal-title noun_build_item" id="exampleModalLongTitle"></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="" id="closeAddingChaining">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
	     	
		      <div class="modal-body">
		    	
		    	<div class="container">
		    		<div class="header" style="text-align: center;">
		    			<br>
		    			<h3 style="color:#007BFF;">Build Your Chain Button</h3>	
		    			<label>This button will be served as customers menu.</label><br>
		    			<i class="fab fa-creative-commons-remix" style="font-size:70px;"></i>
		    			<br><br>
		    			
		    			<input type="hidden" value="" class="hidden_noun_id" name="">
		    			<table class="table table-hover" id="chainingBuild">
		    				<thead>
					            <tr style="font-size: 15px;">
					                <th scope="col">Qty</th>
					                <th scope="col">Condiments</th>
					                <th scope="col">Price</th>
					                <th scope="col">Allow to open condiments</th>
					            </tr>
					        </thead>
					        <tbody style="font-size:14px;">	        		
				        		
					        </tbody>
		    			</table>
		    		</div>
		    	</div>
		    		
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="build_success_insert" disabled="">Build Done</button>
		      </div>
	    </div>
	  </div>
	</div>
</form>




<div class="modal fade" id="nounBuilderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg role="document" style="float:left;  width:800px;">
    <div class="modal-content">
     	<div class="modal-header" style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
	        <h5 class="modal-title" id="exampleModalLongTitle">Attach Chain Noun <i class="fas fa-mouse-pointer" style="font-size:15px;"></i></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeNounModal">
	          <span aria-hidden="true">&times;</span>
	        </button>
    	</div>
 	
  		<div class="modal-body">
  			<div class="container">
  				
  					
				<table  class="table table-striped table-bordered first_render" style="width:100%">
					<div class="content-noun" style="text-align: center;">
				<thead style="">
		            <tr style="font-size:16px;">
		              <th>Noun Screen Name</th>
		              <th>Noun Price</th>
		              <th>Noun Image</th>
		              <th style="display:none;"></th>
		            </tr>
	            </thead>
	            	</div>
	            <tbody>
		         	@foreach($noun_table as $noun_data)
		         		<tr id="nounClicked">
		         			<td class="nounScreenNameClicked">{{$noun_data->menu_cat_screen_name}}</td>
		         			<td>{{$noun_data->menu_cat_price}}</td>
		         			<td><img src="{{url('/storage/'.$noun_data->menu_cat_image.'')}}" style="height:110px; width:140px;" class="img-fluid"></td>
		         			<td class="nounScreenID" style="display:none;">{{$noun_data->menu_cat_id}}</td>

		         		</tr>	
		         	@endforeach
	            </tbody>
				</table>
  					
  				<br>
  				<div class="stepper" style="text-align: center;">
  					<button class="btn btn-primary" type="button" id="show_condimentsModalChain">Add Condiments <i class="fas fa-angle-right"></i></button>
  				</div>
  			</div>
        </div>

    </div>
  </div>
</div>




<div class="modal fade" id="condimentsBuilderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg role="document" style="float:left;  width:800px;">
    <div class="modal-content">
        <div class="modal-header"  style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
	        <h5 class="modal-title" id="exampleModalLongTitle" style="color:white; font-weight: bold;">Attach Chain Condiments <i class="fas fa-mouse-pointer" style="font-size:15px;"></i></h5>

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCondiModal" style="">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>
     	
        <div class="modal-body">

    		<div class="container">


				<table  class="table table-striped table-bordered second_render" id="table_chaining_condiments" style="width:100%">
					<div class="content-noun" style="text-align: center;">
					<thead>
			            <tr style="font-size:18px;">
			             	<th>Condiment Screen Name</th>
				             <th>Condiment Price</th>
				             <th>Condiment Image</th>
				             <th style="display: none;"></th>
			            </tr>
		            </thead>
	            	</div>
		            <tbody class="remove_after_clicked_condiments">
			         	@foreach($condiments_table as $condiments_data) 
			         		<tr class="condimentsClicked">
			         			<td class="condimentsScreenNameClicked">{{$condiments_data->cat_condi_screen_name}}</td>
			         			<td class="condimentsScreenPriced">{{$condiments_data->cat_condi_price}}</td>
			         			@if($condiments_data->cat_condi_image == '')
			         			<td></td>
			         			@else
			         			<td><img src="{{url('/storage/'.$condiments_data->cat_condi_image.'')}}" style="height:120px; width:150px;" class="img-fluid"></td>
			         			@endif
			         			<td class="condiments_section_id" style="display: none;">{{$condiments_data->condiments_section_id}}</td>
			         		</tr>
			         	@endforeach
		            </tbody>
				</table>
  					
  				
  				<div class="stepper" style="text-align: center;">
  					<button class="btn btn-primary" type="button" id="show_nounModalChain">Add Noun <i class="fas fa-angle-right"></i></button>
  					
  				</div>

			 
		        	  
    		</div>
      	</div>
    </div>
  </div>
</div>



<!-- -->

<div class="modal fade" id="EditchainingBuilderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	  <div class="modal-dialog modal-lg role="document" style="float:right; height:700px; width:490px; ">
	    <div class="modal-content">
		      <div class="modal-header" style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
		      	<h5 class="modal-title edit_noun_build_item" id="exampleModalLongTitle" style="color:white;"></h5>
		        <button type="button" class="close" id="closeBuildChainUpdate" data-dismiss="modal" aria-label="Close" style="">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
	     	
		      <div class="modal-body">
		    	
		    	<div class="container">
		    		<div class="header" style="text-align: center;">
		    			<br>
		    			<h3>Build Your Chain Button</h3>	
		    			<label>This button will be served as customers menu.</label><br>
		    			<i class="fab fa-creative-commons-remix" style="font-size:70px;"></i>
		    			<br><br>
		    			
		    			<input type="hidden" value="" class="edit_hidden_noun_id" name="">
		    			<table class="table table-hover" id="edit_chainingBuild">
		    				<thead>
					            <tr style="font-size: 15px;">
					                <th scope="col">Qty</th>
					                <th scope="col">Condiments</th>
					                <th scope="col">Price</th>
					                <th scope="col">Allow to open condiments</th>
					            </tr>
					        </thead>
					        <tbody style="font-size:14px;">	        		
				        		
					        </tbody>
		    			</table>
		    		</div>
		    	</div>
		    		
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="edit_build_success_insert btn btn-primary" id="hoverButton">Build Done</button>
		      </div>
	    </div>
	  </div>
	</div>
</form>

<div id="closeModalCondiments">
<div class="modal fade" id="EditcondimentsBuilderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg role="document" style="float:left;  width:800px;">
    <div class="modal-content">
        <div class="modal-header" style="background: linear-gradient(-30deg, #00e4d0, #5983e8); color:white;">
	        <h5 class="modal-title" id="exampleModalLongTitle" style="color:white; font-weight: bold;">Attach Chain Condiments <i class="fas fa-mouse-pointer" style="font-size:15px;"></i></h5>

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeeditCondiModal" style="">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>
     	
        <div class="modal-body">

    		<div class="container">

				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<div class="input-group">
						  <span class="input-group-prepend">
						    <div class="input-group-text bg-transparent border-right-0">
						      <i class="fa fa-search" style="color:#007BFF;"></i>
						    </div>
						  </span>
						  <input class="form-control py-2 border-left-0 border" type="search" value="Search Condiments" id="search_attach_condiments" />
						  <span class="input-group-append">

						  </span>
						</div>
					</div>
				</div>
				<br>
				<table  class="table table-striped table-bordered " id="edit_table_chaining_condiments" style="width:100%">
					<div class="content-noun" style="text-align: center;">
					<thead>
			            <tr style="font-size:15px;">
			            	<th>Condiments Section</th>
			             	<th>Condiment Screen Name</th>
				             <th>Condiment Price</th>
				             <th>Condiment Image</th>
			            </tr>
		            </thead>
		            	</div>
		            <tbody>
			         	<!-- @foreach($condiments_table as $condiments_data) 
			         		<tr class="edit_condimentsClicked">
			         			<td class="edit_condimentsScreenNameClicked">{{$condiments_data->cat_condi_screen_name}}</td>
			         			<td class="edit_condimentsScreenPriced">{{$condiments_data->cat_condi_price}}</td>
			         			@if($condiments_data->cat_condi_image == '')
			         			<td></td>
			         			@else
			         			<td><img src="{{url('/storage/'.$condiments_data->cat_condi_image.'')}}" style="height:120px; width:150px;" class="img-fluid"></td>
			         			@endif
			         		</tr>
			         	@endforeach -->
		            </tbody>
				</table>
  					
  				
  				<div class="stepper" style="text-align: left;">
  					<button class="btn btn-primary" type="button" id="show_nounModalChain">Add Noun <i class="fas fa-angle-right"></i></button>
  					
  				</div>

			 
		        	  
    		</div>
      	</div>
    </div>
  </div>
</div>
</div>
<input type="hidden" name="" class="id_to_update_chain" value="">

<br><br><br><br>
@endsection

