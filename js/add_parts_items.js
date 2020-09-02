//查看详细信息
$('[name="btn_look"]').click(function(){
	var id = $(this).data("id");
	var img_path='';
	$('.pic_look').html("无图片");
	$.post('ajax/get_part_items_dec_file.php', {"id":id}, function(data,status){
		var j = eval ("(" + data + ")");
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
//添加物品
//先获取一级所有分类和相对应的二级分类
$('#big_sort_parts').change(function(){
	var big_sort_id = $('#big_sort_parts').val();
	var params = {
		"type": 2,
		"table": "part_small_sort",
		"up_name": "big_sort_id",
		"up_id": big_sort_id,
		"option": "last_option"
	}
	$.post('ajax/class_menu_list_file.php', params, function(data,status){
		var j = "(" + data + ")";
		$(".last_option").remove();
		$(".one_option").after(j);
	})
})
//添加物品
$('#add_parts_sort_form').submit(function(e) {
	e.preventDefault();
	var params = {
		"big_sort_id": $('#big_sort_parts').val(),
		"small_sort_id": $('#small_sort_parts').val(),
		"name": $('#parts_sort').val(),
		"match_model": $('#match_model').val(),
		"store_position": $('#store_position').val(),
		"type":3
	}
	var pics = $("#upload_img").val();
	if(params.big_sort_id != "0" && params.small_sort_id != "0"){
		$.post("ajax/add_part_file.php", params,function(data,status){
			if (status == "success") {
				$("#add_parts_sort").modal("hide");
				var j = eval ("(" + data + ")");
				var part_items_id = j.part_items_id;
				if(pics){
					var params_pic = {
						"pics":pics,
						"type":4,
						"table":"part_items_pic",
						"part_items_id":part_items_id
					}
					$.post("ajax/add_part_file.php", params_pic, function(){
					})
				}
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
		$("#dialog_content").html("未选择大类或小类");
		$("#dialog").modal("show");
	}
})
//修改物品名称信息
//先获取一级所有分类和相对应的二级分类
$('#parts_big_edit').change(function(){
	var big_sort_id = $('#parts_big_edit').val();
	var params = {
		"type": 2,
		"table": "part_small_sort",
		"up_name": "big_sort_id",
		"up_id": big_sort_id,
		"option": "last_option_edit"
	}
	$(".last_option_edit").remove();
	$.post('ajax/class_menu_list_file.php', params, function(data,status){
		var j = "(" + data + ")";
		$(".one_option_edit").after(j);
	})
})
//点击编辑按钮显示页面
var id = '';
$('[name="btn_edit"]').click(function(){
	$('#edit_parts_sort').modal("show");
	var pic_arr = [];
	var name = $(this).data("name");
	id = $(this).data("id");
	$('#parts_sort_edit').val(name);
	img_path="";
	$('#upload-container_edit').html('');
	$.post('ajax/get_part_items_dec_file.php', {"id":id}, function(data,status){
		var j = eval ("(" + data + ")");
		$('#match_model_edit').val(j.match_model);
		$('#store_position_edit').val(j.store_position);
		for (var i = 0; i < j.pic_path_array.length; i++) {
			img_path += '<div class="pic_edit_btn text-center"><img src="'+j.pic_path_array[i]["path"]+'" alt="" class="img-thumbnail text-center"><br><button type="button" class="btn btn-danger pic_del" data-id="'+j.pic_path_array[i]["id"]+'">删除照片</button><button type="button" class="btn btn-default no" style="display:none;" data-id="'+j.pic_path_array[i]["id"]+'">取消</button><button type="button" class="btn btn-default yes" style="display:none;" data-id="'+j.pic_path_array[i]["id"]+'">确认</button></div>';
		}
		if(j.pic_path_array.length > 0){
			$('#pic_edit').html(img_path);
		}else{
			$('#pic_edit').html("");
		}

	})
})
//点击图片删除按钮
var pic_arr = [];
var pic_del_id = "";
$("#pic_edit").on("click",".pic_del",function(){
	pic_del_id = $(this).data("id");
	$(this).parent().find('.yes').show();
	$(this).parent().find('.no').show();
	$(this).parent().find('.pic_del').hide();
})
//点击确认删除按钮获取删除图片的id数组
$("#pic_edit").on("click",".yes",function(){
	$(this).parent().remove();
	pic_arr.push(pic_del_id);
})
//取消删除
$("#pic_edit").on("click",".no",function(){
	$(this).parent().find('.yes').hide();
	$(this).parent().find('.no').hide();
	$(this).parent().find('.pic_del').show();
})
//编辑提交
var up_big_sort_id = $('#parts_big_edit').val();
var up_small_sort_id = $('#parts_small_edit').val();

$('#edit_parts_sort_form').submit(function(e) {
	e.preventDefault();
	var params = {
		"big_sort_id": $('#parts_big_edit').val(),//大类修改后的ID
		"small_sort_id": $('#parts_small_edit').val(),//小类修改后的ID
		"id": id,//物品修改前的ID
		"name": $('#parts_sort_edit').val(),//物品修改后的ID
		"match_model": $('#match_model_edit').val(),//物品修改后的ID
		"store_position": $('#store_position_edit').val(),//物品修改后的ID
		"type": 3//小类类型
	}
	var pics = $("#upload_img_edit").val();
	//只添加图片
	if(pics){
		var params_pic = {
			"pics":pics,
			"type":4,
			"table":"part_items_pic",
			"part_items_id":id
		}
		$.post("ajax/add_part_file.php", params_pic, function(data,status){
			if (status == "success") {
				$("#edit_parts_sort").modal("hide");
				$("#success_content").html("修改成功");
				$("#success_dialog").modal("show");
			}
		})
		if(params.big_sort_id != "0" && params.small_sort_id != "0"){
			$.post("ajax/change_part_file.php", params,function(data,status){
			 	if (status == "success") {
					$("#edit_parts_sort").modal("hide");
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
			$("#dialog_content").html("未选择大类或小类");
		    $("#dialog").modal("show");
		}
	}
	//删除原来的图片并添加新的图片
	if(pic_arr.length > 0){
		var params_pic = {
			"pics": pic_arr,
			"type":4,
			"table":"part_items_pic",
			"part_items_id":id
		}
		$.post("ajax/change_part_file.php", params_pic, function(data,status){
			if (status == "success") {
				$("#edit_parts_sort").modal("hide");
				$("#success_content").html("修改成功");
				$("#success_dialog").modal("show");
			}
		})
		if(params.big_sort_id != "0" && params.small_sort_id != "0"){
			$.post("ajax/change_part_file.php", params,function(data,status){
			 	if (status == "success") {
					$("#edit_parts_sort").modal("hide");
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
			$("#dialog_content").html("未选择大类或小类");
		    $("#dialog").modal("show");
		}
	}
	//如果没有图片
	if(pic_arr.length < 1 && pics == ''){
		if(params.big_sort_id != "0" && params.small_sort_id != "0"){
			$.post("ajax/change_part_file.php", params,function(data,status){
			 	if (status == "success") {
					$("#edit_parts_sort").modal("hide");
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
			$("#dialog_content").html("未选择大类或小类");
		    $("#dialog").modal("show");
		}
	}
})
// var sub_post = function(){//数据的提交请求
// 	$.post("ajax/change_part_file.php", params,function(data,status){
// 		if (status == "success") {
// 			$("#edit_parts_sort").modal("hide");
// 			var j = eval ("(" + data + ")");
// 			if (j.val == 1){
// 				$("#success_content").html(j.info);
// 				$("#success_dialog").modal("show");
// 			}
// 			else{
// 				$("#dialog_content").html(j.info);
// 				$("#dialog").modal("show");
// 			}
// 		}
// 	})
// }
// var sub_pic = function(){//图片的提交请求
// 	$.post("ajax/add_part_file.php", params_pic, function(data,status){
// 		if (status == "success") {
// 			$("#edit_parts_sort").modal("hide");
// 			$("#success_content").html("修改成功");
// 			$("#success_dialog").modal("show");
// 		}
// 	})
// }