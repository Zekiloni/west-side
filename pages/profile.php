<?php 

  if(!$account->isLogged()) {	$redir = $url."home"; header("Location: $redir"); }
  //if(!$account->isAdmin($_SESSION['email'])) { 	$redir = $url."home"; header("Location: $redir"); }

  if(isset($_POST['save_Settings']))
	{
		if(empty($_POST['new_name']))
			$new_name = $userData['Name'];
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

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#pocetna">Početna</a></li>
      <li><a data-toggle="tab" href="#ic">Menu 1</a></li>
      <li><a data-toggle="tab" href="#settings">Podešavanje profila</a></li>
    </ul>
    <div class="tab-content py-3">
      <div id="pocetna" class="tab-pane active">
      <small class="hleb">pregled profila</small>
      <h3 class="font-weight-light"><?php echo RoleplayName($userData['Name']); ?></h3>
        <div class="row">
          <div class="col-md-4 py-3">
            <img src="http://sanfierro-rp.com/assets/skins/<?php echo $userData['Skin'];?>.png" width="200">
          </div>
          <div class="col-md-6 py-3">
            <h4 class="font-weight-light">OOC Informacije</h4>
            <ul class="user-informations">
                <li><b>Korisnik #</b> <?php echo $userData['ID']; ?></li>
                <li><b>E-Mail #</b> <?php echo $userData['Email']; ?></li>
                <li><b>Level </b> <?php echo $userData['Level']; ?></li>
                <li><b>Registracija </b> <?php echo $userData['RegDate']; ?></li>
                <li><b>Zadnja Prijava </b> <?php echo $userData['LoginDate']; ?></li>
                <li><b>Sati igranja</b> <?php echo numberToTime($userData['SatiIgranja']); ?></li>
                <li><b>IP Adresa</b> <?php echo $userData['IP']; ?></li>
              </ul>
          </div>  
        </div>

        <div class="row py-5">
         <div class="col-md-4">
            <h4 class="font-weight-light">IC Informacije</h4>
            <ul class="user-informations">
                <?php if($userData['Spol'] == "1") { $spol = "Muško"; } else if($userData['Spol'] == "2") { $spol = "Žensko"; } # spol ?>
                <li><b>Spol </b> <?php echo $spol; ?></li>
                <li><b>Godine </b> <?php echo $userData['Godine']; ?></li>
                <li></li>
                <li><b>Novac </b> <?php echo number_format($userData['Novac']); ?>$</li>
                <li><b>Banka </b> <?php echo number_format($userData['Bank']); ?></li>
              </ul>
          </div>  
          <div class="col">
           <h4 class="font-weight-light">Oruzije</h4>
            <?php for($i = 1; $i <13; $j = $i++ )  { ?>
              <?php if($userData['Weapon'.$i] > '0')  {?>
              <img class="weapon-icon" src="<?php echo $url; ?>assets/images/weapons/<?php echo $userData['Weapon'.$i]; ?>.png" data-toggle="tooltip" data-placement="top" title="<?php echo $userData['Ammo'.$i]; ?> Metkova">
            <?php } } ?>
          </div>  
        </div>
        <div class="row py-3">
          <div class="col-md-1"> <h4 class="font-weight-light">Vozila</h4></div>
          <?php for($i = 1; $i <6; $j = $i++ )  { ?>
            <?php if($userData['Veh'.$i] != '-1')  {?>
            <?php	$vehData = $account->vehData($userData['Veh'.$i]); ?>
            <img class="car-icon" src="<?php echo $url; ?>assets/images/cars/Vehicle_<?php echo $account->getVehicleModel($userData['Veh'.$i]); ?>.jpg" data-toggle="tooltip" data-placement="top" title="Registrovan: <?php echo $vehData['carTable']; ?>">
          <?php } } ?>
        </div>

      </div>
      <div id="ic" class="tab-pane fade">
        <h3>Menu 1</h3>
        <p>Some content in menu 1.</p>
      </div>
      <div id="settings" class="tab-pane fade">
        <small class="hleb">Podešavanje profila</small>
        <h3 class="font-weight-light"><?php echo RoleplayName($userData['Name']); ?></h3>
        <p>	
        <form method="POST">
          <div class="form-group">
            <label for="formGroupExampleInput">Ime Prezime (<small>Format <b>Ime_Prezime</b></small>)</label>
            <input type="text" name="new_name" placeholder="<?php echo $userData['Name']; ?>">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Nova sifra</label>
            <input type="text" name="new_password" placeholder="Nova Sifra">
          </div>
          <div class="form-group">
            <hr>
            <label for="formGroupExampleInput2">Potreban je upis stare sifra da bi izmenili profil</label>
            <input type="text" name="current_password" placeholder="trenutna sifra">
          </div>
          <br>
					<button type="submit" name="save_settings">Sacuvaj Izmene</button>
        </form>
        </p>
      </div>
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

