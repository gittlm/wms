<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;


// $params = array(
//   "type" => 2,
//   "table" => "part_small_sort"
// );
// $part_manager->class_menu_list($params);
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
    .table{
      width: 90% !important;
      margin-left: auto !important;
      margin-right: auto !important;
    }
    .table tr td{
      padding: 4px !important;
      height: 32px !important;
      vertical-align: middle !important;
    }
    .table tr td:first-child{
      width: 35% !important;
    }
    .table input{
      height: 32px !important;
    }
    .table select{
      padding: 2px 4px !important;
      height: 32px !important;
    }
    .table textarea{
      width: 100% !important;
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
      <!-- <div class="box-header with-border"> -->
        <p style="font-size: 1.5rem;margin-left: 1rem;"><strong>添加入库单</strong></p>
      <table class="table table-striped" style="margin-top: 20px;">
       <tbody>
        <tr>
          <td class="text-right"><strong>大类 :</strong></td>
          <td>
            <select name="big_sort" class="form-control" id="big_sort_id">
              <option value="0">请选择大类名称</option>
            <?php 
            $params = array(
              "type" => 1,
              "table" => "part_big_sort",
              "select_id" => $big_id
            );
            $part_manager->class_menu_list($params);
            ?>  
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>小类 :</strong></td>
          <td>
            <select name="small_sort" class="form-control" id="small_sort_id">
              <option value="0" class="one_option">请选择小类名称</option>   
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>物品名称 :</strong></td>
          <td>
            <select name="part_items_id" class="form-control" id="part_items_id">
              <option value="0" class="two_option">请选择物品名称</option>
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>品牌 :</strong></td>
          <td>
            <input type="text" value="" class="form-control" id="brand">
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>供货商 :</strong></td>
          <td>
            <input type="text" value="" class="form-control" id="supplier">
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>供货商电话 :</strong></td>
          <td>
            <input type="text" value="" class="form-control" id="supplier_tel">
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>数量 :</strong></td>
          <td>
            <input type="text" value="" class="form-control" id="num">
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>单价 :</strong></td>
          <td>
            <input type="text" value="" class="form-control" id="unit_price">
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>采购人 :</strong></td>
          <td>
            <select name="buyer_id" class="form-control" id="buyer_id">
              <option value="0">请选择采购人</option>
              <?php 
              $params = array(
                "type" => 2,
                "table" => "com_managers",
                "up_name" => "rights",
                "up_id" => 4
              );
              $part_manager->class_menu_list($params);
              ?> 
            </select>  
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>采购日期 :</strong></td>
          <td>
            <input class="form-control mbsc-comp" name="buy_date" id="buy_date" placeholder="请选择日期与时间" readonly="" type="text">
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>操作员 :</strong></td>
          <td>
            <select name="operator_id" class="form-control" id="operator_id">
              <option value="0">请选择操作员</option>
              <?php 
                $params = array(
                  "type" => 2,
                  "table" => "com_managers",
                  "up_name" => "rights",
                  "up_id" => 2
                );
                $part_manager->class_menu_list($params);
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td class="text-right"><strong>备注 :</strong></td>
          <td>
            <textarea name="remarks" id="remarks" rows="2"></textarea>
          </td>
        </tr>
       </tbody>
      </table>
      <button class="btn btn-primary pull-right" style="margin-right: 2rem;" id="put_in_btn">提交入库</button>
      <span class="warning_span pull-right" style="color: red;line-height: 34px;margin-right: 10px;"></span>
    </section>
    <!-- /.content -->
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
<script src="js/add_put_in.js"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("添加入库单");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>