<?php



function action_login($params) {
	print_r($params);
	if (isset($params['email']) && isset($params['password'])) {
		global $redis;
		$user = new User();
		$user_data = $user->getUserByEmail($params['email']);
		if ($user_data) {
			if ($user_data['password'] == sha1($params['password'])) {
				$_SESSION['user_id'] = $user->getId();
				header('Locaton: /');
				die();
			}
		}
	}
	return false;
}

function action_logout() {

}

function action_dashboard() {
	global $smarty, $user, $redis;
	$params = array('by' => TWEETS.'*->time', 'sort' => 'desc', 'self_only' => false );
	$tweets = $user->getTweets($params);
	foreach($tweets as $id => $tweet ) {
		$tweets[$id]['username'] = $redis->hget(USER_DATA.$tweet['owner'], 'name');
	}
//	print_r($tweets);
	$smarty->assign('tweets', $tweets);
	$smarty->assign('username', $user->name);
	$smarty->display('dashboard.tpl');
	die();
}

function isLogged() {

	return false;
}



?>
