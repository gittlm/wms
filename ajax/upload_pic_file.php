<?php
header("Content-Type: text/html;charset=utf-8");

include_once('../../lib/pic.php');
include_once('../../lib/part_manager.php');
$part_manager = new part_manager;
$pic = new pic;
$basepath = "../../";

//上传图片到服务器
if($_POST["imgdata"]){
   $result = $pic->save_to_server_folder($part_manager->com_id,$_POST["imgdata"],$basepath,"pic_part_items");
}
echo json_encode($result);
?>