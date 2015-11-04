<?php 

require_once('db.php');

$db = new Db();

if( isset($_GET['del'])){
	$id = $_GET['del'];
	$db->delete(["id" => $id]);
	header("Location: create.php", 303);
}
// Removed the ending PHP tag. See notes for why.
