<?php 

  /*if(!$account->isLogged()) {	$redir = $url."home"; header("Location: $redir"); }
  if(!$account->isAdmin($_SESSION['email'])) { 	$redir = $url."home"; header("Location: $redir"); }*/

  if(isset($_GET['id'])){
    $site->deleteProduct($_GET['id']);
  }

  if(isset($_POST['dodaj_novost']))
	{
		if(empty($_POST['naslov']))
      Alert("ERROR !", "naslov.", 1);
    else if(empty($_POST['tekst']))
      Alert("ERROR !", "tekst.", 1);
    if(empty($_POST['slika']))
			Alert("ERROR !", "slika.", 1);
		else
      $site->addPost($_POST['naslov'], $_POST['tekst'], $_POST['slika']);
  }

?>

<!DOCTYPE html>
<html>
	<body>
    <div class="container admin-navigation">
    <h1 class="font-weight-light text-center"><?php echo $config['site_name']; ?></h1>
    <h4 class="text-center font-weight-light" >Podešavanje Novosti </b></h4>
      <div class="row admin-links">      
        <div class="col-md">
          <ul class="edit-categories">
            <h4 class="text-center font-weight-light">Novosti</h4>
           <?php foreach($site->getPosts() as $product) { ?>
              <li class="edit-category"> <span style="opacity: 0.25;"><?php echo $product['id']; ?></span> <?php echo $product['name']; ?> <a href="<?php echo $product['id']; ?>"> Delete Product</a> </li>
            <?php } ?>
         </ul>
        </div>
      </div>
      <form method="post" enctype="multipart/form-data">
       <h4 class="font-weight-light">Add Product</h4>
				<div class="form-group">
					<div class="row">
						<div class="col-md">
              <input type="text" class="form-control" name="naslov" placeholder="naslov vesti">
            </div>
            <div class="col-md">
              <div class="col-md"><textarea type="text" class="form-control" name="tekst" placeholder="tekst vesti"></textarea></div>
            </div>
            <div class="col-md">
            <div class="col-md"><input type="text" class="form-control" name="slika" placeholder="slika (imgur .png link)"></div>
            </div>			
            <button type="submit" name="dodaj_novost" class="btn-lg btn-block">dodaj novost</button>
           </div>   
        </div>
      </form>

      <div class="row py-3">
        <div class="col-md text-center"><a  href="<?php echo $url ?>admin" class="admin-link">Go Back</a></div>
      </div>
    </div>
</div>

