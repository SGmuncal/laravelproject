@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron" style="background-color:white;">
	<div class="container">
	<h2 style="font-weight: 400;">Mail</h2>

	<div style="overflow-y: scroll; height:400px;">

		@foreach($mailfrom as $mailfromuser)@endforeach
		<form action="/markread/{{$mailfromuser->id}}" method="post">
        	<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

        	
        	@if($mailfromuser->status == "Unread")
        	  {{-- <i class="fab fa-readme" style="color:#6a11cb;"></i> <input name="update"  class="btn btn-outline-primary " type="submit" value="mark as read" id="button-update">  --}}
        	  <button name="update"  class="btn btn-primary " type="submit" value="mark as read" id="button-update">
			    <i class="fab fa-readme"></i> Mark As Read
			</button>
			@if($mailfromuser->status == "Deleted")
        	@else
        		{{-- <i class="fas fa-trash" style="color:#6a11cb;"></i> <input name="delete" class="btn btn-outline-primary" type="submit" value="delete" id="button-update"> --}}
				<button name="delete" class="btn btn-outline-danger" type="submit" value="delete" id="button-update">
				    <i class="fas fa-trash"></i> Delete
				</button>
        	@endif
        	&nbsp;
        	@else
        	   
        	@endif
    	</form>

    	<br><br>
	   	<div style="line-height:12px; ">
		   	<p>From: <b>{{$mailfromuser->email}}</b></p>
		   	<p>Contact #: <b>{{$mailfromuser->contact}}</b></p>
			<p>Subject: <b>{{$mailfromuser->subject}}</b></p>
			<p>Store #: <b>{{$mailfromuser->store_number}}</b></p>
			<p>Transaction #: <b>{{$mailfromuser->transaction_number}}</b></p>
			<p>Transaction Date: <b>{{$mailfromuser->transaction_date}}</b></p>
			<p>Date Send: <b>{{$mailfromuser->created_at}}</b></p>
		</div>

		<br>
		<b>Message:</b> <br>

		<text>
			{{$mailfromuser->message}}
		</text>
		

		
	</div>
</div>

</div>
<br><br><br><br>
@endsection