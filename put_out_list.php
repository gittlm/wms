<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;


$id = $_GET['id'];
$name = $_GET['name'];


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
  <link rel="stylesheet" href="../AdminLTE/plugins/iCheck/minimal/blue.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/mobisscroll/css/mobiscroll.custom.min.css">
  <link rel="stylesheet" href="../AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../AdminLTE/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="css/custom_style.css?v=20180919">
  <style>
    .table{
      margin-bottom: 20px;
      /*background-color: rgba(0,0,0,0.1);*/
    }
    #choose_num{
      padding-left: 5px;
    }
    .table tr:first-child{
      background-color: #d3f2ef !important;
    }
    .box-header{
      padding: 0px 10px 20px 10px !important;
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
    <section class="content container-fluid" style="padding: 20px 10px;min-height: 350px;">
        <div class="box box-primary">
          <div class="box-header with-border" style="border-bottom: 1px solid #ccc !important;">
            <form name="search_form" class="form-inline" id="search_form" role="form">
                <div class="form-group">
                  <div class="pull-left">
                    <strong>物品名称 : </strong><?=$name?>
                  </div>
                  <div class="pull-right">
                    <a href="put_out_wait.php"><span><i class="fa fa-cart-plus" style="font-size: 25px;color:green;padding-right: 10px;"></i></span></a>
                  </div>
                </div>
            </form>
          </div>
    <?php
      $params = array(
        "part_items_id" => $id
      );
    $part_manager->list_part_entry_orders_sameparts($params,1,20);
    ?>
 
    </section>
    <div class="btn_list" style="padding: 0px 20px;margin-bottom: 50px;">
      <input type="checkbox" id="check_all"> 全选
      <button type="button" class="btn btn-default pull-right" id="choose_btn">提交</button>
      <span style="color: red;margin-right: 10px;" class="warning_span pull-right"></span>
    </div>
    <!-- /.content -->
  </div>
<?php
include_once "inc/parts_detail_modal.php"
?>
<?php
include_once('inc/main_footer.php');
?>
</div>

<script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/headroom.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/jquery.headroom.js"></script>
<script src="../AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="js/app.js?v=20180919"></script>
<script src="js/starter.js?v=20181201"></script>
<script src="js/put_out_list.js?v=20200515"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("物品领取/添加到待出库");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>