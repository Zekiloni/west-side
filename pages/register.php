<?php 

	if($account->isLogged()) {	$redir = $url."home"; header("Location: $redir"); }

	if(isset($_POST['signup']))
	{
		if(empty($_POST['name']))
			Alert("ERROR !", "You must type your first name.", 1);
		else if(empty($_POST['password']))
			Alert("ERROR !", "You must type your last name.", 1);
		else if(empty($_POST['email']))
			Alert("ERROR !", "You must type your mail.", 1);
		else if(empty($_POST['confirm_password']))
			Alert("ERROR !", "You must type your confirm password.", 1);
		else if((strlen($_POST['password']) < 8))
			Alert("ERROR !", "Your password must be more than 8 characters.", 1);
			else if($_POST['password'] != $_POST['confirm_password'])
			Alert("ERROR !", "Passwords doesn't match.", 1);
		else
			$account->Register($_POST['name'], $_POST['password'], $_POST['email']);
	}


?>
<!DOCTYPE html>
<html>
	<body>
		<div class="container py-5">	
			<form method="POST" class="registration">
				<div class="title">
					<img class="logo" src="<?php echo $url; ?>assets/images/logo.png" class="img img-responsive" width="200">
				</div>			
				<input type="text" name="name" placeholder="Ime_Prezime">
				<input type="text" name="email" placeholder="E-Mail Adresa">
				<input type="text" name="password" placeholder="Korisnička šifra">
				<input type="text" name="confirm_password" placeholder="Ponovite korisničku šifru">
				<textarea name="ic_story" placeholder="IC Prica vaseg karaktera"></textarea>
				<div class="uslovi"> 
					<input type="checkbox" name="checkbox" value="check" id="agree" /> Pročitao sam i slažem se sa Uslovima i pravilima i Politikom privatnosti <br>
					<small>Registracijom prihvatate i dalje promene pravila i uslova. </small>
				</div>
				<br>
				<button type="submit">Registracija</button>
			</form>
		</div>
		<div class="container">
			<footer>
				<div class="footer-info"><b><?php echo $config['site_name']; ?></b> &#169; <?php echo date("Y"); ?></div>
				<div class="footer-credits">Dizajnirao i kodirao <a href="#"><?php echo $config['author']; ?></a></div>
			</footer>
		</div>
	</body>
</html>
