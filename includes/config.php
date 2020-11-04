<?php
	# zeki ne pali errore
	session_start(); ob_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$config = array(
		# informacije
		'site_name' => 'West Side Roleplay',
		'author' => 'Zekirija Alomerovic',
		'description' => 'SA-MP Roleplay Community',
		'keywords' => 'samp, roleplay, samp roleplay, rp, sa-mp, west side, west side rp, west side roleplay',
		'discord_id' => '762050115564601375',
	);

	$url = "http://localhost/west-side/";
?>