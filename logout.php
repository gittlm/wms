<?php
header("Content-Type: text/html;charset=utf-8");

include_once("../lib/com_manager.php");

//开启session
session_start();

//清空session信息
$_SESSION = array();

//清除客户端sessionid
if(isset($_COOKIE[session_name()])){
  setCookie(session_name(),'',time()-3600,'/');
}

//彻底销毁session
session_destroy();
header("Location:/skip_page");
?>