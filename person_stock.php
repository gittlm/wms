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

//获取表单里维保人的ID
$id = $_POST["per_name"];
$params = array(
  "id" => $id
);
$keyword = $_POST["per_name"] ? $_POST["per_name"] : $_GET["per_name"];
$link = $keyword ? "?per_name=".$keyword."&" : "?";

  
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
  <link href="css/jquery.searchableSelect.css" rel="stylesheet" type="text/css">
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
    #per_name{
      position: relative;
    }
    .search_form button{
      position: absolute;
      left: 100%;
      top: 0px;
    }
    @media only screen and (max-width: 768px) {
      .searchable-select{
        min-width: 120px !important;
      }
    }
    @media only screen and (min-width: 768px) {
      .searchable-select{
        min-width: 360px !important;
      }
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
            <div style="padding: 10px;">
                <form name="search_form" class="form-inline row" method="post">
                  <div class="form-group text-center col-md-12">
                    <select name="per_name" id="per_name" style="padding-left: 10px;height: 34px;width: 70%;">
                      <option value="0" style="width: 100%;">请选择领取人</option>
                      <?php
                      $part_manager->get_maintain_staff_verify_list($id);
                      ?>
                    </select><button type="submit" style="height: 34px;width: 34px;margin-top: 2px;"><i class="fa fa-search"></i></button>
                  </div>
                </form>
            </div>  
            <table class="table table-striped text-center">
              <tbody>
                <tr>
                  <td><strong style="font-size: 1.5rem;">维保人</strong></td>
                  <td><strong style="font-size: 1.5rem;">物品</strong></td>
                  <td><strong style="font-size: 1.5rem;">库存</strong></td>
                  <td><strong style="font-size: 1.5rem;">出库日期</strong></td>
                </tr>
         <?php
          $result=$part_manager->list_person_stock($params,$page,$num);
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
<div  id="special_part_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
        <h4 class="modal-title" id="modal-title">专用电梯配件操作</h4>
      </div>
      <div class="modal-body" style="padding-left: 30px;">
        <div class="table-responsive no-padding" style="margin-bottom: 15px;">
          <span style="width: 80px;display: inline-block;">使用数量</span>
          <input type="number" id="parts_num" value="">
        </div>
        <div class="table-responsive no-padding" style="margin-bottom: 15px;display: none;" id="price_div">
          <span style="width: 80px;display: inline-block;">配件价格</span>
          <input type="text" id="parts_price" value="">
        </div>
        <div class="table-responsive no-padding">
          <span style="width: 80px;display: inline-block;">备注</span>
          <input type="text" id="parts_remarks" value="" placeholder="配件使用信息">
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="special_hid" value="">
        <input type="hidden" id="return_isno" value="">
        <input type="hidden" id="per_num" value="">
        <span class="warning_report" style="color: red;"></span>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-default" id="special_sure">确定</button>
      </div>
    </div>
  </div>
</div>
<script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/headroom.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/jquery.headroom.js"></script>
<script src="../AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="../commom_js/jquery.searchableSelect.js"></script>
<script src="js/app.js?v=20200704"></script>
<script src="js/starter.js?v=20200704"></script>

<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("出库列表");
  $(function(){
    $('#per_name').searchableSelect();
  });
})
</script>

<?php
include_once('inc/modal_dialog.php');
?>
</body>
<script src="js/person_stock.js"></script>
</html>