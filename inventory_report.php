<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;
$common = new common;

if($_GET['page']){
  $page = mysql_real_escape_string($_GET['page']);
}else{
  $page = 1;
}
$num = 20;

$keyword = $_POST["k"] ? $_POST["k"] : $_GET["k"];
$l1 = $keyword ? "?k=".$keyword."&" : "?";

$link = $l1;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <title><?=$app_name?>-仓储应用端</title>
  <link rel="shortcut icon" href="../images/favicon.ico">
  <link rel="apple-touch-icon" href="../images/touch-icon.png">
  <link rel="stylesheet" href="../AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/mobisscroll/css/mobiscroll.custom.min.css">
  <link rel="stylesheet" href="../AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../AdminLTE/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="css/custom_style.css?v=20180919">
  <style>
    .row{
      padding: 10px 0px !important;
      font-size: 1.5rem !important;
    }
    form{
      width: 100% !important;
    }
    form .form-group:first-child{
      width: 100% !important;
      margin-bottom: 0px !important;
    }
    form .form-group span{
      display: inline-block;
      width: 30% !important;
      height: 30px;
      line-height: 30px;
      background-color: rgba(0,0,0,0.1);
    }
    form .form-group select{
      width: 70%;
      height: 30px;
      line-height: 30px;
      padding-left: 5px !important;
      border-width: 1px;
      border-color: rgba(0,0,0,0.1);
    }
    form .form-group input{
      width: 70%;
      height: 30px;
      line-height: 30px;
      padding-left: 5px !important;
      border-width: 1px;
      border-color: rgba(0,0,0,0.1);
    }
  </style>
  <!--[if lt IE 9]>
  <script src="../AdminLTE/plugins/html5shiv.min.js"></script>
  <script src="../AdminLTE/plugins/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue fixed">
<div class="wrapper">
<?php
include_once('inc/main_header.php');
?>
  <aside class="main-sidebar" style="padding-top: 70px;">
    <section class="sidebar">
      <div style="padding-left: 20px;">
        <p style="color: #fff;font-size: 20px;">思问云仓储系统</p>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="background-color: #294f65;"></li>
<?php
include_once('inc/sidebar_menu.php');
?>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper" style="padding-top: 0px !important;">
    <!-- Main content -->
    <section class="content container-fluid" style="padding: 20px 10px;">
        <div class="box box-primary">
          <div class="box-header with-border" style="border-bottom: none;">
            <form method="post" action="ajax/get_inventory_report_csv_file.php" class="text-center">
              <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">
                      <span>选择大类</span><select name="big_sort_id" id="big_sort_id">
                        <option value="0">选择大类名称</option>
                        <?php 
                        $params = array(
                          "type" => 1,
                          "table" => "part_big_sort"
                        );
                        $part_manager->class_menu_list($params);
                        ?>                 
                      </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">
                      <span>选择小类</span><select name="small_sort_id" id="small_sort_id">
                        <option value="0" class="one_option">选择小类名称</option>
                 
                      </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">
                      <span>选择物品</span><select name="part_items_id" id="part_items_id">
                        <option value="0" class="thr_option">选择物品名称</option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-xs-12">
                  <div class="form-group">
                    <span>截止日期</span><input type="date" name="date" id="date" placeholder="库存截止日期">
                  </div>
                </div>
              </div>  
              <div class="text-center" style="margin-top: 100px;">
                <div class="form-group">
                  <button type="submit" name="search_btn" id="search_btn" class="btn btn-success" style="width: 100px;"> 查询 </button>
                </div>
              </div>
            </form>
          </div>
        </div>  
    </section>

  </div>

<?php
include_once('inc/main_footer.php');
?>
</div>

<script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/headroom.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/jquery.headroom.js"></script>
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="js/app.js?v=20180919"></script>
<script src="js/starter.js?v=20181202"></script>
<script src="js/inventory_report.js"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("生成库存报表");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>