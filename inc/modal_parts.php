<div class="modal fade" id="parts_modal">
  <form action="" method="post" id="parts_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">申请配件表单</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="parts_name">配件名称</label>
            <input type="text" class="form-control" name="parts_name" id="parts_name" maxlength="50" required>
          </div>
          <div class="form-group">
            <label for="parts_num">配件数量</label>
            <input type="number" class="form-control" name="parts_num" id="parts_num" min="1" step="1" value="1" required>
          </div>        
          <div class="form-group">
            <div class="row">
              <div class="col-xs-4"><label class="checkbox-label" style="margin-bottom: 0; font-size: 14px;"><input type="radio" name="pay_type" value="1" checked> 有偿提供</label></div>
              <div class="col-xs-4"><label class="checkbox-label" style="margin-bottom: 0; font-size: 14px;"><input type="radio" name="pay_type" value="0"> 无偿提供</label></div>
            </div>
          </div>           
          <div class="form-group">
            <label for="parts_price">配件报价</label>
            <div class="input-group">
              <input type="number" class="form-control" name="parts_price" id="parts_price" min="0.1" step="0.1" value="" required>
              <span class="input-group-addon" style="background-color: #eee;  min-width: auto">元</span>
            </div>
            <span class="help-block">配件报价包含：配件总价+安装费用</span>
          </div>   
          <div class="form-group">
            <label for="range_error">备注信息</label>
            <div><textarea class="form-control" name="remark" id="remark" placeholder="选填" rows="3" maxlength="100"></textarea></div>
          </div>          


          <div id="validate_form" style="display: none;">
            <p class="text-center">
              <i class="fa fa-lg fa-exclamation-circle text-red"></i> <strong>出错！</strong> <span id="validate_form_msg"></span>
            </p>
          </div>
        
        </div>
        <div class="modal-footer">
          <div class="text-center">
            <input type="hidden" name="info_type" id="info_type" value="">
            <input type="hidden" name="log_id" id="log_id" value="">
            <input type="hidden" name="ele_id" id="ele_id" value="">
            <button type="submit" class="btn btn-warning"> 确定提交 </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>