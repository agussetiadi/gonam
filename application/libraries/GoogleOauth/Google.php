<?php 

class Google
{
	public $client;
	public $plus;
	function __construct()
	{
		require APPPATH."libraries/GoogleOauth/Google_Client.php";
		require APPPATH."libraries/GoogleOauth/contrib/Google_Oauth2Service.php";
		require APPPATH."libraries/GoogleOauth/contrib/Google_PlusService.php";
		$this->client = new Google_Client();
		$this->plus = new Google_PlusService($this->client);
		$this->client->setScopes(array("https://www.googleapis.com/auth/plus.login",
		"https://www.googleapis.com/auth/userinfo.email",
		"https://www.googleapis.com/auth/userinfo.profile",
		"https://www.googleapis.com/auth/plus.me"));
	}


	function getUrl(){
		$url = $this->client->CreateAuthUrl();
		return $url;
	}
	function callBack(){
		if (isset($_GET['code'])) {
		  $this->client->authenticate();
		  $_SESSION['access_token'] = $this->client->getAccessToken(); # simpan accss_token dlm session
		  /*header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);*/
		}
		return true;
	}
	function getPeople(){
		if (isset($_SESSION['access_token'])) {
		  $this->client->setAccessToken($_SESSION['access_token']);
		}
		if ($this->client->getAccessToken()) {
		  $search = $this->plus->people->search('me'); # Ambil data json dengan parameter search
		  $get = $this->plus->people->get('me'); # Ambil data json dengan parameter get
		}
/*		  $getPeople['id'] 			= $me['id'] ;
		  $getPeople['display_name'] = $me['displayName'];
		  $getPeople['email'] 		= $me['emails'][0]['value'];*/
		  return $get;
	}

}


?>
