<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;

// $params = array(
//   "search_id" => $_POST['search_id']
// );
// $params = array(
//     "big_part_id"=> $_POST["big_part_id"],//大类ID
//     "small_part_id"=> $_POST["small_part_id"],//小类ID
//     "part_items_id"=> $_POST["part_items_id"],//物品ID
//     "brand"=> $_POST["brand"],//品牌
//     "match_model"=> $_POST["match_model"],//适配型号
//     "remarks"=> $_POST["remarks"],//备注
//     "put_in_begin"=> $_POST["put_in_begin"],//开始日期
//     "put_in_end"=> $_POST["put_in_end"]//结束日期
// )
$params['big_part_id'] = $_POST['big_part_id'];
$params['small_part_id'] = $_POST['small_part_id'];
$params['part_items_id'] = $_POST['part_items_id'];
$params['brand'] = $_POST['brand'];
$params['match_model'] = $_POST['match_model'];
$params['remarks'] = $_POST['remarks'];
$params['put_in_begin'] = $_POST['put_in_begin'];
$params['put_in_end'] = $_POST['put_in_end'];

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
          <div class="box-header with-border" style="border-bottom: 1px solid #ccc !important;">
            <form name="search_form" class="form-inline" id="search_form" role="form">
                <div class="form-group">
                  <div class="pull-left">
                    搜索结果
                  </div>
                </div>
            </form>
          </div>
      <table class="table table-striped text-center" style="margin-top: 20px;">
        <thead>
          <tr>
            <th>物品名称</th>
            <th>库存数量</th>
            <th>查看</th>
          </tr>
        </thead>
        <tbody>
<?php
$part_manager->search_list_part_entry_orders_sum($params);
?>
        </tbody>
      </table>
    </section>
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
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="js/app.js?v=20180919"></script>
<script src="js/starter.js?v=20181205"></script>
<script src="js/put_out_search.js"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("物品领取/搜索结果");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>