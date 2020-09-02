
//初始时间插件
var current_date = new Date();
var maxYear = current_date.getFullYear() + 10;
$('#buy_date').mobiscroll().calendar({
  theme: "mobiscroll", 
  lang: "zh", 
  display: "bottom", 
  controls: ['calendar'],
  max: new Date(maxYear, 12, 31),
  showScrollArrows: true
});

//物品入库
//先获取一级所有分类和相对应的二级分类
var big_sort_id;
$('#big_sort_id').change(function(){
	big_sort_id = $('#big_sort_id').val();
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
		$(".sec_option").remove();
		$(".one_option").after(j);
	})
})
$('#small_sort_id').change(function(){
	var small_sort_id = $('#small_sort_id').val();
	var params = {
		"type": 3,
		"table": "part_items",
		"up_name": "big_sort_id",
		"up_id": big_sort_id,
		"down_name": "small_sort_id",
		"down_id": small_sort_id,
		"option": "sec_option"
	}
	$.post('ajax/class_menu_list_file.php', params, function(data,status){
		var j = "(" + data + ")";
		$(".sec_option").remove();
		$(".two_option").after(j);
	})
})


$("input").on("focus",function(){
	$('.warning_span').html("");
})
$("select").change(function(){
	$('.warning_span').html("");
})
//添加物品
$('#put_in_btn').click(function() {
	if($('#big_sort_id').val()*1 == 0 || $('#small_sort_id').val()*1 == 0 || $('#part_items_id').val()*1 == 0 || $('#brand').val()*1 == "" || $('#supplier').val()*1 == "" || $('#supplier_tel').val()*1 == "" || $('#num').val()*1 == "" || $('#unit_price').val()*1 == "" || $('#buyer_id').val()*1 == 0 || $('#buy_date').val()*1 == "" || $('#operator_id').val()*1 == 0){
		$('.warning_span').html("* 请完善入库信息 ");
		return;
	}
	var params = {
		"big_sort_id": $('#big_sort_id').val(),
		"small_sort_id": $('#small_sort_id').val(),
		"part_items_id": $('#part_items_id').val(),
		"brand": $('#brand').val(),
		"supplier": $('#supplier').val(),
		"supplier_tel": $('#supplier_tel').val(),
		"num": $('#num').val(),
		"unit_price": $('#unit_price').val(),
		"buyer_id": $('#buyer_id').val(),
		"buy_date": $('#buy_date').val(),
		"operator_id": $('#operator_id').val(),
		"remarks": $('#remarks').val()
	}
	$.post("ajax/add_part_entry_orders_file.php", params,function(data,status){
		if (status == "success") {
			// $("#add_parts_sort").modal("hide");
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