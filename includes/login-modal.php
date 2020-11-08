<?php 


	if(isset($_POST['prijava']))
	{
		if(empty($_POST['email']))
			Alert("Greska !", "Upisi email majku ti jebem.", 1);
		else if(empty($_POST['password']))
			Alert("Greska !", "Upisi sifru majku ti jebem.", 1);
		else
			$account->Login($_POST['email'],  $_POST['password']);

	}


?>

<div id="search-modal" style="display: none; ">
<div class="modal-dialog modal-dialog-centered">
    <div class="login-modal modal-content">
    <a href="#" id="close-search" onclick="closeSearch()"><i class="fa fa-times" aria-hidden="true"></i></a>
       <form class="form-signin py-5" method="POST" >
			<div class="form-label-group">
				<input class="w-100" type="text" name="email" id="email" placeholder="e-mail adresa">
			</div>
			<div class="form-label-group py-3">
				<input class="w-100" type="password" name="password" id="password" placeholder="šifra korisnička">
			</div>
			<div class="custom-control custom-checkbox mb-3">
				<input type="checkbox" class="custom-control-input" id="customCheck1">
				<label class="custom-control-label text-white" for="customCheck1">Zapamti me</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="prijava" >Prijavi Se</button>
			<h4 class="font-weight-light py-3">Nemas racun ? <a class="register-one" href="register"> Registruj se</a></h4>
		</form>
    </div>
</div>