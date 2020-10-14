@extends('frontend::mobile.includes.default')
@section('title', 'Beangasm | Home')
@section('content')

<!-- Main Content -->
<main>

  <div class="row align-items-center justify-content-center mx-0" style="min-height: 90vh;">
    <div class="col-12">
      <form class="modal-body" method="POST" action="{{ route('post-buyer-login') }}">
        <a href="{{ route('/') }}" class="d-block text-center mb-2"><img class="text-center" src="{{url('assets/frontend/img/logo-v2.png')}}" width="100px" height="100px" /></a>
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <small>Masukan username atau email</small>
        <input type="text" name="login_username" class="form-control mb-0" />
        <small>Masukan password</small>
        <input type="password" name="login_password" class="form-control mb-2" />
        <input type="submit" class="btn primary text-white d-block w-100" value="Sign In">
      </form>
      <div class="modal-footer">
        <small>Belum punya akun beangasm ? <a href="{{ route('signup-user') }}" class="text-primary">daftar disini</a></small>
      </div>
    </div>
  </div>
  
</main>
<!-- /Main Content -->
@endsection