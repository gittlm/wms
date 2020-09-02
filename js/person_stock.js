$(document).ready(function() {
	//点击名称显示详细信息
	$('.table').on("click","a",function(){
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
	//专用电梯配件使用，库管端操作,弹出专用配件模态框
	$('[name="btn_deduct"]').click(function(){
		//每次进来都清空内容
		$("#parts_price").val("");
		$("#parts_num").val("");
		$("#parts_remarks").val("");
		//把数据放到隐藏表单中
		var part_out_records_id=$(this).data("part_out_records_id");//出库单ID
		var return_isno=$(this).data("return_isno");//是否归还
		$("#special_hid").val(part_out_records_id);
		$("#return_isno").val(return_isno);
		var per_num = $(this).parent().parent().html().split("<nobr>")[0]*1;//个人库存
		$("#per_num").val(per_num);
		//判断是否显示价格框
		if(return_isno == "归还"){
			$("#price_div").hide();
		}else{
			$("#price_div").show();
		}
		$('.warning_report').html("");
		$("#special_part_modal").modal("show");
	})
	$("#special_sure").click(function(){
		var part_out_records_id = $("#special_hid").val();
		var num = $("#parts_num").val();
		var parts_price = $("#parts_price").val();
		var remarks = $("#parts_remarks").val();
		var per_num = $("#per_num").val();
		var params = {
			"part_out_records_id":part_out_records_id,
			"num":num,
			"price": parts_price ? parts_price : 0,
			"remarks":remarks
		}
		//价格不能小于等于0
		// if(parts_price!="" && parts_price<=0){
		// 	$('.warning_report').html("价格不正确");
		// 	return;
		// }else{
		// 	$('.warning_report').html("");
		// }
		//数量不能小于等于0且不能为空,也不能大于个人库存数量
		if(num<=0 || num =="" || (num-per_num)>0){
			$('.warning_report').html("数量不正确");
			return;
		}else{
			$('.warning_report').html("");
		}
		//备注不能为空
		if(remarks == ""){
			$('.warning_report').html("备注不能为空");
			return;
		}else{
			$('.warning_report').html("");
		}
		$.post("ajax/change_person_check_to_use.php", params,function(data,status){
			if (status == "success") {
				$("#special_part_modal").modal("hide");
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
});
	
