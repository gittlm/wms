<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;
//编辑入库单
if($_POST){
	if ($_POST['type'] == 1) {
	//获取入库单详细信息
		$result = $part_manager->part_entry_orders_edit_dec($_POST);
	}else if ($_POST['type'] == 2) {
	//提交编辑信息	
		$result = $part_manager->edit_part_entry_orders($_POST);
		echo json_encode($result);
	}
}


?>