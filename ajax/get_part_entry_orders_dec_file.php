<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;
//添加入库单
if($_POST){
	$result = $part_manager->part_entry_orders_dec($_POST);
}

// echo json_encode($result);
?>