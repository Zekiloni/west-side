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
		<div class="under-nav">
			<h2 class="text-center welcome-message">Welcome to <b><?php echo $config['site_name']; ?></b></h2>
			<h4 class="text-center welcome-message"><?php echo $config['description']; ?></h4>
		</div> 
		<div class="container py-5">	
			<div class="signup-form">
				<form method="POST">
				<h2>Sign up</h2>
					<p class="hint-text">Create your account. It's free and only takes a minute.</p>
					<div class="form-group">
						<div class="row">
							<div class="col-xs-6"><input type="text"  name="name" placeholder="First Name" ></div>
						</div>        	
							</div>
							<div class="form-group">
								<input type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
									<input type="password" name="password" placeholder="Password" >
							</div>
							<div class="form-group">
									<input type="password" name="confirm_password" placeholder="Confirm Password" >
							</div>        
							<div class="form-group">
						<label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
					</div>
					<div class="form-group">
						<button type="submit" name="signup" class="btn-lg btn-block">Register Now</button>
						<br>
						<a class="btn-lg btn-block" href="home">Nazad na pocetnu</a>
					</div>
				</form>
			</div>
		</div>
		<div class="container">
			<footer>
				<div class="footer-info"><b><?php echo $config['site_name']; ?></b> &#169; <?php echo date("Y"); ?></div>
				<div class="footer-credits">Dizajnirao i kodirao <a href="#"><?php echo $config['author']; ?></a></div>
			</footer>
		</div>
	</body>
</html>
