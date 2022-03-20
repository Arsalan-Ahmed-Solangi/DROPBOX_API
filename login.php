<?php

	//****Start of Redirecting********//
    require_once 'header.php';

	//Fetch the Authorization/Login URL
	$authUrl = $authHelper->getAuthUrl($callbackUrl);
	header("location:".$authUrl);
	//***End of Redirecting**********//
?>