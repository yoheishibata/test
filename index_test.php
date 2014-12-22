<?php

require_once("twitteroauth-master/twitteroauth/twitteroauth.php");

$consumerKey = "1A1P1SaN9tkR1gCz2B0tfwN4F";
$consumerSecret = "Nh9tn6EHWAF9cbKHRlVcqxu4BcUQZieECKVm2BL64E6VLpniu9";
$accessToken = "1536502778-yljjSCExT6luWw86XgQrhgq29iHxuvVCEB5radX";
$accessTokenSecret = "HtklICer9ZSLqA09zCR8bDST3hSphCOUs5Bjc32HLaE6M";

$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);


//search words
$andkey = "花火";
$options = array('q'=>$andkey,'count'=>'1');

$json = $twObj->OAuthRequest(
    'https://api.twitter.com/1.1/search/tweets.json',
    'GET',
    $options
);

$jset = json_decode($json, true);

foreach ($jset['statuses'] as $result){
    $name = $result['user']['name'];
    $link = $result['user']['profile_image_url'];
    $content = $result['text'];
    $updated = $result['created_at'];
    $time = $time = date("Y-m-d H:i:s",strtotime($updated));

    echo "<img src='".$link."''>"."&nbsp;|&nbsp;".$name."&nbsp;|&nbsp;".$content."&nbsp;|&nbsp;".$time;
	echo '<br>';
}
echo '<br>';




//additional
$followers = $twObj->get('followers/ids', array('cursor' => -1));
$friends = $twObj->get('friends/ids', array('cursor' => -1));
var_dump($friends);
foreach ($friends->ids as $key => $value) {
	var_dump($value);
	echo '<br>';
}



$options = array('user_id'=>496625278,'count'=>'50');
$vRequest = $twObj->OAuthRequest(
    'http://api.twitter.com/1.1/friends/ids.json',
    'GET',
    $options
);

$jset = json_decode($vRequest, true);

/*foreach ($jset as $result){
	var_dump($result);
	echo '<br>';
}*/



//var_dump($friends->ids[11]);
/*
foreach ($followers->ids as $i => $id) {
	if (empty($friends->ids) or !in_array($id, $friends->ids)) {
		$twObj->post('friendships/create', array('user_id' => $id));
	}
}
*/

?>