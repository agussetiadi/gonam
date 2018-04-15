<?php 
/**
* 
*/
class Fb_callback
{
  public $fb;
  function __construct()
  {
    include "Facebook/autoload.php";
    $this->fb = new Facebook\Facebook([
    'app_id' => '302567313536058', // Replace {app-id} with your app id
    'app_secret' => '342af5b921d79259784c39fd4c6f34e1',
    'default_graph_version' => 'v2.2',
    ]);
    
  }
  public function get_callback(){

$helper = $this->fb->getRedirectLoginHelper();  
  
try {  
  $accessToken = $helper->getAccessToken();  
} catch(Facebook\Exceptions\FacebookResponseException $e) {  
  // When Graph returns an error  
  
  echo 'Graph returned an error: ' . $e->getMessage();  
  exit;  
} catch(Facebook\Exceptions\FacebookSDKException $e) {  
  // When validation fails or other local issues  
 
  echo 'Facebook SDK returned an error: ' . $e->getMessage();  
  exit;  
}  
 
 
try {
  // Get the Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $this->fb->get('/me?fields=name,email,gender,first_name,last_name,birthday,website', $accessToken->getValue());
  $requestPicture = $this->fb->get('/me/picture?redirect=false&height=300', $accessToken->getValue());
  $me = $response->getGraphUser();
  $picture = $requestPicture->getGraphUser();
  $dp = $picture['url'];
  $data_callback['key_id'] = $me->getProperty('id');
  $data_callback['email'] = $me->getProperty('email');
  $data_callback['name'] = $me->getProperty('name');
  $data_callback['picture'] = $dp;
  $data_callback['user_gender'] = $me->getProperty('gender');
  return $data_callback;
//  print_r($response);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'ERROR: Graph ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'ERROR: validation fails ' . $e->getMessage();
  exit;
}


/*
echo "Full Name: ".$me->getProperty('name')."<br>";
echo "First Name: ".$me->getProperty('first_name')."<br>";
echo "Last Name: ".$me->getProperty('last_name')."<br>";
echo "Email: ".$me->getProperty('email');
echo "Facebook ID: <a href='https://www.facebook.com/".$me->getProperty('id')."' target='_blank'>".$me->getProperty('id')."</a>";
echo "<img src='".$picture['url']."'/>";
*/
  }
}
?>