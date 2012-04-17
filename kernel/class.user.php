<?php

/* prototype functions */
/* please add error checking & sollision checks */

class User {

	private $user_id;
	private $data;
	private $redis;

	function __construct($id=0) {
		global $redis;
		if (is_object($redis)) {
			$this->redis = $redis;
		} else {
			die('Redis not initialized');
		}
		if ( $id && ($user = $this->getUserById($id)) ) {
			$this->user_id = $id;
			$this->user_data = $user;
		}
	}


	function createUser($user_data) {
		if ( !$this->redis->get('users:email:'.$user_data['email']) ) {
			$_id = sha1(microtime(true).$user_data['email']);
			$user_data['id'] = $_id;
			$this->redis->hMset(USER_DATA.$_id, $user_data);
			$this->redis->set('users:email:'.$user_data['email'], $_id);
			$this->user_id = $_id;
			$this->data = $user_data;
		} else {
			return 0;
		}
	}

	function __get($property) {
		if ( array_key_exists($property, $this->user_data)) {
			return $this->user_data[$property];
		}
		trigger_error('Undefined property '.$property, E_USER_NOTICE);
		return NULL;
	}

	function getId() {
		return $this->user_id;
	}

	function removeUser() {
		if ( empty($this->user_id) ) {
			return false;
		}
		// Remove user tweets:
		$user_tweets = $this->redis->hgetall(USER_TWEETS.$this->user_id);
		foreach($user_tweets as $tweet_id) {
			$this->redis->del(TWEETS.$tweet_id);
		}
		$this->redis->del(USER_TWEETS.$this->user_id);
		// Remove following + followers
		while(($follower_id = $this->redis->spop(FOLLOWERS.$this->user_id))) {
			$this->redis->srem(FOLLOWING.$follower_id, $this->user_id);
		}
		$this->redis->del(FOLLOWERS.$this->user_id);
		// Redis who was followed
		while(($followed_id = $this->redis->spop(FOLLOWING.$this->user_id))) {
			$this->redis->srem(FOLLOWERS.$follower_id, $this->user_id);
		}
		$this->redis->del(FOLLOWING.$this->user_id);
	
		// Remove user data:
		$email = $this->redis->hget(USER_DATA.$this->user_id, 'email');
		// Remove lookup string
		$this->redis->del('users:email:'.$email);
		$this->redis->del(USER_DATA.$this->user_id);
		return ;
	}

	function getUserByEmail($email) {
		$data = array();
		$_id = $this->redis->get('users:email:'.$email);
		if ( ! $_id ) {
			return false;
		}
		$data = $this->redis->hgetall(USER_DATA.$_id);	
		$this->user_id = $_id;
		$this->user_data = $data;
		return $data;
	}

	function getUserById($id) {
		$data = array();
		$data = $this->redis->hgetall(USER_DATA.$id);
		if ( count($data)) {
			$this->user_id = $id;
			$this->user_data = $data;
			return $data;
		} else {
			return false;
		}
	}

	function addTweet($tweet_data) {
		if ( empty($this->user_id) ) {
			return false;
		}
		$tweet_id = sha1(microtime(true). serialize($tweet_data));
		$this->redis->hMset(TWEETS.$tweet_id, $tweet_data); /* collision check needed */
		$this->redis->sadd(USER_TWEETS.$this->user_id, $tweet_id);
	}


	function removeTweet($tweet_id) {
		if ( empty($this->user_id) ) {
			return false;
		}
		$this->redis->del(TWEETS.$tweet_id); /* removing tweet data */
		$this->redis->srem(USER_TWEETS.$this->user_id, $tweet_id);
	}

	function randomTweet() {
		if ( empty($this->user_id) ) {
			return false;
		}
		$data = array();
		$tweet_id = $this->redis->sRandMember(USER_TWEETS.$this->user_id);
		if ( !empty($tweet_id)) {
			$data = $this->redis->hgetall(TWEETS.$tweet_id);
		}
		return $data;
	}

	function countTweets() {
		if ( empty($this->user_id) ) {
			return false;
		}
		return $this->redis->scard(USER_TWEETS.$this->user_id);
	}

	function followUser($follower_id ) {
		if ( empty($this->user_id) ) {
			return false;
		}
		if (!$this->redis->sismember(FOLLOWERS.$follower_id, $this->user_id)) { /* is user already followed? */
			$this->redis->sadd(FOLLOWERS.$follower_id, $this->user_id);
			$this->redis->sadd(FOLLOWING.$this->user_id, $follower_id);
			return 1;
		}
		return 0;
	}

	function getFollowers($id_only = false) {
		if ( empty($this->user_id) ) {
			return false;
		}
		$users = array();
		$followers = $this->redis->sInter(FOLLOWERS.$this->user_id);
		foreach($followers as $follower_id ) {
			if ( $id_only ) {
				$users[$follower_id] = $follower_id;
			} else {
				$users[$follower_id] = $this->redis->hgetall(USER_DATA.$follower_id);
			}
		}
		return $users;
	}

	function getFollowing($id_only = false) {
		if ( empty($this->user_id) ) {
			return false;
		}
		$users = array();
		$following = $this->redis->sInter(FOLLOWING.$this->user_id);
		foreach( $following as $followed_id ) {
			if ( $id_only ) {
				$users[$followed_id] = $followed_id;
			} else {
				$users[$followed_id] = $this->redis->hgetall(USER_DATA.$followed_id);
			}
		}
		return $users;
	}

	function unfollowUser($follower_id ) {
		if ( empty($this->user_id) ) {
			return false;
		}
		$this->redis->srem(FOLLOWERS.$follower_id, $this->user_id);
		$this->redis->srem(FOLLOWING.$this->user_id, $follower_id);
	}

	/* I'm suing simple method, to intersect all tweets and get needed count */
	/* But better way is to keep special list for each user, where store all tweets from his followers */
	function getTweets( $params) {
		if ( empty($this->user_id) ) {
			return false;
		}
		$messages = array();
		if ( !empty($params['self_only']) ) {
			$key = USER_TWEETS.$this->user_id;
		} else {
			$key = 'line:'.$this->user_id;
			if ( !$this->redis->exists($key) ) {
				$following = $this->getFollowing( true );
				foreach( $following as $id => $value ) {
					$following[$id] = USER_TWEETS.$value;
				}
				$parameters = array_merge(array( $key, USER_TWEETS.$this->user_id ) , $following );
				$r = call_user_func_array(array($this->redis, 'sUnionStore'), $parameters);
				$this->redis->expire($key, 1);
			}
		}
		$tweets = $this->redis->sort($key, $params);
		foreach($tweets as $tweet_id ) {
			$messages[$tweet_id] = $this->redis->hgetall(TWEETS.$tweet_id);
		}
		return $messages;
	}



}

?>
