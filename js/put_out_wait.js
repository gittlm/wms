//第一种，从一个key里取出所有的value
var storage_obj = JSON.parse(localStorage.getItem("wms_part_num"));
var arr_show = [];
for(var arr in storage_obj){
	var data = {
		"part_entry_orders_id": storage_obj[arr]["id"],
		"num": storage_obj[arr]["get_num"]
	}
	arr_show.push(data);
}

//第二种，循环获取本地储存的每一组数据并向后台发送请求接收具体列表
	// var arr_show = new Array();
	// var storage = window.localStorage;
	// storage.removeItem("data-message");
	// storage.removeItem("Hm_lvt_eaa57ca47dacb4ad4f5a257001a3457c");

	// for (var i =0;i<storage.length;i++) {
	// 	var obj = JSON.parse(storage.getItem(storage.key(i)));
	// 	var Cts = storage.key(i)?storage.key(i):"";
	// 	if(Cts.indexOf("wms_part_") >= 0 ) { 
	// 	   for(var a in obj){
	// 			var data = {
	// 				"part_entry_orders_id": obj[a]["id"],
	// 				"num": obj[a]["get_num"]
	// 			}
	// 			arr_show.push(data);
	// 		}
	// 	}  
	// }
// storage.clear();
var params = {
	"arr":arr_show
}
//全选按钮和确认按钮在有内容时显示，没有内容时隐藏
$.post('ajax/get_part_shopping_file.php', params, function(data,status){
	$('#table_show').html(data);
	if(data == ''){//如果没有内容就隐藏按钮
		$(".btn_list").hide();
	}else{//有内容就显示按钮
		$(".btn_list").show();
	}
})

$('#table_show').on("change",'[name="part_return_value"]',function(){
	if($(this).val() == "无"){
		$(this).parent().find('span').show();
	}else{
		$(this).parent().find('span').hide();
	}
})
$('#receiver_id').change(function(){
	if($(this).val() == ""){
		$('.warning_receiver').show();
	}else{
		
		$('.warning_receiver').hide();
	}
})


//点击删除按钮删除选中的列表--弹出
$('#btn_delete').click(function(){
	$('#warning_content').html("是否删除选中的列表？");
	$('#warning_dialog').modal("show");
})
$('#warning_btn').click(function(){
	console.log("aaaa");
	var sub_arr = new Array();
	//把选中的项循环添加到数组里
	$('input[name="part_items_id"]:checked').each(function(){
		//father找到当前所在的tbody,
		//num是当前物品领取数量,
		//part_entry_orders_id是当前物品入库单ID,
		//part_return_value是否旧件归还,
		//warning_span若没有选旧件归还就显示后面的警告
		var father = $(this).parentsUntil('table');
	    var part_entry_orders_id = father.find('tr').eq(1).find('td').eq(1)[0].innerText;
	    var data = {
			"part_entry_orders_id": part_entry_orders_id,//入库单ID
		}
		sub_arr.push(data);
	});
	console.log(sub_arr);
	for (var i in sub_arr) {
   		for(var a in storage_obj){
   			if (storage_obj[a]["id"] == sub_arr[i]["part_entry_orders_id"]) {
    			delete storage_obj[a];
    		}
   		}
	}
	localStorage.setItem("wms_part_num",JSON.stringify(storage_obj));
	window.location.reload();
})
//点击确定提交，把数据提交到后台并删除本地储存
$('#sub_back').click(function(){
	var sub_arr = new Array();
	var flag = 0;
	//把选中的项循环添加到数组里
	$('input[name="part_items_id"]:checked').each(function(){
		//father找到当前所在的tbody,
		//num是当前物品领取数量,
		//part_entry_orders_id是当前物品入库单ID,
		//part_return_value是否旧件归还,
		//warning_span若没有选旧件归还就显示后面的警告
		var father = $(this).parentsUntil('table');
	    var num = father.find('#choose_num').val();
	    var part_entry_orders_id = father.find('tr').eq(1).find('td').eq(1)[0].innerText;
	    var part_return_value = father.find('select').val();
	    var warning_span = father.find('span');

	    if (part_return_value == "无") {
	    	warning_span.show();
	    	flag = 1;
	    }
	    var data = {
			"part_entry_orders_id": part_entry_orders_id,//入库单ID
			"num": num,//领取数量
			"part_return_value": part_return_value//归还
		}
		if(data.num == 0){
			return;
		}else{
			sub_arr.push(data);
		}
		

	});
	if (flag == 1) {
		return;
	}
	var receiver = 0;//领取人
	if($("#receiver_id").val() != 0){
		receiver = $("#receiver_id").val();
		$('.warning_receiver').hide();
	}else{
		$('.warning_receiver').show();
		flag = 1;
		return;
	}
	//未选单号
	if(sub_arr.length == 0){
		$('.warning_receiver').show();
		flag = 1;
		return;
	}
	//第一种，把本地储存中的相应的选项删除
   
   	for (var i in sub_arr) {
   		for(var a in storage_obj){
   			if (storage_obj[a]["id"] == sub_arr[i]["part_entry_orders_id"]) {
    			delete storage_obj[a];
    		}
   		}
	}
	localStorage.setItem("wms_part_num",JSON.stringify(storage_obj));

	//第二种，本地储存的内容在提交后把已经提交的从本地删除数据
	// for(var x in storage){
	// 	var obj = JSON.parse(storage.getItem(storage.key(x)));
	// 	var Cts = storage.key(x)?storage.key(x):""; 
	// 	if(Cts.indexOf("wms_part_") >= 0 ) { 
	// 	   for(var a in obj){
	// 	    	for (var j in sub_arr) {
	// 	    		if (obj[a]["id"] == sub_arr[j]["part_entry_orders_id"]) {
	// 	    			storage.removeItem(storage.key(x));
	// 	    		}
	// 	    	}
	// 		}
	// 	}
	// }
	var params = {
		"arr":sub_arr,
		"receiver": receiver
	}
	$.post('ajax/add_part_out_orders_file.php', params, function(data,status){
		if (status == "success") {
			var j = eval ("(" + data + ")");
			if (j.val == 1){
				$("#success_content").html("订单申领成功");
				$("#success_dialog").modal("show");
				$("#success_dialog").find('button').eq(1).click(function(){
					window.location.href="put_out_detail.php";
				})
			}
			else{
				$("#dialog_content").html(j.info);
				$("#dialog").modal("show");
			}
		}
	})
})



