<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;

if($_GET['page']){
  $page = mysql_real_escape_string($_GET['page']);
}else{
  $page = 1;
}
$num = 10;

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
  <link rel="stylesheet" href="css/custom_style.css?v=20180819">
  <style>
    .process ul{
      padding-left: 0px !important;
      width: 142px;
      margin-top: -3px !important;
      margin-right: auto;
      margin-left: auto;
    }
    .process ul li{
      list-style: none !important;
      float: left;
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
    <section class="sidebar" style="position: static;">
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
                  <div class="input-group">
                    <input name="k" id="k" type="text" class="form-control" placeholder="单号/物品/位置/维保人" maxlength="30">
                    <span class="input-group-btn"><button class="btn btn-default" type="submit" form="search_form"><i class="fa fa-search"></i></button></span>
                  </div>
                  <button type="button" class="btn btn-default" id="special_part_list" style="display: inline-block;margin-left: 10px;">配件专用记录</button>
                </div>
            </form>

          </div>
          <?php
          $params = array(
            "k" => $keyword
          );
          $result = $part_manager->list_part_install_process($params,$page,$num);
          ?>
          <?php
          $common->sunder($link,$result);
          ?>
    </section>
    <!-- /.content -->
  </div>

<?php
include_once('inc/main_footer.php');
?>
<!-- 点击数量弹出出库模态框 -->
<div  id="show_table" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">配件使用信息</h4>
      </div>
      <div class="modal-body">
        <div>
          <table class="table table-striped text-center table-bordered">
            <thead>
              <tr>
                  <th><strong style="font-size: 1.5rem;">出库记录</strong></th>
                  <th><strong style="font-size: 1.5rem;">出库单号</strong></th>
                  <th><strong style="font-size: 1.5rem;">物品名称</strong></th>
                  <th><strong style="font-size: 1.5rem;">安装数量</strong></th>
                </tr>
            </thead>
            <tbody id="return_show">
                
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #000;">确定</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- 点击图片弹出显示模态框 -->
<div  id="show_photo" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">图片详细信息</h4>
      </div>
      <div class="modal-body">
        <div>
          <table class="table text-center">
            <tbody>
              <tr>
                <td class="pic_look text-center" style="width: 80%;border-top: 0px;"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #000;">确定</button>
      </div>
    </div>
  </div>
</div>
</div>

<script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/headroom.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/jquery.headroom.js"></script>
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="js/app.js?v=20180919"></script>
<script src="js/starter.js?v=20181212"></script>
<script src="js/part_install_process.js"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("安装流程单");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>