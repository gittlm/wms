<div class="modal modal-info fade" id="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">信息提示</h4>
      </div>
      <div class="modal-body">
        <div id="dialog_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">关闭提示</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div  id="success_dialog" class="modal modal-success fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">信息提示</h4>
      </div>
      <div class="modal-body">
        <div id="success_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" onclick="window.location.reload()" >确定刷新</button>
      </div>
    </div>
  </div>
</div>
<div  id="warning_dialog" class="modal modal-warning fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">信息提示</h4>
      </div>
      <div class="modal-body">
        <div id="warning_content">   是否确定操作？</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" >取消</button>
        <button type="button" class="btn btn-outline" id="warning_btn" data-dismiss="modal">确定</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  var dialogmsg = "";
<?php
if($_SESSION["dialogmsg"]){
  echo "dialogmsg = '".$_SESSION["dialogmsg"]."';";
  $_SESSION["dialogmsg"] = "";
}
?>
  if(dialogmsg != ""){
    $("#dialog_content").html(dialogmsg);
    $('#dialog').modal('show');
  }
});
</script>
