<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;


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
  <link rel="stylesheet" href="css/custom_style.css?v=20180920">
  <link href="css/jquery.searchableSelect.css" rel="stylesheet" type="text/css">
  <style>
    .table{
      margin-bottom: 0px;
    }
    .table tr:first-child{
      background-color: #d3f2ef !important;
    }
    .table tr td{
      padding: 8px 3px !important;
    }
    .table tr td:nth-child(1){
      width: 33%;
    }
    .table tr td:nth-child(2){
      width: 17%;
    }
    .table tr td:nth-child(3){
      width: 25%;
    }
    .table tr td:nth-child(4){
      width: 25%;
    }
    .box-header{
      padding: 10px 10px 20px 10px !important;
    }
     #choose_num{
      padding-left: 5px;
    }
    @media only screen and (max-width: 768px) {
      .searchable-select{
        float: right;
        margin-right: 5px;
        min-width: 80px !important;
      }
    }
    @media only screen and (min-width: 768px) {
      .searchable-select{
        float: right;
        margin-right: 20px;
        min-width: 160px !important;
      }
    }
    /*.....*/
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
    <section class="content container-fluid" style="padding: 10px;min-height: 350px;">
        <div class="box box-primary">
          <span style="font-size: 1.5rem;padding-left: 10px;"><strong>待出库列表：</strong></span>
          <div class="box-header with-border" id="table_show" style="padding-bottom: 0px !important;">


            
          </div>
        </div>  
        <div class="btn_list" style="padding: 0px 20px;margin-bottom: 50px;">
          <input type="checkbox" id="check_all" style="display: inline-block;">全选
          <button type="button" class="btn btn-warning" id="btn_delete" style="display: inline-block;margin-left: 5px;">删除</button>
          <button type="button" class="btn btn-default pull-right" id="sub_back" style="display: inline-block;">出库</button>
          <!-- <button type="button" class="btn btn-default pull-right" id="sub_self" style="display: inline-block;margin-right: 5px;">自用</button> -->
          <select name="receiver_id" id="receiver_id" class="form-control pull-right" style="width: 140px;margin-right: 10px;padding:3px 4px;">
            <option value="0">领取人</option>
            <!-- <option value="999">自用</option> -->
              <?php 
                $part_manager->get_maintain_staff_verify_list();
              ?>
          </select>
          <!-- <input type="text" name="receiver_id_input" id="receiver_id_input" class="form-control pull-right" placeholder="领取人"> -->
          <span style="display: none;color: red;line-height: 34px;margin-right: 5px;" class="pull-right warning_receiver">*请选择 </span>
        </div>
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
<script src="../AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<?php
include_once('inc/modal_dialog.php');
?>
<script src="../commom_js/jquery.searchableSelect.js"></script>
<script src="js/app.js?v=20180919"></script>
<script src="js/starter.js?v=20181204"></script>
<script src="js/put_out_wait.js?v=20200702"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("当前待出库");
  //初始化多选框
  $(":input[name='part_items_id'],#check_all").iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal',
  increaseArea: '20%'
  });
  //多选操作
  $("#check_all").on('ifChanged', function(event){
  var flage = $(this).is(":checked");
  var ck_str = "uncheck" ;
  if (flage) {
    ck_str = "check"
  }
  var obj = $(":input[name='part_items_id']:enabled");
  $(obj).iCheck(ck_str);
  });
  $(function(){
    $('#receiver_id').searchableSelect();
  });
})
</script>

</body>
</html>