<?php 
	
	//***Start of Session Start**********//
	session_start();
	//**End of Session Start***********//
	
	//***Start of Require Classes********//
	require_once 'classes/Database.php';
	require_once 'classes/Logout.php';
	require_once 'classes/User.php';
	require_once 'classes/Files.php';
	//***End of Require Classes*********//

	//***Start of Class Objects*******//
	$db = new Database();
	$logout = new Logout();
	$user = new User();
	$files = new Files();
	//***End of Class Objects*******//
	
	//***Start of Login Form*********//
	if(isset($_POST['action']) && $_POST['action'] == 'login')
	{
		
		//***Start of Extracting Data********//
		extract($_POST);
		//***End of Extracting Data*********//


		//**Start of Query*********//
		$query  = "SELECT * FROM `users` WHERE `username` = '$email' AND `password`='$password'";
		$result = $db->executeQuery($query);
		//**End of Query*********//


		//**Start of Check User Status********//
		if($result->num_rows > 0 )
		{
			$result = mysqli_fetch_assoc($result);

			
			if($result['status'] == 'Active')
			{	

				$_SESSION['user'] = $result;
				echo json_encode(array('status' => 1));
			}else
			{
				echo json_encode(array('status' => 0));
			}
		}else
		{
			echo json_encode(array('status' => 2));
		}
		//**End of Check User Status********//

	}
	//***End of Login Form**********//

	//***Start of Logout*********//
	if(isset($_GET['logout']) && $_GET['logout'] == 'true')
	{
		$logout->logout();
	}
	//***End of Logout**********//


	///***Start of Get Users****************///
	if(isset($_GET['action']) && $_GET['action'] == 'getUsers')
	{
		$id = $_SESSION['user']['user_id'];
		$user->getUsers($id);

	}
	///***End of Get Users***************///


	//***Start of Add User*********//
	if(isset($_POST['action']) && $_POST['action'] == "addUser")
	{
		$user->addUser($_POST);
	}
	//***End of Add User**********//


	//***Start of Edit User********//
	if(isset($_POST['action']) && $_POST['action'] == "editUser")
	{
		$user->editUser($_POST);
	}
	//**End of Edit User*********//


	//***Start of delete User********//
	if(isset($_POST['action']) && $_POST['action'] == "deleteUser")
	{
		$user->deleteUser($_POST['id']);
	}
	//**End of delete User*********//

	//**Start of Change Password********//
	if(isset($_POST['changePassword']))
	{
		$user->changePassword($_POST);
	}
	//**End of Change Password*********//

	//***Start of Upload File*********//
	if(isset($_POST['upload_file']))
	{
		$token = $_SESSION['user']['dropbox_token'];
		$files->uploadFile($_POST,$_FILES['file'],$token);
	}
	//***End of Upload File	**********//

	//**Start of Disconnect Dropbox**********//
	if(isset($_GET['action']) && $_GET['action'] == "disconnect")
	{
		$user->disconnect();
	}
	//**End of Disconnect Dropbox************//

?>