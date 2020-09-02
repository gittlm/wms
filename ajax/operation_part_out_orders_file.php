<?php
header("Content-Type: text/html;charset=utf-8");

include_once('../../lib/part_manager.php');
$part_manager = new part_manager;
//撤销出库单
if($_POST){
	$result = $part_manager->operation_part_out_orders($_POST);
}
echo json_encode($result);
?>