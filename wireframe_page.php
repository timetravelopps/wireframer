<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" href="css/wireframer-theme.css" />
	<link rel="stylesheet" href="css/no-scrollbar.css" />
	<script src="js/jquery-2.2.4.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="js/no-scrollbar.js"></script>
</head>
<body>

<?php
require_once("db.php");
require_once("session.php");

$db = new DB();
foreach($db->getRows() as $row) {
	$templateFile = __DIR__ . "/template/$row[element].html";
	if(!file_exists($templateFile)) {
		die("Error: Template not found ($row[element])");
	}

	$html = file_get_contents($templateFile);

	if(strstr($row["content"], "{")) {
		$contentArray = explode("{", $row["content"]);
		foreach ($contentArray as $c) {
			if(empty($c)) {
				continue;
			}

			$cParts = explode("}", $c);
			$html = preg_replace("/\{\($cParts[0]\).*\}/", $cParts[1], $html);
		}
	}
	else {
		$html = preg_replace("/\{.*\}/", $row["content"], $html);
	}

	echo $html;
}
?>

</body>
</html>