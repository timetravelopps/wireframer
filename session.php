<?php
session_start();

$id_vars = ["userID", "projectID"];
$forward = false;
foreach($id_vars as $i) {
	if(isset($_GET[$i])) {
		$_SESSION[$i] = $_GET[$i];
		$forward = true;
	}
}

if($forward) {
	header("Location: " . strtok($_SERVER["REQUEST_URI"], "?"));
	exit;
}

$error = false;
foreach ($id_vars as $i) {
	if(!isset($_SESSION[$i])) {
		$error = true;
		echo "Missing variable: $i - please set in querystring. <br />";
	}
}
if($error) {
	exit;
}