<?php

	//***Start of Session*******//
	session_start();
	//***End of Session********//


	//***Start of Load Library********//
    require __DIR__ . '/vendor/autoload.php';
	use Kunnu\Dropbox\Dropbox;
    use Kunnu\Dropbox\DropboxApp;
    //***End of Load Library********//


    //**Key and Secret ********//
    $dropboxKey = 'kfi12xy2lsvu3rk';
	$dropboxSecret = '4v7k7xubu0pa03m';

	//****Start of Config********//
	$app = new DropboxApp($dropboxKey,$dropboxSecret);

    $dropbox = new Dropbox($app);

	//DropboxAuthHelper
	$authHelper = $dropbox->getAuthHelper();

	//Callback URL
	$callbackUrl = "http://localhost/ArsalanTask/login-callback.php";
	//****End  of Config********//
?>