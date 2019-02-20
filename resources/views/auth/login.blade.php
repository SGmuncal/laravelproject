@extends('layouts.navbar')

@section('content')
<br><br><br><br>
<div class="container">
    <br><br>
    <center>
        <h2 style="font-weight: bold;">Welcome back, Order Now</h2>
        <h5>To keep connected kindly enter the login details in the below fields.</h5>
    </center>
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

  

                        <div class="col-md-12">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    

                        <br>
                           

                        <div class="col-md-12">
                             <label for="password" class="">{{ __('Password') }}</label>
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
                               
                                <a class="btn btn-link" href="/register">
                                    Register?
                                </a>
                              
                            </div>
                        </center>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection