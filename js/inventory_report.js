
//大类变换时小类跟随变化
$('#big_sort_id').change(function(){
	var big_id = $('#big_sort_id').val();
	var params = {
		"type": 2,
		"table": "part_small_sort",
		"up_name": "big_sort_id",
		"up_id": big_id,
		"option": "two_option"
	}
	$.post('ajax/class_menu_list_file.php', params, function(data,status){
		var j = "(" + data + ")";
		$(".two_option").remove();
		$(".one_option").after(j);
	})
})
//小类变换时物品跟随变化
$('#small_sort_id').change(function() {
	var big_id = $('#big_sort_id').val();
	var small_id = $('#small_sort_id').val();
	var params = {
		"type": 3,
		"table": "part_items",
		"up_name": "big_sort_id",
		"up_id": big_id,
		"down_name": "small_sort_id",
		"down_id": small_id,
		"option": "sec_option"
	}
	$.post('ajax/class_menu_list_file.php', params, function(data,status){
		var j = "(" + data + ")";
		$(".sec_option").remove();
		$(".thr_option").after(j);
	})

})

