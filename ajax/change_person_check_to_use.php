<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;
//修改个人库存为使用状态
if($_POST){
	$result = $part_manager->change_person_stock($_POST);
}

echo json_encode($result);


?>