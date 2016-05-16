<?php
include_once("db.php");
include_once("view.php");

$db = new DB();
$view = new View("index");

$rows = $db->getRows();
foreach($rows as $row) {
	$view->injectSubView("{ELEMENT_LIST}", "_index-element", [
		"{ELEMENT}" => $row["element"],
		"{CONTENT}" => $row["content"],
	]);
}

$view->render();