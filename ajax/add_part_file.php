<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;

if($_POST){
	if ($_POST['type'] == 1) {
	//添加大类
		$result = $part_manager->add_big_sort($_POST);
	}else if ($_POST['type'] == 2) {
	//添加小类	
		$result = $part_manager->add_small_sort($_POST);
	}else if ($_POST['type'] == 3)  {
	//添加物品
		$result = $part_manager->add_part($_POST);
	}else {
	//添加图片
		$result = $part_manager->insert_part_items_pic_to_db($_POST);
	}
}

echo json_encode($result);
?>