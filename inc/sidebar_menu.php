<?php
include_once("../params.php");
include_once("../lib/common.php");

$common = new common;
$common->list_column($GLOBALS["app_wms_column"]);
?>