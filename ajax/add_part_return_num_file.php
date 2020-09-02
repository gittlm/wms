<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;
//物品归还
if($_POST){
	if ($_POST['type'] == 1) {
	//旧件归还
		$result = $part_manager->part_return_into_out_records($_POST);
	}else if ($_POST['type'] == 2) {
	//新建归还	
		$result = $part_manager->part_return_into_entry_orders($_POST);
	}else if ($_POST['type'] == 3) {
	//入库单返厂	
		$result = $part_manager->part_entry_orders_return_goods($_POST);
	}
	
}

echo json_encode($result);
?>