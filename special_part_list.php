<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;

if($_GET['page']){
  $page = mysql_real_escape_string($_GET['page']);
}else{
  $page = 1;
}
$num = 20;

$link = "special_part_list.php?";
  
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
  <link rel="stylesheet" href="css/custom_style.css?v=20191119">
  <style>
  .table tr td{
      vertical-align: middle !important;
    }
    .table tr td a{
      display: inline-block;
      width: 80%;
      height: 100%;
      /*vertical-align: middle !important;*/
      background-color: transparent;
    }
    .box-header{
      padding: 10px 0px !important;
      border-bottom-width: 0px !important;
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
    <section class="content container-fluid" style="padding: 10px 10px;min-height: 350px;">
        <div class="box box-primary">
          <div class="box-header with-border">
<!--             <div class="row" style="padding: 10px;"> 
              <div class="col-sm-8 col-xs-12">  
                <form name="search_form" method="post">
                  <div class="form-group text-left">
                    <input type="date" name="put_out_begin" style="width: 40%;" placeholder="开始日期"> 至 <input type="date" name="put_out_end" style="width: 40%;" placeholder="结束日期"><button type="submit" class="put_out_list_btn"><i class="fa fa-search"></i></button>                   
                  </div>
                </form>
              </div>
            </div> -->
            <table class="table table-striped text-center">
              <tbody>
                <tr>
                  <td><strong style="font-size: 1.5rem;">物品</strong></td>
                  <td><strong style="font-size: 1.5rem;">数量</strong></td>
                  <td><strong style="font-size: 1.5rem;">使用人</strong></td>
                  <td><strong style="font-size: 1.5rem;">备注</strong></td>
                </tr>
          <?php
          $result=$part_manager->part_order_external_use($page,$num);
          ?>
              </tbody>
            </table>
            <?php
            $common->sunder($link,$result);
            ?>
          </div>
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
<script src="js/app.js?v=20200704"></script>
<script src="js/starter.js?v=20200704"></script>

<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("专用配件使用信息");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
<script src="js/put_out_detail.js"></script>
</html>