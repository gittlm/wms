$('.put_in_list').click(function(){
	$('#put_in_modal').modal("show");
	var id = $(this).data("part_entry_orders_id");
	$.post('ajax/get_part_entry_orders_dec_file.php', {"id":id}, function(data,status){
		$('#put_in_list_content').html(data);
	})
})




$('.part_items_id').click(function(){
	var part_items_id = $(this).data("part_items_id");
	var img_path='';
	$('.pic_look').html("无图片");
	$.post('ajax/get_part_items_dec_file.php', {"id":part_items_id}, function(data,status){
		var j = eval ("(" + data + ")");
		$('.part_small_name').html(j.part_small_name);
		$('.part_big_name').html(j.part_big_name);
		$('.parts_sort_look').html(j.part_items_name);
		$('.match_model_look').html(j.match_model);
		$('.store_position_look').html(j.store_position);
		for (var i = 0; i < j.pic_path_array.length; i++) {
			img_path += '</br><img src="'+j.pic_path_array[i]["path"]+'" alt="" class="img-thumbnail text-center"></br></br>';
		}
		if(j.pic_path_array.length > 0){
			$('.pic_look').html(img_path);
		}
	})
	$("#look_parts_sort").modal("show");
})


$('#return_parts input').focus(function(event) {
	$('#warning_btn').html("");
});
var type_hidden = $('#hidden_type').val()*1;
if(type_hidden == 1){
	//点击领取数量弹出旧件归还模态框
	var part_out_records_id="";
	var get_num = "";
	var person_num = "";
	var already_return_num = "";
	$('[name="return_num"]').click(function(){
		part_out_records_id = $(this).data("part_out_records_id");
		get_num = $(this).data("get_num");
		person_num = $(this).data("person_num");
		already_return_num = $(this).data("return_num");

		$('#put_out_num').val(get_num);
		$('#per_stock_num').val(person_num);
		$('#already_return_num').val(already_return_num);
		$("#return_parts").modal("show");
	})
	$('#return_num_btn').click(function(){
		var return_num = $('#return_num').val()*1;
		var params = {
			"id": part_out_records_id,
			"num": return_num
		}
		if(return_num == ""){
			$('#warning_btn').html(" * 请输入归还数量 ");
		}else{
			if((return_num + person_num + already_return_num) <= get_num){
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
				$('#warning_btn').html(" * 数据错误,请重新输入 ");
			}
		}
		
	})
}