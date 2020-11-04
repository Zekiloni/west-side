<?php 

	if($ucp_user->isLogged()) { $redir = $url."dashboard"; header("Location: $redir"); }
	if(isset($_POST['login']))
	{
		if(empty($_POST['username']))
			Alert("GRESKA !", "Niste uneli korisnicku adresu.", 1);
		else if(empty($_POST['password']))
			Alert("GRESKA !", "Niste uneli korisnicku sifru.", 1);
		else
			$ucp_user->Login($_POST['username'], $_POST['password']);
	}


?>
<!DOCTYPE html>
<html>
	<body class="bg_login">
		<section class="container py-5">
			<div class="row login_box">
				<div class="col-md-6" style="background: url('assets/images/kev.png');">
				<img class="img img-responsive" src="assets/images/logo.png">
					<div class="reg_text">
						<h2 class="font-weight-light">Don't have an account?</h2>
						<a href="home"><button class="button register-btn"><span> Register </span></button></a>
					</div>
				</div>
				<div class="col-md-3 mx-auto">
					<div class="card-signin my-5">
					  <div class="card-body">
						<h5 class="card-title text-center">Sign In</h5>
						<form class="form-signin" method="POST" >
						  <div class="form-label-group">
						  <label for="username">Username: </label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Type here">
						  </div>
						  <div class="form-label-group py-3">
							  <label for="password">Password: </label>
							  <input type="password" name="password" id="password" class="form-control" placeholder="Type here">
						  </div>
						  <div class="custom-control custom-checkbox mb-3">
							<input type="checkbox" class="custom-control-input" id="customCheck1">
							<label class="custom-control-label" for="customCheck1">Remember password</label>
						  </div>
						  <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login" >Sign in</button>
						</form>
						<a href="home"><button class="button"><span><i class="fa fa-home" aria-hidden="true"></i> Home </span></button></a>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
