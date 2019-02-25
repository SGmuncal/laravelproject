@extends('layouts.navbar')

@section('content')
<br><br><br><br>
<div class="container">
    
    <br>
    <div class="row">
        <div class="col-md-6">
            <img src="/Images/kfc-rider.png" style="width:550px;">
        </div>
        <div class="col-md-6">
            <center>
                <h3 style="font-weight: bold;">Welcome back, Login Your Account</h3>
                <h5>To keep connected kindly enter the login details in the below fields.</h5>
            </center>
            <br>
            <div class="card" style="height:400px;"> 
                <div class="card-header" style="background-color:#143DF6; color:white;">{{ __('Login') }}</div>
                <br>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

  

                        <div class="col-md-12">
                            <label for="email" style="font-weight: bold;">{{ __('E-Mail Address') }}:</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    

                        <br>
                           

                        <div class="col-md-12">
                             <label for="password" class="" style="font-weight: bold;">{{ __('Password') }}:</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <br>
                        
                        <center>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary form-control">
                                    {{ __('Login') }}
                                </button>

                                <br><br>
 
                              
                            </div>
                        </center>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection