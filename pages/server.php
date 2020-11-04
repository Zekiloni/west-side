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
								<li class="nav-item">
									<a class="nav-link" href="home">Početna <span class="sr-only">(current)</span></a>
								</li>
								<li class="nav-item"><a class="nav-link" href="about">Forum</a></li>
								<li class="nav-item active dropdown">
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

		<div class="container py-5">	
				<h5 class="font-weight-light text-white ">Poštovani korisnici West Side Roleplaya,</h5>
				<p>izuzetna nam je čast i zadovoljstvo prezentovati Vam otvorenje prve hardcore RolePlay Gaming zajednice na Balkanu. Sastavljena od izuzetno stručnih, obučenih ljudi, ova zajednica pružit će Vam maksimalnu zabavu uz korektivnu kreativnost. Najbolji Roleplayeri balkana pridružili su se jednom gnijezdu kvalitetnih igrača kojima neće izuskivati kompetetnost u pogledu RolePlaya, raznoraznih evenata i zabave. Ova zajednica je oduvijek bila u mislima svakog RolePlay igrača na Balkanu, a već sada je došla do same njene realizacije uz puno marljivog rada, iskustva i talenta svih članova administracije ove Roleplay zajednice.</p>
				<p>Važna obavijest za sve zainteresirane igrače WSRP-a, da će se forum otvoriti dana _______ i da ćete u njemu pronaći sve bitne informacije vezane za server/forum i pratiti kako za InGame, tako i za ostala dešavanja. Ukoliko već niste, pozivamo Vas da podržite našu zajednicu tako što ćete izdvojiti par sekundi Vašeg vremena i učlaniti se u našoj „West Side Roleplay“ Discord grupi, kao i na forumu na kojem možete već pratiti najaktuelnija dešavanja vezano za našu zajednicu. </p>
				<p>Hvala Vam što ste uz nas i što nas podržavate, pozivamo Vas i da pozovete Vaše prijatelje koji još nisu obaviješteni o ovome da zajednički pronađete pravu Roleplay Gaming zajednicu, u punom smislu te riječi.</p>
			
			</div>

		<div class="container py-3">
			<footer>
				<div class="footer-info"><b><?php echo $config['site_name']; ?></b> &#169; <?php echo date("Y"); ?></div>
				<div class="footer-credits">Designed and coded by <a href="#"><?php echo $config['author']; ?></a></div>
			</footer>
		</div>
	</body>
</html>
