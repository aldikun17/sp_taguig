@extends('web.sub')
@section('title','Login Page')
@section('login')

@if(Session('logout_success'))

<div class="alert alert-success alert-dismissible" role="alert" >

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    <center><strong><p> {{Session('logout_success')}} </p></strong></center>

</div>

@endif

@if(Session('login_error'))

<div class="alert alert-danger alert-dismissible" role="alert">

  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    <center><strong><p> {{Session('login_error')}} </p></strong></center>
    
</div>

@endif

@if(Session('error_login'))

<div class="alert alert-danger alert-dismissible" role="alert">

  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    <center><strong><p> {{Session('login_error')}} </p></strong></center>
    
</div>

@endif

<form action="{{url('login/auth')}}" method="POST" class="form-horizontal">

  {{csrf_field()}}

  <div class="form-group {{$errors->has('email') ? 'has-error' : '' }}">

    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

    <div class="col-sm-10">

      <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email">


      	@if($errors->has('email'))

	      <span class="help-block">
	      	
	      	<strong>{{$errors->first('email')}}</strong>

	      </span>

	    @endif

    </div>

  </div>

  <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">

    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

    <div class="col-sm-10">

      <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">

      @if($errors->has('password'))

      	<span class="help-block">
      		
      		<strong> {{$errors->first('password')}} </strong>

      	</span>

      @endif

    </div>

  </div>

  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-10">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>

@endsection