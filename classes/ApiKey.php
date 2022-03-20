<?php 

	//***Start of Api Key Class*******//
	class ApiKey
	{
		//***Start of Variables*********//
		private $dropboxKey     = "kfi12xy2lsvu3rk";
		private $dropboxSecret  = "4v7k7xubu0pa03m";
		private $callbackUrl    = "http://localhost/ArsalanTask/login-callback.php";
		//***End of Variables********//

		//***Start of GetApiKey*******//
		public function getApiKey()
		{
			return $this->dropboxKey;
		}
		//***End of GetApiKey********//

		//***Start of GetApiKey*******//
		public function getApiSecret()
		{
			return $this->dropboxSecret;
		}
		//***End of GetApiKey********//


		//***Start of getcallback*******//
		public function getcallback()
		{
			return $this->callbackUrl;
		}
		//***End of getcallback********//

	}
	//***End of Api Key Class*******//


?>