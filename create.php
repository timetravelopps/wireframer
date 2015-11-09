<?php
require_once("db.php");
require_once("view.php");

$db = new DB();
$view = new View("create");

if(isset($_POST['element'])) {
  $name = $_POST['element'];
  $content = isset($_POST['content']) ? $_POST['content'] : "";

  $success = $db->create([
    ":name" => $name,
    ":content" => $content,
  ]);

  if($success !== false) {
    header("Location: /create.php?success", 303);
    exit;
  }
  else {
    $view->injectParameters([
      "{MESSAGE}" => "Something went wrong...please try again"
    ]);
  }
}
else if(isset($_GET["success"])) {
  $view->injectParameters([
    "{MESSAGE}" => "Added to your Content Hierarchy!"
  ]);
}
else {
  $view->injectParameters([
    "{MESSAGE}" => ""
  ]);
}

//Fetch all records from database
$rows = $db->getRows();
foreach($rows as $row) {
  $view->injectSubView("{ELEMENT_LIST}", "_element", [
    "{ID}" => $row["id"],
    "{ELEMENT}" => $row["element"],
    "{CONTENT}" => $row["content"],
  ]);
}
if(empty($rows)) {
  $view->injectParameters(["{ELEMENT_LIST}" => ""]);
}

$view->render();