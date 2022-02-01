<?php 
session_start();
echo <<<_INIT
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel='stylesheet' href='styles.css'>
<script src='javascript.js'></script>
_INIT;
require_once 'functions.php';
$userstr = 'Welcome Guest';
if (isset($_SESSION['user']))
{
$user = $_SESSION['user'];
$loggedin = TRUE;
$userstr = "Logged in as: $user";
}
else $loggedin = FALSE;
echo <<<_MAIN
<title>$user's Nest: $userstr</title>
</head>
<body>
<div data-role='page'>
<div data-role='header'>
<div id='logo' class='center'>J <img id='name' src='image/letter_A.png' width=50>AGAN's Nest</div>
<div class='username'>$userstr</div>
</div>
<div data-role='content'>
_MAIN;
if ($loggedin)
{
echo <<<_LOGGEDIN
<div class='center'>
<a data-role='button' data-inline='true' data-icon='home'data-transition="slide" href='members.php?view=$user'>Home</a>
<a data-role='button' data-inline='true'data-transition="slide" href='members.php'>Members</a>
<a data-role='button' data-inline='true'data-transition="slide" href='friends.php'>Friends</a>
<a data-role='button' data-inline='true'data-transition="slide" href='messages.php'>Messages</a>
<a data-role='button' data-inline='true'data-transition="slide" href='profile.php'>Edit Profile</a>
<a data-role='button' data-inline='true'data-transition="slide" href='logout.php'>Log out</a>
</div>
_LOGGEDIN;
}
else
{
echo <<<_GUEST
<div class='center' id='nav-button'>
<a data-role='button' data-inline='true' data-icon='home'data-transition='slide' href='index.php'>Home</a>
<a data-role='button' data-inline='true' data-icon='plus'data-transition="slide" href='signup.php'>Sign Up</a>
<a data-role='button' data-inline='true' data-icon='check'data-transition="slide" href='login.php'>Log In</a>
</div>
<p class='info'>(You must be logged in to use this app)</p>
_GUEST;
}
?>