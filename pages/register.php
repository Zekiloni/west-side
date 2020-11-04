<?php 

	if(isset($_POST['signup']))
	{
		if(empty($_POST['first_name']))
			Alert("ERROR !", "You must type your first name.", 1);
		else if(empty($_POST['last_name']))
			Alert("ERROR !", "You must type your last name.", 1);
		else if(empty($_POST['email']))
			Alert("ERROR !", "You must type your mail.", 1);
		else if(empty($_POST['password']))
			Alert("ERROR !", "You must type your password.", 1);
		else if((strlen($_POST['password']) < 8))
			Alert("ERROR !", "Your password must be more than 8 characters.", 1);
			else if($_POST['password'] != $_POST['confirm_password'])
			Alert("ERROR !", "Passwords doesn't match.", 1);
		else
			$account->Register($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
	}

	if(isset($_POST['signin']))
	{
		if(empty($_POST['email']))
			Alert("ERROR !", "You must type your e-mail.", 1);
		else if(empty($_POST['password']))
			Alert("ERROR !", "You must type your password.", 1);
		else
			$account->Login($_POST['email'],  $_POST['password']);

	}


?>
<!DOCTYPE html>
<html>
	<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#"><?php echo $config['site_name']; ?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="container">
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item">
								<a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item"><a class="nav-link" href="about">About</a></li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Categories
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<?php foreach($site->getCategories() as $category) { ?>
										<a class="dropdown-item" href="category/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
									<?php } ?>
								</div>
							</li>
							<li class="nav-item active"><a class="nav-link" href="account">Account</a></li>
						</ul>
					</div>
				</div>
			<a href="#" onclick="openSearch()" class="shopping-cart-icon"><i class="my-2 my-lg-0 fa fa-search" aria-hidden="true"></i></a>	
			<a href="#" class="search-icon"><i class="my-2 my-lg-0 fa fa-shopping-cart" aria-hidden="true"></i></a>
		</nav>
		<div class="under-nav">
				<h2 class="welcome-message">Welcome to <b><?php echo $config['site_name']; ?></b></h2>
				<h4 class="welcome-message"><?php echo $config['description']; ?></h4>
		</div>
		<div class="container py-5">	
			<div class="signup-form">
				<form method="POST">
					<h2>Sign in</h2>
						<div class="form-group">
							<div class="row">
								<div class="col-md"><input type="text" class="form-control" name="email" placeholder="E-mail"></div>
								<div class="col-md"><input type="password" class="form-control" name="password" placeholder="Password" ></div>
							</div>        	
						</div>
						<div class="form-group">
										<button type="submit" name="signin" class="btn-lg btn-block">Sign In</button>
								</div>
						</form>
				</div>

				<div class="signup-form">
					<form method="POST">
					<h2>Sign up</h2>
					<p class="hint-text">Create your account. It's free and only takes a minute.</p>
							<div class="form-group">
						<div class="row">
							<div class="col-xs-6"><input type="text" class="form-control" name="first_name" placeholder="First Name" ></div>
							<div class="col-xs-6"><input type="text" class="form-control" name="last_name" placeholder="Last Name"></div>
						</div>        	
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="email" placeholder="Email">
							</div>
							<div class="form-group">
									<input type="password" class="form-control" name="password" placeholder="Password" >
							</div>
							<div class="form-group">
									<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" >
							</div>        
							<div class="form-group">
						<label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
					</div>
					<div class="form-group">
									<button type="submit" name="signup" class="btn-lg btn-block">Register Now</button>
							</div>
					</form>
			</div>
		</div>
		<footer>
			<div class="footer-info"><b><?php echo $config['site_name']; ?></b> &#169; <?php echo date("Y"); ?></div>
			<div class="footer-credits">Designed and coded by <a href="#"><?php echo $config['author']; ?></a></div>
		</footer>
	</body>
</html>
