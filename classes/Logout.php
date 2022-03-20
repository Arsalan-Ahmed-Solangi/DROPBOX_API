<?php 
	

	//***Start of Activity Class********//
	require_once 'Activity.php';
	//**End of Activity Class**********//

	//***Start of Logout Class********//	
	class Logout extends Activity
	{


		//***Start of Constructor**********//
		public function __construct()
		{

		}
		//***End of Constructor**********//

		//***Start of logout and save activity***********//
		public function logout()
		{
			$result = $this->saveActivity("User Logout",null,$_SESSION['user']['user_id']);
			session_destroy();
			header("location:index.php");
		}
		//***End of logout and save activity***********//
	}
	//***End of Logout Class*********//


?>