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
            <h4>物品退回到厂家列表</h4>
           <!--  <form name="search_form" class="form-inline" method="post">
                <div class="form-group">
                  <div class="pull-left">
                    <button type="button" class="btn btn-default" name="btn_add"><i class="fa fa-plus text-green"></i></button>　
                  </div>
                  <div class="input-group">
                    <input name="k" type="text" class="form-control" placeholder="物品名称/品牌/备注" maxlength="30">
                    <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
                  </div>
                </div>
            </form> -->

          </div>
          <table class="table table-striped text-center">
            <thead>
              <th>入库单号</th>
              <th>物品名称</th>
              <th>退回数量</th>
              <th>操作日期</th>
            </thead>
          <?php 
            $result = $part_manager->list_part_return_goods($page,$num);
          ?>
          </table>
           <?php
          // $common->sunder($link,$result);
          ?>
        </div>
    </section>
    <!-- /.content -->

  </div>
<?php
include_once('inc/parts_detail_modal.php');
?>
<?php
include_once('inc/main_footer.php');
?>
</div>
<!-- 点击入库单号显示详细信息 -->
<!-- <div  id="put_in_modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">入库单信息</h4>
      </div>
      <div class="modal-body">
        <div id="put_in_list_content">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #000;">确定</button>
      </div>
    </div>
  </div>
</div> -->
<!-- 修改入库单 -->
<!-- <div id="put_in_modal_edit" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">入库单信息编辑</h4>
      </div>
      <div class="modal-body">
        <div id="put_in_list_content_edit">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" name="btn_edit_submit" id="btn_edit_submit" class="btn btn-success"> 修改 </button>
      </div>
    </div>
  </div>
</div> -->
<!-- 返回厂家模态框 -->
<!-- <div  id="return_to_com" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">物品返回厂家信息</h4>
      </div>
      <div class="modal-body">
        <div class="body_content">
          <span>库存数量</span><input type="number" id="stock_num" readonly style="background-color: rgba(0,0,0,0.05);">
        </div>
        <div class="body_content">
          <span>返厂数量</span><input type="number" id="return_com_num">
        </div>
      </div>
      <div class="modal-footer">
        <span class="warning_btn" style="background-color: transparent;width: auto;color:red;"></span>
        <button type="button" class="btn btn-default" style="color: #000;" id="return_num_btn">确定</button>
      </div>
    </div>
  </div>
</div>  -->
<script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/headroom.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/jquery.headroom.js"></script>
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="js/app.js?v=20180919"></script>
<script src="js/starter.js?v=20181202"></script>
<script src="js/put_in.js?v=20200613"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("返厂列表");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>