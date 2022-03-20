<?php 
	


	//****Start of CURL Class*******//
	require_once 'Curl.php';
	//***End of CURL Class********//

	//***Start of File Class********//
	class Files
	{
		//***start of constructor******//
		public function __construct()
		{

		}
		//***end of constructor******//


		//***Start of Get Files********//
		public function getFiles($token)
		{
			$ch = new Curl();
			
			//***Headers*******//
			$headers = array();
			$headers[] = "Authorization: Bearer ".$token." ";
			$headers[] = "Content-Type: application/json";


			//Get Root Files and Folders
			$data = "{\"path\": \"\"}";

			$result = $ch->post("https://api.dropboxapi.com/2/files/list_folder",$data,$headers);
			$json = json_decode($result, true);
			return $json;
		}
		//***End of Get Files*********//

		//***Start of Uplaod File*******//
		public function uploadFile($data,$files,$token)
		{
			//***Start of First Save File********//
			$result = $this->saveImage($files);
			if($result['status'] == 1)
			{	

				$path = $result['name'];
			$fp = fopen($path, 'rb');
			$size = filesize($path);


			$cheaders = array('Authorization: Bearer '.$token.' ',
			                  'Content-Type: application/octet-stream',
			                  'Dropbox-API-Arg: {"path":"/'.$path.'", "mode":"add"}');

			$ch = curl_init('https://content.dropboxapi.com/2/files/upload');
			curl_setopt($ch, CURLOPT_HTTPHEADER, $cheaders);
			curl_setopt($ch, CURLOPT_PUT, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_INFILE, $fp);
			curl_setopt($ch, CURLOPT_INFILESIZE, $size);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);

			curl_close($ch);    
			fclose($fp);

				// //**End of Upload to Dropbox***********//

			unlink($path);

			$_SESSION['success'] = "File has been uploaded successfully!";
			header('location:upload.php');

			}else
			{
				$_SESSION['error'] = "Failed to Upload File";
				header('location:upload.php');
			}
			//***End of First Save File*********//
		}
		//***End of Upload File*******//	


		//***Start of Save Image First*****//
		public function saveImage($files)
		{
		
			$image_type = explode('/',$files['type']);
			$image_name = $files['name'].time().".".$image_type[1];
          

      $image_upload = move_uploaded_file($files['tmp_name'],$image_name);


       if($image_upload)
       {
       	return array('status'=>1,'name'=>$image_name);
       }else
       {
       	return array('status'=>0);
       }
		}
		//***End of Save Image First*******//


		//****Start of Get Integrated*******//
		public function shareFile()
		{
				
		}
		//***End of Get Integreated*********//

	}
	//***End of File Class*********//


?>