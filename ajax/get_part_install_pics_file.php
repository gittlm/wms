<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;
//获取流程单上的图片
if($_POST){
	$result = $part_manager->list_part_install_pic($_POST);
}

echo json_encode($result);
?>