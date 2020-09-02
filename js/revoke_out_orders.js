//点击出库单跳转到出库单详细信息
$('.table').on('click','tr td a',function(){
	var id = $(this).data("part_out_orders_id");
	window.location.href = 'put_out_record.php?id='+id+'&type=2';
})
//恢复撤消功能
$('[name="btn_resume"]').click(function(){
	var id = $(this).data("part_out_orders_id");
	$("#warning_dialog").modal("show");
	$('#warning_btn').click(function(){
		$("#warning_dialog").modal("hide");
		$.post('ajax/operation_part_out_orders_file.php', {"id":id,"type":2}, function(data,status){
			if (status == "success") {
				var j = eval ("(" + data + ")");
				if (j.val == 1){
					$("#success_content").html("恢复成功");
					$("#success_dialog").modal("show");
				}
				else{
					$("#dialog_content").html(j.info);
					$("#dialog").modal("show");
				}
			}
		})
	})	
})
