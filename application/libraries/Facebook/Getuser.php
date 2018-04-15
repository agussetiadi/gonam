<?php 


/**
* 
*/
class Getuser extends CI_model
{
	
	function __construct()
	{

		include "Facebook/autoload.php";

		$this->load->model("user_model");
	}
	public function graph(){
		/* PHP SDK v5.0.0 */
		/* make the API call */
		$session = new fb_callback;
		$request = new Facebook\FacebookRequest(
		  $session,
		  'GET',
		  '/me'
		);
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		/* handle the result */
		return $graphObject;
	}
}


?>