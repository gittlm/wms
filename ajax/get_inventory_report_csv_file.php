<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;

if($_POST){
	$result = $part_manager->inventory_report_csv($_POST);
}

// echo json_encode($result);
?>