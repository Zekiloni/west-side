<?php 

  if(!$account->isLogged()) {	$redir = $url."home"; header("Location: $redir"); }
  if(!$account->isAdmin($_SESSION['email'])) { 	$redir = $url."home"; header("Location: $redir"); }

  if(isset($_GET['id'])){
    $site->deleteCategory($_GET['id']);
  }

  if(isset($_POST['create_category']))
	{
		if(empty($_POST['category_name']))
			Alert("ERROR !", "You must type category name.", 1);
		else
			$site->createCategory($_POST['category_name']);

	}

?>

<!DOCTYPE html>
<html>
	<body>
    <div class="container admin-navigation">
    <h1 class="oldie text-center"><?php echo $config['site_name']; ?></h1>
    <h4 class="text-center font-weight-light" >You are logged in ass <b><?php echo $_SESSION['email']; ?> </b></h4>
      <div class="row admin-links">      
        <div class="col-md">
          <ul class="edit-categories">
            <h4 class="text-center font-weight-light">Categories</h4>
           <?php foreach($site->getCategories() as $category) { ?>
              <li class="edit-category"> <span style="opacity: 0.25;"><?php echo $category['id']; ?></span> <?php echo $category['name']; ?> <a href="<?php echo $category['id']; ?>"> Delete Category</a> </li>
            <?php } ?>
         </ul>
        </div>
      </div>
      <form method="POST">
       <h4 class="font-weight-light">Create Category</h4>
				<div class="form-group">
					<div class="row">
						<input type="text" class="form-control" name="category_name" placeholder="category name">				
            <button type="submit" name="create_category" class="btn-lg btn-block">create category</button>
           </div>   
        </div>
      </form>
      <div class="row py-3">
        <div class="col-md text-center"><a  href="<?php echo $url ?>admin" class="admin-link">Go Back</a></div>
      </div>
    </div>
</div>

