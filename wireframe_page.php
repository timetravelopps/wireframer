<?php
require_once("db.php");
require_once("session.php");

$db = new DB();
foreach($db->getRows() as $row) {
	// TODO: Output correct template.
}
