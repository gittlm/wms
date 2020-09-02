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

$put_out_begin = $_POST["put_out_begin"] ? $_POST["put_out_begin"] : $_GET["put_out_begin"];
$l1 = $put_out_begin ? "?put_out_begin=".$put_out_begin."&" : "?";
$put_out_end = $_POST["put_out_end"] ? $_POST["put_out_end"] : $_GET["put_out_end"];
$l2 = $put_out_end ? "?put_out_end=".$put_out_end."&" : "";
$link = $l1.$l2;

$params = array(
  "put_out_begin"=>$put_out_begin,
  "put_out_end"=>$put_out_end,
  "type"=>0
);
 

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
    .table tr td a{
      display: inline-block;
      width: 80%;
      height: 100%;
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
    <section class="content container-fluid" style="padding: 20px 10px;min-height: 350px;">
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="row" style="padding: 10px;">
              <div>
                <form name="search_form" class="form-inline" method="post">
                  <div class="form-group text-center">
                    <input type="date" name="put_out_begin" style="width: 40%;"> 至 <input type="date" name="put_out_end" style="width: 40%;"><button type="submit" class="put_out_list_btn"><i class="fa fa-search"></i></button>                   
                  </div>
                </form>
              </div>
            </div>  
            <table class="table table-striped text-center">
              <tbody>
                <tr>
                  <td><strong style="font-size: 1.5rem;">出库单号</strong></td>
                  <td><strong style="font-size: 1.5rem;">撤消日期</strong></td>
                  <td><strong style="font-size: 1.5rem;">领取人</strong></td>
                  <td><strong style="font-size: 1.5rem;">操作</strong></td>
                </tr>
          <?php
          $result=$part_manager->list_part_out_orders($params,$page,$num);
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
<script src="js/app.js?v=20180919"></script>
<script src="js/starter.js?v=20181201"></script>
<script src="js/revoke_out_orders.js"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("撤消出库");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>