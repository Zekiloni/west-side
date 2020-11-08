<?php 

  if(!$account->isLogged()) {	$redir = $url."home"; header("Location: $redir"); }
  if(!$account->isAdmin($_SESSION['logged_as'])) { 	$redir = $url."home"; header("Location: $redir"); }

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
									<li class="nav-item active"><a class="nav-link" href="admin">Admin</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php include("includes/profile.php"); ?>
			</nav>
		</div>
    <div class="container py-5">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Početna</a></li>
        <li><a data-toggle="tab" href="#postnews">Novosti</a></li>
        <li><a data-toggle="tab" href="#members">Lista Korisnika</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane active ">
          <h3>HOME</h3>
          <p>Some content.</p>
        </div>
        <div id="postnews" class="tab-pane fade">
          <h3>Menu 1</h3>
          <p>Some content in menu 1.</p>
        </div>
        <div id="members" class="tab-pane fade">
          <h3 class="font-weight-light py-3">Lista korisnika</h3>
		  <table id="example" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Datum Registracije</th>
                <th>Zadnja Prijava</th>
				<th>IP</th>
				<th>HardwerID</th>
            </tr>
        </thead>
        <tbody>
			<?php foreach($account->getAllUsers() as $user) { ?>
				<tr>
					<td><?php echo $user['ID'] ?></td>
					<td><?php echo $user['Name'] ?></td>
					<td><?php echo $user['Email'] ?></td>
					<td><?php echo $user['RegDate'] ?></td>
					<td><?php echo $user['LoginDate'] ?></td>
					<td><?php echo $user['IP'] ?></td>
					<td><?php echo $user['HardwerID'] ?></td>
				</tr>
			<?php } ?>
        </tbody>
    </table>


        </div>
      </div>
    </div>

  </body>
</html>

