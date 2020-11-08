<?php

	require('includes/config.php');
	require('includes/head.php');
	require('includes/functions.php');
	
	$account = new User();
	$site = new Site(); 
	$db = new db(); 

	if($account->isLogged()) { $userData = $account->acountData($_SESSION['logged_as']); }

	switch(($_GET['page']))
	{
		case 'server': 
			include("pages/server.php"); break;
		case 'register': 
			include("pages/register.php"); break;
		case 'logout': 
			include("pages/logout.php"); break;
		case 'profile': 
			include("pages/profile.php"); break;
		case 'applications': 
			include("pages/applications.php"); break;
		case 'category': 
			include("pages/category.php"); break;
		case 'admin': 
			include("pages/admin/dashboard.php"); break;
		case 'newpost': 
			include("pages/admin/newpost.php"); break;
		case 'categories': 
			include("pages/admin/categories.php"); break;
		default: 
			include("pages/home.php"); break;
	}

		include("includes/login-modal.php");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url ?>assets/js/main.js"></script>








