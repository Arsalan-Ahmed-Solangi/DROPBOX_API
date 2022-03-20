<?php 
	

	//***Start of Activity Class********//
	require_once 'Activity.php';
	//**End of Activity Class**********//

	//***Start of Logout Class********//	
	class User extends Activity
	{

		//***Start of Constructor**********//
		public function __construct()
		{

		}
		//***End of Constructor**********//

		//***Start of getUsers***********//
		public function getUsers($id)
		{


		    $this->query = "SELECT * FROM `users` WHERE `deleted` = '0' AND   `user_id` <>".$id." ORDER BY user_id DESC ";
    		$db = new Database();
    		$result =  $db->executeQuery($this->query);
    			
    		//***Start of View Users************//
    		$a = 0;
    		while($row = mysqli_fetch_assoc($result)) {

    			?>
    			<tr>
    				<td> <?php echo  ++$a;  ?> </td>
    				<td> <?php echo  $row['username'];  ?> </td>
    				<td> 
    					<?php 

    						if($row['status'] == 'Active')
    						{
    							?>
    							<span class="badge badge-sucess bg-success">Active</span>
    							<?php
    						}else
    						{
    							?>
    							<span class="badge badge-sucess bg-danger">Inactive</span>
    							<?php
    						}

    					?>
    				</td>
    				<td> 
    					<a href="#editEmployeeModal" class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#editModel" >
						<i style="text-decoration: none;" class="material-icons update" data-toggle="tooltip" 
						data-id="<?php echo $row["user_id"]; ?>"
						data-email="<?php echo $row["username"]; ?>"
						data-password="<?php echo $row["password"]; ?>"
						data-status="<?php echo $row["status"]; ?>"
						title="Edit"> <span class="fa fa-edit"></span> Edit</i>
						
					</a>
    					
    					<a href="#deleteModel" class="delete btn btn-danger" data-id="<?php echo $row["user_id"]; ?>" data-bs-toggle="modal" data-bs-target="#deleteModel"><i class="material-icons" data-toggle="tooltip" 
						title="Delete"><span class="fa fa-trash"></span> Delete</i></i></a>
    				 </td>
    				
    			</tr>
    			<?php

			}

    		//***End of View Users************//		

		}
		//***End of getUsers***********//


		//**Start of AddUser**********//
		public function addUser($data)
		{
			extract($data);

			$db = new Database();
			$query = "INSERT INTO `users` (`username`,`password`) VALUES ('$email','$password')";
			$result = $db->executeQuery($query);

			if($result)
			{
				echo json_encode(array("status" => 1));	
			}else
			{
				echo json_encode(array("status" => 0));
			}

		}
		//***End of Add User**********//


		//***Start of getUser Data***********//
		public function getUserData($id)
		{
			$db = new Database();
			$query = "SELECT * FROM `users` WHERE `user_id`=".$id;
			$result = $db->executeQuery($query);
			$result = mysqli_fetch_assoc($result);

			echo json_encode(array("status" => 1, "data"=>$result));


		}
		//***End of getUser Data***********//

		//***Start of Edit User*******//
		public function editUser($data)
		{
			extract($data);

		
			$db = new Database();
		 $query = "UPDATE `users` SET `username`='$email_u' , `password`='$password_u' , `status` ='$status' WHERE `user_id`='$user_id'";
			$result = $db->executeQuery($query);


			if($result)
			{
				echo json_encode(array("status" => 1));	
			}else
			{
				echo json_encode(array("status" => 0));
			}
		}
		//***End of Edit User********//


		//***Start of Delete User*******//
		public function deleteUser($id)
		{
			$db = new Database();
		 $query = "UPDATE `users` SET `deleted`='1' WHERE `user_id`='$id'";
			$result = $db->executeQuery($query);

			if($result)
			{
				echo json_encode(array("status" => 1));	
			}else
			{
				echo json_encode(array("status" => 0));
			}
		}
		//***End of Delete User*******//


		//****Start of Change Password*********//
		public function changePassword($data)
		{
			extract($_POST);
			$password = $_SESSION['user']['password'];
			$id = $_SESSION['user']['user_id'];


			if($old_password != $password)
			{
				$_SESSION['error'] = "Old Password not matched!";
				header("location:change_password.php");
			}else if($new_password != $confirm_password)
			{
                $_SESSION['error'] = "Confirm Password not matched!";
				header("location:change_password.php");
			}else
			{
				//****Updated Password********//
				$query = "UPDATE `users` SET `password`='$new_password' WHERE `user_id`='$id'";
				$db = new Database();
				$result = $db->executeQuery($query);

				if($result)
				{
					 $_SESSION['success'] = "Password Changed Successfully!";
				header("location:change_password.php");
				}else
				{
					$_SESSION['error'] = "Password Not Changed";
				    header("location:change_password.php");
				}

			}
		}
		//****End of Change Password**********//

		//***Start of Disconnect Dropbox*********//
		public function disconnect()
		{
			$db = new Database();
			$id = $_SESSION['user']['user_id'];
		    $query = "UPDATE `users` SET `dropbox_token`=null WHERE `user_id`='$id'";
			$result = $db->executeQuery($query);

			if($result)
			{	

				$_SESSION['user']['dropbox_token'] = "";
				 $_SESSION['success'] = "You are Disconnected from Dropbox";
			header("location:home.php");
			}else
			{
				$_SESSION['error'] = "Failed to Disconnect!";
			    header("location:home.php");
			}
		}
		//**End of Disconnect Dropbox**********//
	}
	//***End of Logout Class*********//


?>