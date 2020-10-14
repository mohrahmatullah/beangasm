<form class="modal-body" method="POST" action="">
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<small>Masukan username atau email</small>
	<input type="text" name="login_username" class="form-control mb-2" />
	<small>Masukan password</small>
	<input type="password" name="login_password" class="form-control mb-2" />
	<input type="submit" class="btn primary text-white d-block w-100" value="Login">
</form>