@extends('layouts.auth')

@section('title')
Reset Password
@endsection
@section('content')
<form action="{{ route('reset.password.post') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group ">
        <label for="email_address">E-Mail Address</label>
       
            <input type="text" id="email_address" class="form-control" name="email"autofocus>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif

    </div>

    <div class="form-group ">
        <label for="password" >Password</label>
   
            <input type="password" id="password" class="form-control" name="password" required autofocus>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif

    </div>

    <div class="form-group ">
        <label for="password-confirm" >Confirm Password</label>
     
            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
      
    </div>

    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-success btn-lg btn-icon icon-right" tabindex="4">
            Reset Password
        </button>
    </div>
</form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection