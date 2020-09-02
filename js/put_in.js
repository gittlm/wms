//点击添加按钮跳转到添加入库
$('[name="btn_add"]').click(function(){
	window.location.href = 'add_put_in.php';
})
//点击入库单名称显示详细信息
$('.table').on("click",".part_items_id",function(){
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
//点击入库单号查看入库单详情

$('.table').on("click",".put_in_list",function(){
	var id = $(this).find("a").data("part_entry_orders_id");
	$('#put_in_modal').modal("show");
	$.post('ajax/get_part_entry_orders_dec_file.php', {"id":id}, function(data,status){
		$('#put_in_list_content').html(data);
	})
})

//获取编辑的数据
var num = "";
$('[name="btn_edit"]').click(function(){
	var id = $(this).data("part_entry_orders_id");
	part_entry_orders_id = id;
	$('#put_in_modal_edit').modal("show");
	$.post('ajax/edit_part_entry_orders_file.php', {"id":id,"type":1}, function(data,status){
		$('#put_in_list_content_edit').html(data);
		num = $("#num").val();
	})
})
//提交修改的编辑数据
$('[name="btn_edit_submit"]').click(function(){
	var params = {
		id : part_entry_orders_id,
        brand : $("#brand").val(),//品牌
        unit_price : $("#unit_price").val(), //单价
        buy_date : $("#buy_date").val(), //购买日期
        buyer_id : $("#buyer_id").val(), //采购员
        supplier : $("#supplier").val(), //供应商
        supplier_tel : $("#supplier_tel").val(), //供应商电话
        operator_id : $("#operator_id").val(), //操作人
        remarks : $("#remarks").val(), //备注
        type : 2
      }
     var stock_num = $("#stock_num").val();
     if (num == stock_num) {
     	params.num = $("#num").val();	
     	params.edit_num_type = 2;//2的时候可以传
     }
	$.post('ajax/edit_part_entry_orders_file.php', params, function(data,status){
		if (status == "success") {
			$("#put_in_modal_edit").modal("hide");
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

//返回到厂家显示
var part_entry_orders_id = "";
var stock_num = "";
$('[name="btn_give_up"]').click(function(){
	part_entry_orders_id = $(this).data("part_entry_orders_id");
	stock_num = $(this).data("stock_num");
	$("#stock_num").val(stock_num);
	$("#return_to_com").modal("show");
})
//当模态框的INPUT框获取焦点时把警告清空
$('#return_to_com input').focus(function(event) {
	$('.warning_btn').html("");
});
//返回到厂家提交
$("#return_num_btn").click(function(){
	var return_num = $("#return_com_num").val();
	var params = {
		"id": part_entry_orders_id,
		"num": return_num,
		"type": 3
	}
	if(return_num == ""){
		$('.warning_btn').html(" * 请输入归还数量 ");
	}else{
		if(return_num <= stock_num && return_num > 0){
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