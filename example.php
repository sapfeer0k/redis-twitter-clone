<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
date_default_timezone_set('America/New_York');

require_once('kernel/definitions.php');
require_once('kernel/connection.php');
require_once('kernel/class.user.php');
include_once('smarty/libs/Smarty.class.php');


$user = new User();

$user_data = array( 'name' => 'sLomakov', 'email' => 'sapfeer0k@gmail.com', 'password' => '12345', 'date' => time() );

/*
$id = $user->createUser($user_data);

if ( 0 && !$id ) {
	print("User already exists!");
}
*/
echo '<pre>';

$user->getUserByEmail('sapfeer0k@gmail.com');

$pupkin = new User();
$pupkin->getUserByEmail('ivan@pupkin.net');

//$user = getUserByEmail('sapfeer0k@gmail.com');
//print_r($user);
$user->followUser( $pupkin->getId() );

die();

$tweet_data = array( 'message' => 'This tweet message was add at '.date('H:i:s'). ' by '.$user->email, 'time' => time(), 'owner' => $user->id );
$tweet_data_pupkin = array( 'message' => 'This tweet message was add at '.date('H:i:s'). ' by '.$pupkin->email, 'time' => time(), 'owner' => $pupkin->id );

//$user->addTweet($tweet_data);
//$pupkin->addTweet($tweet_data_pupkin);

echo "User: ";
print_r($user);

echo "<br />";

$followers = $user->getFollowers();
echo "Followers: ";
print_r($followers);

echo "<br />";

$following = $user->getFollowing();
echo "Following: ";
print_r($following);


echo "Tweets: ";
$tweets = $user->getTweets(array('by' => TWEETS.'*->time', 'sort' => 'desc', 'limit' => array(0,200), 'self_only' => false ));
print_r($tweets);
// $following 

?>
