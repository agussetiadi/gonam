<?php 

class Fbconfig
{
	
	function __construct()
	{
		include "Facebook/autoload.php";
		
	}
	function getUrl(){
		
		$fb = new Facebook\Facebook([
		  'app_id' => '302567313536058', // Replace {app-id} with your app id
		  'app_secret' => '342af5b921d79259784c39fd4c6f34e1',
		  'default_graph_version' => 'v2.2',
		  ]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://gonam/login/facebookAuth', $permissions);	
		return $loginUrl;
	}
}

#echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>