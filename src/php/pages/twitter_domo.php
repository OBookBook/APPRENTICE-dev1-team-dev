<?php
require_once './../classes/Twitter.php';

$twitterPoster = new Twitter();
$tweetMessage = 'TwitterAPIのテスト';
$twitterPoster->tweet($tweetMessage);
