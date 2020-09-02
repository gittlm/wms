<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../../lib/part_manager.php");

$part_manager = new part_manager;

if($_POST){
	if ($_POST['type'] == 1) {
	//修改大类
		$result = $part_manager->change_big_sort($_POST);
	}else if ($_POST['type'] == 2) {
	//修改小类	
		$result = $part_manager->change_small_sort($_POST);
	}else if ($_POST['type'] == 3)  {
	//修改物品
		$result = $part_manager->change_part_items($_POST);
	}else if ($_POST['type'] == 4)  {
	//删除图片
		$result = $part_manager->delete_part_items_pic_to_db($_POST);
	}
}

echo json_encode($result);
?>