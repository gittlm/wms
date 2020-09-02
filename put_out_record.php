<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;


$id = $_GET['id'];
$up_add = $_GET["type"]; 
if($up_add == 1){
  $address = 'put_out_detail.php';
}else{
  $address = 'revoke_out_orders.php';
}

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
      /*color: blue;*/
      background-color: transparent;
    }
    .table tr td{
      overflow:hidden;
      text-overflow:ellipsis;
      white-space:nowrap;
    }
    
    .box-header{
      padding: 0px 10px 20px 10px !important;
    }
    #return_parts .body_content span{
      text-align: center;
      display: inline-block;
      width: 30%;
      height: 30px;
      line-height: 30px;
      background-color: rgba(0,0,0,0.1);
    }
    .body_content{
      margin-bottom: 20px; 
    }
    #return_parts input{
      padding-left: 10px;
      width: 70%;
      height: 30px;
      border-color: rgba(0,0,0,0.1);
      border-width: 1px;
      margin-top: -1px;
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
            <form name="search_form" class="form-inline" id="search_form" role="form">
                <div class="form-group">
                  <div class="pull-left" style="vertical-align: middle;">
                    <!-- <div class="btn_list" style="padding: 0px 20px;margin-bottom: 50px;"> -->
                      <button type="button" class="btn btn-default pull-left" style="margin-right: 20px;" onclick="window.location.href='<?=$address?>'">返回上级</button>
                    <!-- </div> -->
                    <strong style="font-size: 1.5rem;line-height: 34px;margin-right: 20px;">出库单号 : <?=$id?></strong>
                    <strong style="font-size: 1.5rem;line-height: 34px;" class="receiver"></strong>
                  </div>
                </div>
               
            </form>
            <br><br>
            <table class="table table-striped text-center">
              <tbody>
                <tr>
                  <td><strong style="font-size: 1.5rem;">序号</strong></td>
                  <td><strong style="font-size: 1.5rem;">入库单号</strong></td>
                  <td><strong style="font-size: 1.5rem;">物品名称</strong></td>
                  <td><strong style="font-size: 1.5rem;">领取数量</strong></td>
                  <!-- <td><strong style="font-size: 1.5rem;">旧件归还</strong></td> -->
                </tr>
    <?php
    $result=$part_manager->list_part_out_records($id);
    ?>
              </tbody>
            </table>
          </div>
        </div>  
    </section>
    
    <!-- /.content -->
  </div>

<?php
include_once "inc/parts_detail_modal.php"
?>

<!-- 点击入库单号显示详细信息 -->
<div  id="put_in_modal" class="modal fade">
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
</div>
<!-- 点击领取数量显示旧件归还信息 -->
<div  id="return_parts" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">旧件归还信息</h4>
      </div>
      <div class="modal-body">
        <div class="body_content">
          <span>领取数量</span><input type="number" id="put_out_num" readonly style="background-color: rgba(0,0,0,0.05);">
        </div>
        <div class="body_content">
          <span>个人库存</span><input type="number" id="per_stock_num" readonly style="background-color: rgba(0,0,0,0.05);">
        </div>
        <div class="body_content">
          <span>已经归还</span><input type="number" id="already_return_num" readonly style="background-color: rgba(0,0,0,0.05);">
        </div>
        <div class="body_content">
          <span>归还数量</span><input type="number" id="return_num">
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="hidden_type" value="<?=$up_add?>">
        <span id="warning_btn" style="background-color: transparent;width: auto;color:red;"></span>
        <button type="button" class="btn btn-default" style="color: #000;" id="return_num_btn">确定</button>
      </div>
    </div>
  </div>
</div>


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
<script src="js/put_out_record.js"></script>
<script>
$(document).ready(function(){
  <?=$view?> 
  $('.receiver').html('领取人 ：<?=$result->receiver?>');
  $('#every_name').html("出库单详情");
})
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>