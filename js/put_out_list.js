//初始化多选项
$(":input[name='part_items_id'],#check_all").iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass: 'iradio_minimal',
increaseArea: '20%'
});
//多选操作
$("#check_all").on('ifChanged', function(event){
var flage = $(this).is(":checked");
var ck_str = "uncheck" ;
if (flage) {
  ck_str = "check"
}
var obj = $(":input[name='part_items_id']:enabled");
$(obj).iCheck(ck_str);
});
//获取选中的入库单号和领取数量
$('#choose_btn').click(function(){
	var id_array=new Array();   
	var flag = 0;
	$('input[name="part_items_id"]:checked').each(function(){
		flag = 1;
	  id_array.push($(this).val());//向数组中添加元素 
	});
	if(flag == 0){
		$('.warning_span').html(" * 请选择领取的单号 ");
		return;
	}
	//第一种方法，用同一个key储存多个对象数组value
	var obj_num = JSON.parse(localStorage.getItem("wms_part_num"));
	for (var i = 0; i < id_array.length; i++) {
		var data ={};
	  	var _table = $('#part_items_id_'+id_array[i]+'').parentsUntil("table");
	  	data[id_array[i]]={};
		data[id_array[i]]["id"]=id_array[i];
		var num = _table.find('tr').eq(4).find('input').val();
		data[id_array[i]]["get_num"]=num;
		if(data[id_array[i]]["get_num"] == ""){
			$('.warning_span').html(" * 请选择领取数量 ");
			return;
		}else{
			console.log(data);
			var data_e = $.extend(obj_num,data);
			localStorage.setItem("wms_part_num",JSON.stringify(data_e));
		}
	}
	//第二种方法，通过指定的id拼接生成唯一的key和对应的value//2020-05-14宋
	// for (var i = 0; i < id_array.length; i++) {
	//   	var data ={};
	//   	var _table = $('#part_items_id_'+id_array[i]+'').parentsUntil("table");
	//   	data[id_array[i]]={};
	// 	data[id_array[i]]["id"]=id_array[i];
	// 	var num = _table.find('tr').eq(4).find('input').val();
	// 	data[id_array[i]]["get_num"]=num;
	// 	if(data[id_array[i]]["get_num"] == ""){
	// 		$('.warning_span').html(" * 请选择领取数量 ");
	// 		return;
	// 	}else{
	// 		localStorage.setItem("wms_part_"+id_array[i],JSON.stringify(data));
	// 		$('.warning_span').html("");
	// 	}
	// }
	console.log(localStorage);
	$("#success_content").html("添加订单成功");
	$("#success_dialog").modal("show");
})

