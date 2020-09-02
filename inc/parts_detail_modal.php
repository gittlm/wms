<!-- 查看物品详细信息 -->
<div class="modal fade" id="look_parts_sort" role="dialog" aria-hidden="true">
  <form action="" method="post" id="look_parts_sort_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">物品详细信息</h4>
        </div>
        <div class="modal-body" style="line-height: 3rem;">
          <table class="table table-bordered">
            <tr>
              <td class="text-right" style="width:40%;">大类：</td>
              <td class="part_big_name"><?=$big_name?></td>
            </tr>
            <tr>
              <td class="text-right" style="width:40%;">小类：</td>
              <td class="part_small_name"><?=$small_name?></td>
            </tr>
            <tr>
              <td class="text-right" style="width:40%;">物品名称：</td>
              <td class="parts_sort_look"></td>
            </tr>
            <tr>
              <td class="text-right" style="width:40%;">适配型号：</td>
              <td class="match_model_look"></td>
            </tr>
            <tr>
              <td class="text-right" style="width:40%;">储存位置：</td>
              <td class="store_position_look"></td>
            </tr>
            <tr>
              <td class="pic_look text-center" colspan="2" style="width: 80%;">无图片</td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <div class="text-right">
            <button type="button" class="btn btn-primary" data-dismiss="modal"> 确定 </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>