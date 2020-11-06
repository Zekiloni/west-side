
<?php 
	include("includes/sampquery.php");

	$sampquery = new SampQuery('78.47.77.99', '7777');
	if($sampquery->isOnline()) {
		$serverInfo = $sampquery->getInfo();

		$onlinePlayers = $serverInfo['players'] .' / '. $serverInfo['maxplayers'];
	}
	else { $onlinePlayers = 'server nije online'; }


?>

<!DOCTYPE html>
<html>
	<body>

		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark">
					<a class="navbar-brand" href="#"><img width="170" src="<?php echo $url; ?>assets/images/logo.png"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="container">
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">
								<li class="nav-item active">
									<a class="nav-link" href="#">Početna <span class="sr-only">(current)</span></a>
								</li>
								<li class="nav-item"><a class="nav-link" href="about">Forum</a></li>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Serveri
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="server"> Statistika</a>
									</div>
								</li>
								<?php if($account->isAdmin($_SESSION['logged_as'])) {  ?>
									<li class="nav-item"><a class="nav-link" href="admin">Admin</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php include("includes/profile.php"); ?>
			</nav>
		</div>

		<div class="container">	
				<div class="under-nav row justify-content-md-center">
					<div class="col-md-7">
						<h2 class="font-weight-light text-white ">West Side Roleplay</h2>
						<h4 class="font-weight-light"> www.westside-roleplay.com</h4>
						<p class="py-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel sem scelerisque, aliquet ligula nec, tincidunt lorem. Donec rutrum dolor id enim mollis pretium. Nullam lacus quam, placerat in metus ut, iaculis rutrum lorem. In vulputate commodo ante, sed mollis risus semper eget. Curabitur pharetra justo sit amet cursus bibendum. Donec malesuada est non vehicula vulputate. </p>
						<div class="discord-stats py-3">
							<a href="<?php echo discordLink(); ?>" class="discord-link"><img src="<?php echo $url; ?>assets/images/discord_icon.png" width="35"> Pridruži se</a><br>
							<span class="discord-info"><i class="fa fa-arrow-right" aria-hidden="true"></i> <b><?php echo discordMembers(); ?></b> članova na mreži</span>
						</div>
						<div class="samp-stats py-3">
							<a href="<?php echo discordLink(); ?>" class="samp-link"><img src="<?php echo $url; ?>assets/images/samp_icon.png" width="35"> Pridruži se</a><br>
							<span class="samp-info"><i class="fa fa-arrow-right" aria-hidden="true"></i> <b><?php echo $onlinePlayers; ?></b> igrača  na serveru</span>
						</div>
					</div>
					<div class="col-md-4">
							<img class="img img-responsive alltuchtopdown" src="<?php echo $url; ?>assets/images/under-nav.png" width="300">
					</div>
				</div>
			</div>
		</div>

		<div class="container">
				<?php include('includes/news.php'); ?>
		</div>

  		<div class="container">
			<footer>
				<div class="footer-info"><b><?php echo $config['site_name']; ?></b> &#169; <?php echo date("Y"); ?></div>
				<div class="footer-credits">Dizajnirao i kodirao <a href="#"><?php echo $config['author']; ?></a></div>
			</footer>
		</div>
	</body>
</html>
