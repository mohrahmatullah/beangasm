@extends('frontend::mobile.includes.default')
@section('title', 'Beangasm | Home')
@section('content')

<!-- Main Content -->
<main>

  <div class="row align-items-center justify-content-center mx-0" style="min-height: 90vh;">
    <div class="col-12">
      <form class="modal-body" method="POST" action="">
        <a href="{{ route('/') }}" class="d-block text-center mb-2"><img class="text-center" src="{{url('assets/frontend/img/logo-v2.png')}}" width="100px" height="100px" /></a>
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <small>Display Name</small>
        <input type="text" name="register_name" class="form-control mb-0" />
        <small>Username</small>
        <input type="text" name="register_username" class="form-control mb-0" />
        <small>Email</small>
        <input type="text" name="register_email" class="form-control mb-0" />
        <small>Password</small>
        <input type="password" name="register_password" class="form-control mb-0" />
        <small>Confirm Password</small>
        <input type="password" name="register_confirm_password" class="form-control mb-2" />
        <input type="submit" class="btn primary text-white d-block w-100" value="Sign Up">
      </form>
      <div class="modal-footer">
        <small>Sudah punya akun beangasm ? <a href="{{ route('login-user') }}" class="text-primary">login disini</a></small>
      </div>
    </div>
  </div>
  
</main>
<!-- /Main Content -->
@endsection