<?php
	

	//****Start of DB Class*******//
	require_once 'Database.php';
	//***End of DB Class********//

	//****Start of Activity Class**********//
    class Activity
    {
    	//***Start of Variables******//
    	private $query         = null;
    	private $tableName     = "activity_logs";
    	//**End of Variables********//

    	//****Start of Constructor*******//
    	public function __construct()
    	{
    			
    	}
    	//****End of Constructor********//


    	//***Start of Save Activity*******// 	
    	public function saveActivity($activity_name,$email = null,$id)
    	{
    		$this->query = "INSERT INTO ".$this->tableName." (`activity_name`,`username`,`created_by`) VALUES ('$activity_name',`$email`,'$id')";
    		$db = new Database();
    		$result =  $db->executeQuery($this->query);
    		return $result;
    	}
    	//***End of Save Activity*******//


    	//***Start of Get Activity Logs*******//
    	public function getActivity()
    	{
    		$this->query = "SELECT * FROM  `activity_logs` INNER JOIN `users` ON activity_logs.created_by = users.user_id";
    		$db = new Database();
    		$result =  $db->executeQuery($this->query);
    		return $result;
    	}
    	//***End of Get Activity Logs********//
    }
	//****End of Activity Class**********//


?>