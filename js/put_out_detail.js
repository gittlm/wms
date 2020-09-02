//点击出库单跳转到出库单详细信息
$('.table').on('click','tr td a',function(){
	var id = $(this).data("part_out_orders_id");
	window.location.href = 'put_out_record.php?id='+id+'&type=1';
})
//撤消功能弹出确认
var id = "";
$('[name="btn_revoke"]').click(function(){
	id = $(this).data("part_out_orders_id");
	$("#warning_dialog").modal("show");
})
$('#warning_btn').click(function(){
	$("#warning_dialog").modal("hide");
	$.post('ajax/operation_part_out_orders_file.php', {"id":id,"type":1}, function(data,status){
		if (status == "success") {
			var j = eval ("(" + data + ")");
			if (j.val == 1){
				$("#success_content").html(j.info);
				$("#success_dialog").modal("show");
			}
			else{
				$("#dialog_content").html(j.info);
				$("#dialog").modal("show");
			}
		}
	})
})
//点击旧件归还跳转到旧件归还页面
$('#return_parts').click(function(){
	window.location.href = "return_parts.php";
})