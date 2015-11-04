<?php 
require_once('db.php');
require_once('view.php');

$db = new Db();

if( isset( $_GET['edit']) ){
	$id = $_GET['edit'];

	$row = $db->get(["id" => $id])[0];

	if( isset($_POST['newName']) ) {
		$newName = $_POST['newName'];
		$id 	 = $_GET['edit'];
		$db->edit([
			"id" => $id, 
			"newName" => $newName,
		]);
		header("Location: create.php", 303);
		exit;
	}
}

$view = new View("edit");
$view->injectParameters([
	"{ELEMENT}" => $row["element"],
]);
$view->render();