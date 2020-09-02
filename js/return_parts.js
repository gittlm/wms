$('#return_parts_old input').focus(function(event) {
	$('.warning_btn').html("");
});
var part_out_records_id="";
var get_num = "";
var person_num = "";
var already_return_num = "";
var part_entry_orders_id="";
//旧件归还
$('[name="old_return_num"]').click(function(){
	$('.warning_btn').html("");
	part_out_records_id = $(this).data("part_out_records_id");
	get_num = $(this).data("get_num");
	person_num = $(this).data("person_num");
	already_return_num = $(this).data("return_num");
	$('#put_out_num_old').val(get_num);
	$('#already_return_num').val(already_return_num);
	$('#person_num_old').val(person_num);
	$('#return_num_old').val("");
	$("#return_parts_old").modal("show");
})
$('#old_return_num_btn').click(function(){
	var return_num = $('#return_num_old').val()*1;
	var params = {
		"id": part_out_records_id,
		"return_num": already_return_num,
		"num": return_num,
		"type": 1
	}
	if(return_num == ""){
		$('.warning_btn').html(" * 请输入归还数量 ");
	}else{
		if(return_num <=get_num-person_num){
			$.post('ajax/add_part_return_num_file.php', params, function(data,status){
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
		}else{
			$('.warning_btn').html(" * 数据错误,请重新输入 ");
		}
	}
})
//新件归还
$('[name="new_return_num"]').click(function(){
	$('.warning_btn').html("");
	part_out_records_id = $(this).data("part_out_records_id");
	get_num = $(this).data("get_num");
	person_num = $(this).data("person_num");
	part_entry_orders_id = $(this).data("part_entry_orders_id");
	$('#put_out_num_new').val(get_num);
	$('#person_num_new').val(person_num);
	$("#return_parts_new").modal("show");
})
$('#new_return_num_btn').click(function(){
	var return_num = $('#return_num_new').val()*1;
	var params = {
		"id": part_out_records_id,
		"part_entry_orders_id": part_entry_orders_id,
		// "get_num": get_num,
		// "person_num": person_num,
		"num": return_num,
		"type": 2
	}
	if(return_num == ""){
		$('.warning_btn').html(" * 请输入归还数量 ");
	}else{
		if(return_num <= person_num){
			$.post('ajax/add_part_return_num_file.php', params, function(data,status){
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
		}else{
			$('.warning_btn').html(" * 数据错误,请重新输入 ");
		}
	}
})
