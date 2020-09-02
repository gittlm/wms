<?php
include_once('../config.php');
include_once('../lib/part_manager.php');
$part_manager = new part_manager;

$big_id = $_GET["big_id"];
$big_name = $_GET["big_name"];
$small_id = $_GET["small_id"];
$small_name = $_GET["small_name"];

if($_GET['page']){
  $page = mysql_real_escape_string($_GET['page']);
}else{
  $page = 1;
}
$num = 20;

$keyword = $_POST["k"] ? $_POST["k"] : $_GET["k"];
$l1 = $keyword ? "?k=".$keyword."&" : "?";
$b_id = $_POST["big_id"] ? $_POST["big_id"] : $_GET["big_id"];
$b_name = $_POST["big_name"] ? $_POST["big_name"] : $_GET["big_name"];
$s_id = $_POST["small_id"] ? $_POST["small_id"] : $_GET["small_id"];
$s_name = $_POST["small_name"] ? $_POST["small_name"] : $_GET["small_name"];


$l2 = "&big_id=".$b_id;
$l3 = "&big_name=".$b_name;
$l4 = "&small_id=".$s_id;
$l5 = "&small_name=".$s_name;
$link = $l1.$l2.$l3.$l4.$l5;

$params = array(
  "type" => 3,
  "table" => "part_items",
  "up_name" => "big_sort_id",
  "up_id" => $big_id,
  "down_name" => "small_sort_id",
  "down_id" => $small_id,
  "k" => $keyword
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
    .pic_edit_btn{
      width: 90%;
      margin: 10px auto;
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
    }
    .pic_edit_btn button{
      margin-right: 10px;
      margin-top: 10px;
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
          <div class="box-header with-border">
            <form name="search_form" class="form-inline" id="search_form" role="form">
                <div class="form-group">
                  <div class="pull-left">
                    <button type="button" class="btn btn-default" name="btn_add" data-toggle="modal" data-target="#add_parts_sort"><i class="fa fa-plus text-green"></i> 添加物品</button>　
                  </div>
                  <div class="input-group">
                    <input name="k" id="k" type="text" class="form-control" placeholder="物品名称" maxlength="30">
                    <input type="hidden" name="big_id" value="<?=$big_id?>">
                    <input type="hidden" name="big_name" value="<?=$big_name?>">
                    <input type="hidden" name="small_id" value="<?=$small_id?>">
                    <input type="hidden" name="small_name" value="<?=$small_name?>">
                    <span class="input-group-btn"><button class="btn btn-default" type="submit" form="search_form"><i class="fa fa-search"></i></button></span>
                  </div>
                </div>
            </form>
          </div>
        <div class="form-group">
          <ol class="breadcrumb" style="margin-bottom:0;">
            <li class="active"><?=$big_name?></li>
            <li class="active"><a href="add_small_parts.php?id=<?=$big_id?>&big_name=<?=$big_name?>"><?=$small_name?></a></li>
          </ol>
        </div>
      <table class="table table-striped text-center" style="margin-top: 20px;ver">
       <tbody>
      <?php
      $result = $part_manager->part_sort_list($params,1,100);
      ?>
       </tbody>
      </table>
      <?php
      $common->sunder($link,$result);
      ?>
    </section>
    <!-- /.content -->
  </div>

<?php
include_once('inc/main_footer.php');
?>
</div>
<!-- 添加物品名称分类 -->
<div class="modal fade" id="add_parts_sort" role="dialog" aria-hidden="true">
  <form action="add_parts_items.php" method="post" id="add_parts_sort_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">添加物品名称</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="big_sort"><h5>大类：</h5></label>
            <select name="big_sort" class="form-control" id="big_sort_parts">
              <option value="0">请选择大类</option>
    <?php 
    $params = array(
      "type" => 1,
      "table" => "part_big_sort",
      "select_id" => $big_id
    );
    $part_manager->class_menu_list($params);
    ?>             
            </select>
          </div>
          <div class="form-group">
            <label for="small_sort"><h5>小类：</h5></label>
            <select name="small_sort" class="form-control" id="small_sort_parts">
              <option value="0" class="one_option">请选择小类</option>
    <?php 
    $params = array(
      "type" => 2,
      "table" => "part_small_sort",
      "up_id" => $big_id,
      "up_name" => "big_sort_id",
      "select_id" => $small_id,
      "option" => "last_option"
    );
    $part_manager->class_menu_list($params);
    ?>            
            </select>
          </div>
          <div class="form-group">
            <label for="parts_sort"><h5>添加物品名称：</h5></label>
            <input class="form-control" name="parts_sort" id="parts_sort" placeholder="请输入名称（必填）" required />
          </div>
          <div class="form-group">
            <label for="match_model"><h5>适配电梯型号：</h5></label>
            <input class="form-control" name="match_model" id="match_model" placeholder="请添加电梯型号（必填）" required />
          </div>
          <div class="form-group">
            <label for="store_position"><h5>物品储存位置：</h5></label>
            <input class="form-control" name="store_position" id="store_position" placeholder="请输入库存位置（选填）" />
          </div>
          <div class="form-group">
            <label>添加物品图片：</label>
            <div id="upload-container"></div>
            <div class="upload_btn">
              <a href="javascript:void(0)" class="upload-img">
                <label for="upload"><i class="fa fa-search-plus"></i> 选择照片</label>
              </a>
              <input accept="image/*" type="file" name="upload" id="upload">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="text-right">
            <input type="hidden" name="upload_img" id="upload_img" value="">
            <button type="submit" class="btn btn-primary"> 确定提交 </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- 修改物品名称 -->
<div class="modal fade" id="edit_parts_sort" role="dialog" aria-hidden="true">
  <form action="" method="post" id="edit_parts_sort_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">修改物品名称</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="parts_big_edit"><h5>大类名称：</h5></label>
            <select name="parts_big_edit" class="form-control" id="parts_big_edit">
              <option value="0">请选择大类</option>
    <?php 
    $params = array(
      "type" => 1,
      "table" => "part_big_sort",
      "select_id" => $big_id
    );
    $part_manager->class_menu_list($params);
    ?>             
            </select>
          </div>
          <div class="form-group">
            <label for="parts_small_edit"><h5>小类名称：</h5></label>
            <select name="parts_small_edit" class="form-control" id="parts_small_edit">
              <option value="0" class="one_option_edit">请选择小类</option>
    <?php 
    $params = array(
      "type" => 2,
      "table" => "part_small_sort",
      "up_id" => $big_id,
      "up_name" => "big_sort_id",
      "select_id" => $small_id,
      "option" => "last_option_edit"
    );
    $part_manager->class_menu_list($params);
    ?>            
            </select>
          </div>
          <div class="form-group">
            <label for="parts_sort_edit"><h5>修改物品名称：</h5></label>
            <input class="form-control" name="parts_sort_edit" id="parts_sort_edit" placeholder="请输入名称（必填）" required />
          </div>
          <div class="form-group">
            <label for="match_model_edit"><h5>适配电梯型号：</h5></label>
            <input class="form-control" name="match_model_edit" id="match_model_edit" placeholder="请添加电梯型号（必填）" required />
          </div>
          <div class="form-group">
            <label for="store_position_edit"><h5>物品储存位置：</h5></label>
            <input class="form-control" name="store_position_edit" id="store_position_edit" placeholder="请输入库存位置（选填）" />
          </div>


          <div class="form-group">
            <label>修改物品图片：</label>
            <div id="upload-container_edit"></div>
            <div id="pic_edit" class="text-center"></div>
            <div class="upload_btn">
              <a href="javascript:void(0)" class="upload-img">
                <label for="upload_edit"><i class="fa fa-search-plus"></i> 选择照片</label>
              </a>
              <input accept="image/*" type="file" name="upload_edit" id="upload_edit">
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <div class="text-right">
            <input type="hidden" name="upload_img_edit" id="upload_img_edit" value="">
            <button type="submit" class="btn btn-primary"> 确定提交 </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<?php include_once './inc/parts_detail_modal.php' ?>

<script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/headroom.min.js"></script>
<script src="../AdminLTE/bower_components/headroom/jquery.headroom.js"></script>
<script src="../AdminLTE/bower_components/localResizeIMG/dist/lrz.bundle.js"></script>
<script src="../AdminLTE/plugins/mobisscroll/js/mobiscroll.custom.min.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="js/app.js?v=20181122"></script>
<script src="js/starter.js?v=20181222"></script>
<script src="js/add_parts_items.js"></script>

<script>
$(document).ready(function(){
  <?=$view?> 
  $('#every_name').html("添加/物品");
})
//添加图片
document.querySelector('#upload').addEventListener('change', function(){
    var that = this;
    if (that.files.length === 0) return;
    lrz(that.files[0], {
      width: 800,
      height: 800
    }).then(function(rst){
      var img = new Image();
      div = document.createElement('div');
      p = document.createElement('p');
      p.style.fontSize = 13 + 'px';
      p.style.marginTop = 5 + 'px';
      p.innerHTML = '<a class="btn btn-danger btn-sm" href="javascript:void(0);" name="btn-del"><i class="fa fa-trash"></i> 删除照片</a>　　<a class="btn btn-success btn-sm" href="javascript:void(0);" name="btn-upload"><i class="fa fa-upload"></i> 开始上传</a>';
      img.className = 'img-thumbnail center-block';
      div.className = 'text-center';
      div.appendChild(img);
      div.appendChild(p);
      img.onload = function(){
        document.querySelector('#upload-container').appendChild(div);
      };
      img.src = rst.base64;
      return rst;
    });
});
//定义成功上传图片名称数组
var imgs = "";
//删除待上传图片
$("#upload-container").on('click','[name="btn-del"]',function(event){
  $(this).parent().parent().empty();
});
//开始上传图片
$("#upload-container").on('click','[name="btn-upload"]',function(event){
  var img_str = "";
  var obj = this;
  var imgbase64 = $(obj).parent().prev()[0].src;
  $(obj).html('<i class="fa fa-spinner fa-pulse"></i> 上传中…');
  var params = {
    imgdata : imgbase64
  }
  $.post("ajax/upload_pic_file.php", params, function(data, status){
    if(status == "success"){
      var j = eval("(" + data + ")");
      if (j.val == 1){
        //保存成功上传图片名称到隐藏表单
        imgs = imgs + j.imgurl + ",";
        img_str = imgs.substr(0, imgs.length-1);
        $("#upload_img").val(img_str);
        $(obj).parent().html('<i class="fa fa-check text-green"></i> 上传成功');
      }else{
        $(obj).html('<i class="fa fa-upload"></i> 上传失败');
      }
    }
  });
});


//修改图片的内容
document.querySelector('#upload_edit').addEventListener('change', function(){
    var that = this;
    if (that.files.length === 0) return;
    lrz(that.files[0], {
      width: 800,
      height: 800
    }).then(function(rst){
      var img = new Image();
      div = document.createElement('div');
      p = document.createElement('p');
      p.style.fontSize = 13 + 'px';
      p.style.marginTop = 5 + 'px';
      p.innerHTML = '<a class="btn btn-danger btn-sm" href="javascript:void(0);" name="btn-del_edit"><i class="fa fa-trash"></i> 删除照片</a>　　<a class="btn btn-success btn-sm" href="javascript:void(0);" name="btn-upload_edit"><i class="fa fa-upload"></i> 开始上传</a>';
      img.className = 'img-thumbnail center-block';
      div.className = 'text-center';
      div.appendChild(img);
      div.appendChild(p);
      img.onload = function(){
        document.querySelector('#upload-container_edit').appendChild(div);
      };
      img.src = rst.base64;
      return rst;
    });
});
//定义成功上传图片名称数组
var imgs = "";
//删除待上传图片
$("#upload-container_edit").on('click','[name="btn-del_edit"]',function(event){
  $(this).parent().parent().empty();
});
//开始上传图片
$("#upload-container_edit").on('click','[name="btn-upload_edit"]',function(event){
  var img_str = "";
  var obj = this;
  var imgbase64 = $(obj).parent().prev()[0].src;
  $(obj).html('<i class="fa fa-spinner fa-pulse"></i> 上传中…');
  var params = {
    imgdata : imgbase64
  }

  $.post("ajax/upload_pic_file.php", params, function(data, status){
    if(status == "success"){
      var j = eval("(" + data + ")");
      if (j.val == 1){
        //保存成功上传图片名称到隐藏表单
        imgs = imgs + j.imgurl + ",";
        img_str = imgs.substr(0, imgs.length-1);
        $("#upload_img_edit").val(img_str);
        $(obj).parent().html('<i class="fa fa-check text-green"></i> 上传成功');
      }else{
        $(obj).html('<i class="fa fa-upload_edit"></i> 上传失败');
      }
    }
  });
});
</script>
<?php
include_once('inc/modal_dialog.php');
?>
</body>
</html>