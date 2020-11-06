
<?php if(!$account->isLogged()) { ?>
  <a href="#" onclick="openSearch()" class="ucp-icon"><i class="my-2 my-lg-0 fa fa-user" aria-hidden="true"></i> 
      User Control Panel
  </a>	
  <?php }  else { ?>
    <div class="skin-avatar" ><img src="http://sanfierro-rp.com/assets/skins/<?php echo $userData['Skin'];?>.png"></div>
    <a href="profile" class="ucp-icon"></i> 
       <div class="profile-name"><?php echo strstr($userData['Name'], '_', true); ?></div>
    </a>
    <a href="logout" class="logout-icon"></i> <i class="fa fa-sign-out" aria-hidden="true"></i> </a>
	 <?php } ?> 