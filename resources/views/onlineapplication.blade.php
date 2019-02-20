@extends('layouts.navbar')

@section('content')
<div class="background-header">
    <div id="background-content">
        <h2 class="center white-text">Online Application</h2>
    </div>
</div>
<div class="wrap-career">
  <div class="container">
      <br><br>
      <h4>Personal Info</h4>
      <br><br>
      <div class="row">
        <div class="input-field col m6 l6 s12">
          <input placeholder="First Name *" id="online_app_firstname" type="text" name="fname"  class="validate form-control" required="" aria-required="true">

        </div>
        <br><br>
        <div class="input-field col m6 l6 s12"> 
          <input placeholder="Last Name *" id="online_app_lname" type="text" name="lname"  class="validate form-control" required="" aria-required="true">
        
        </div>
        <br><br>
      </div>

      <div class="row">
        <div class="input-field col m6 l6 s12">
          <input placeholder="Middle Name *" id="online_app_mname" type="text" name="mname"  class="validate form-control" required="" aria-required="true">
   
        </div>
        <br><br>
        <div class="input-field col m6 l6 s12">
          <input placeholder="Email Address *" id="online_app_email" name="email" id="first_name" name="email" type="email"  class="validate form-control" required="" aria-required="true">
     
        </div>

      </div>

      <div class="row">
        <div class="input-field col m6 l6 s12">
          <input placeholder="Home Number *" id="online_app_home_number" type="number" name="homenumber" class="validate form-control" required="" aria-required="true">
        
        </div>

        <br><br>
        <div class="input-field col m6 l6 s12">
          <input placeholder="Contact Number *" id="online_app_contact_number" type="number" name="cnumber" class="validate form-control" required="" aria-required="true">
   
        </div>
      </div>
  </div>

  <br><br>

  <div class="container">
    <h4>Employement Application</h4>
      <div class="row">
        <div class="input-field col-md-6">
          @foreach($getjob as $job)
          @endforeach
          <input type="hidden" name="position_type" id="online_app_position_type" value="{{$job->position_name}}">

          <br><br>
          <label for="first_name">Position Applying For</label>
          <input value="{{$job->position_name}}" readonly="" id="first_name" type="text" class="validate form-control" required="" aria-required="true">
        </div>
    </div>

    <br><br>
    <b style="font-weight:400;">1. What is your current employment status? </b>
    <br><br>
    <div class="form-check-inline">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input status_ads_Checkbox"  name="employmentstatus" value="Unemployed">Unemployed
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input status_ads_Checkbox" name="employmentstatus" value="Employed">Employed
      </label>
    </div>
    <div class="form-check-inline disabled">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input status_ads_Checkbox" name="employmentstatus" value="Self-Employed">Self-Employed
      </label>
    </div>
    <div class="form-check-inline disabled">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input status_ads_Checkbox" name="employmentstatus" value="Student">Student
      </label>
    </div>



    <br><br><br>
    <b style="font-weight:400;">2. Are you willing to relocate? </b>
    <br><br>
    <div class="form-check-inline">
      <label class="form-check-label">
        <input type="checkbox" name="relocate" class="form-check-input relocate_ads_Checkbox" value="Yes">Yes
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label">
        <input type="checkbox" name="relocate" class="form-check-input relocate_ads_Checkbox" value="No">No
      </label>
    </div>
    <br><br>
    <div class="row">
      <div class="input-field col-md-5">
        <label>3. When is your available start date?</label>
         <input type="date" name="startdate" min="1000-01-01"
                max="3000-12-31" class="form-control" id="online_app_start_date">
      </div>
    </div>
    <br><br>
    <label >4. Kindly attach a copy of your resume (PDF,docx files only).</label>
    <div class="input-group col-md-5">
      <div class="custom-file">
        <input type="file" name="file" accept=".doc, .docx,.ppt, .pptx,.txt,.pdf" class="custom-file-input" id="online_app_file">
        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
      </div>
    </div>

    <br><br>
    <button class="btn btn-outline-primary btn-large form-control col-md-5" id="online_application_btn"  type="submit">Send Application</button>
  </div>
</form>


@endsection

