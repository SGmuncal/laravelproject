@extends('layouts.navbar')

@section('content')
<div class="background-header">
    <div id="background-content">
        <h2 class="center white-text">Contact Us</h2>
    </div>
</div>
<br><br><br><br>

<div class="container">
  <div class="row">
    <div class="col-md-7">
         <br>
         <div class="row">
           <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
            <div class="input-group col-md-6">
              <select name="subject" class="custom-select" required="" id="contact_subject_option">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="Inquiry">Inquiry</option>
                  <option value="Feedback">Feedback</option>
                  <option value="Comments">Comments</option>
                  <option value="Suggestions">Suggestions</option>
                  <option value="Complaint">Complaint</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <input type="date" name="datetransaction" min="1000-01-01"
                  max="3000-12-31" class="form-control" title="Date Transaction" id="contact_transaction_date">
            </div>
         </div>
         
         <div class="row">
           <div class="input-field col-md-6">
                <input placeholder="First Name" id="contact_first_name" type="text" name="fname"  class="validate form-control" required="" aria-required="true">
            </div>
            <br>
            <div class="input-field col-md-6">
              <input placeholder="Last Name" id="contact_lname" type="text" name="lname"  class="validate form-control" required="" aria-required="true">
              
            </div>
         </div>

         <br>

         <div class="row">
            <div class="input-field col-md-6">
              <input placeholder="Contact No/s" id="contact_contact_number" type="text" name="cnumber" class="validate form-control" required="" aria-required="true">
              
            </div>
            <br>
            <div class="input-field col-md-6">
              <input placeholder="Email Address" name="email" id="contact_email_address" name="email" type="email"  class="validate form-control" required="" aria-required="true">
              
            </div>
          </div>
        <br>

        <div class="row">
            <div class="input-field col-md-6">
              <input placeholder="Store Number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "4" name="storenum" id="contact_store_number"   class="validate form-control" required="" aria-required="true">
              
            </div>
            <br>
            <div class="input-field col-md-6">
              <input placeholder="Transaction Number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "4"  type="number" name="transactionnumber" id="contact_transaction_number"  class="validate form-control" required="" aria-required="true">
              
            </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group col-md-12">
            <textarea class="form-control" name="content_article" rows="5" id="contact_content_article" required="" placeholder="Message"></textarea>
          </div>

        </div>

        <div class="row">
          <div class="input-field col-md-6">
            <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LeSDW8UAAAAAB5rrfbBsYx7Sa65-6sL9TC_-mMb"></div>
          </div>

          <div class="input-field col-md-6">
            <button class="btn btn-outline-primary form-control" id="submit_contact_form"  type="submit" value="Send" style="position:relative; top:37px;" disabled="">Submit</button>
          </div>
          
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
      <br><br>
      <h2>Information:</h2>
      <br><br>
      <h5>Home Office:</h5>
      <p>908 53 Avenue NE, Suite I, Calgary AB T2E 6N9
T: 1-403-230-0297 ext 108</p>
    </div>
  </div>
</div>
  
@endsection
