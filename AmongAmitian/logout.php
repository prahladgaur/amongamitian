<?php

session_start();
if(isset($_SESSION['amomgamity_userid']))
{
	$_SESSION['amomgamity_userid'] = NULL;
	unset($_SESSION['amomgamity_userid']);
}

header("Location: login.php");
die;