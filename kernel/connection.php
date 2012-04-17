<?php


try {
	$redis = new Redis;
	$redis->connect('localhost', 6379);
	
} catch (RedisException $e) {
	print_r($e);
	die('Redis error');
}


?>
