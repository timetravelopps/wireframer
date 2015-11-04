<?php
include_once('db.php');

$db = new DB();
$idArray    = explode(",",$_REQUEST['ids']);
$db->updateOrder($idArray);
// Removed the ending PHP tag. See notes for why.
