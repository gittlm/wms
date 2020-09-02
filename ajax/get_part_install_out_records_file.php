<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;
//获取流程单上安装物品的出库记录
if($_POST){
	$result = $part_manager->list_part_install_out_records($_POST);
}

// echo json_encode($result);
?>