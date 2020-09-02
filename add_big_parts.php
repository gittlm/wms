<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;


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
    .table tr td{
      vertical-align: middle !important;
    }
    .box-header.with-border{
      border-bottom: none !important;
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
          <div class="box-header with-border">
            <form name="search_form" class="form-inline" id="search_form" role="form">
                <div class="form-group">
                  <div class="pull-left">
                    <button type="button" class="btn btn-default" name="btn_add" data-toggle="modal" data-target="#add_big_sort"><i class="fa fa-plus text-green"></i> 添加大类</button>　
                  </div>
                  <!-- <div class="input-group">
                    <input name="k" id="k" type="text" class="form-control" placeholder="大类名称" maxlength="30">
                    <span class="input-group-btn"><button class="btn btn-default" type="submit" form="search_form"><i class="fa fa-search"></i></button></span>
                  </div> -->
                </div>
            </form>
          </div>
      <table class="table table-striped text-center" style="margin-top: 20px;">
       <tbody>
<?php
$params = array(
  "type" => 1,
  "table" => "part_big_sort",
  "k" => ''
);
$part_manager->part_sort_list($params,1,100);
?>
       </tbody>
      </table>
    </section>
    <!-- /.content -->
  </div>

<?php
include_once('inc/main_footer.php');
?>
</div>
<!-- ./wrapper -->
<!-- 添加一级分类 -->
<div class="modal fade" id="add_big_sort" role="dialog" aria-hidden="true">
  <form action="add_big_parts.php" method="post" id="add_big_sort_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">添加大类</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="repair_time"><h5>大类名称：</h5></label>
            <input class="form-control" name="name" id="big_sort" placeholder="请输入名称" required />
          </div>
        </div>
        <div class="modal-footer">
          <div class="text-right">
            <!-- <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">取消</button> -->
            <button type="submit" class="btn btn-primary"> 确定提交 </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- 修改一级分类 -->
<div class="modal fade" id="edit_big_sort" role="dialog" aria-hidden="true">
  <form action="" method="post" id="edit_big_sort_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">修改大类</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="repair_time"><h5>大类名称：</h5></label>
            <input class="form-control" name="name" id="big_sort_edit" placeholder="请输入名称" required />
          </div>
        </div>
        <div class="modal-footer">
          <div class="text-right">
            <!-- <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">取消</button> -->
            <button type="submit" class="btn btn-primary"> 确定提交 </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/headroom.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/jquery.headroom.js"></script>
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="js/app.js?v=20180919"></script>
<script src="js/starter.js?v=20181202"></script>
<script src="js/add_big_parts.js"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("添加/大类");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>