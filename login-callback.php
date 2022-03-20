<?php


    //****Start of Setting Config***********//
    require_once 'header.php';
    require_once 'classes/Database.php';


    //***Object of Class*******//
    $db = new Database();

    if (isset($_GET['code']) && isset($_GET['state'])) {    
        //Bad practice! No input sanitization!
        $code = $_GET['code'];
        $state = $_GET['state'];

        //Fetch the AccessToken
        $accessToken = $authHelper->getAccessToken($code, $state, $callbackUrl);


        //****Start of Saving This Token in Database*********//
        $token =  $accessToken->getToken();
        $id = $_SESSION['user']['user_id'];
        $query = "UPDATE `users` SET `dropbox_token`='".$token."' WHERE `user_id`=".$id;
        $result = $db->executeQuery($query);

        if($result)
        {
            $_SESSION['success'] = "Dropbox Integration Successfull!";
            $_SESSION['user']['dropbox_token'] = $token;
            header("location:home.php");
        }
        //***End of Saving This Token in Database***********//
       
    }
    //***End of Setting Config************//

?>