<div class="modal fade" id="edit_pwd_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <form action="" method="post" id="edit_pwd_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">修改登陆密码</h4>
        </div>
        <div class="modal-body">
          <div class="form-group has-feedback">
            <div class="input-group">
              <div class="input-group-addon">原登陆密码</div>
              <input type="password" class="form-control" name="old_pwd" id="old_pwd" maxlength="16" required>
            </div>
          </div>
          <div class="form-group has-feedback">
            <div class="input-group">
              <div class="input-group-addon">新登陆密码</div>
              <input type="password" class="form-control" name="new_pwd" id="new_pwd" maxlength="16" pattern="^[a-zA-Z0-9_!@#$%^&;*?-]{6,16}$" required>
            </div>
          </div>
          <div class="form-group has-feedback">
            <div class="input-group">
              <div class="input-group-addon">确认新密码</div>
              <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder="请再次输入新修改的密码" maxlength="16"pattern="^[a-zA-Z0-9_!@#$%^&;*?-]{6,16}$"  required>
            </div>
          </div>
          
          <div id="validate_pwd" style="display: none;">
            <p class="text-center">
              <i class="fa fa-lg fa-exclamation-circle text-red"></i> <strong>出错！</strong> <span id="validate_pwd_msg"></span>
            </p>
          </div>
        
        </div>
        <div class="modal-footer">
          <div class="text-right">
            <button type="submit" class="btn btn-warning"> 确定提交 </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>