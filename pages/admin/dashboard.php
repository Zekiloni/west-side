<?php 

  if(!$account->isLogged()) {	$redir = $url."home"; header("Location: $redir"); }
  if(!$account->isAdmin($_SESSION['logged_as'])) { 	$redir = $url."home"; header("Location: $redir"); }

?>

<!DOCTYPE html>
<html>
	<body>
    <div class="container admin-navigation">
    <h1 class="oldie text-center"><?php echo $config['site_name']; ?></h1>
    <h4 class="text-center font-weight-light" >You are logged in ass <b><?php echo $_SESSION['email']; ?> </b></h4>
      <div class="row admin-links">      
        <div class="col-md text-center"><a  href="admin/orderds" class="admin-link">manage orderds</a></div>
        <div class="col-md text-center"><a  href="admin/products/" class="admin-link">manage products</a></div>
        <div class="col-md text-center"><a  href="admin/categories/" class="admin-link">manage categories</a></div>
      </div>
      <div class="row">
        <div class="col-md text-center"><a  href="home" class="admin-link">back to home</a></div>
      </div>
    </div>
</div>

