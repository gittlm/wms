$('#search_btn').click(function(){
	var big_part_id = $("#big_part_id").val();
	var small_part_id = $("#small_part_id").val();
	var part_items_id = $("#part_items_id").val();
	var brand = $("#brand").val();
	var match_model = $("#match_model").val();
	var remarks = $("#remarks").val();
	var put_in_begin = $("#put_in_begin").val();
	var put_in_end = $("#put_in_end").val();put_in_begin
	var params = {
		"big_part_id": big_part_id,//大类ID
		"small_part_id": small_part_id,//小类ID
		"part_items_id": part_items_id,//物品ID
		"brand": brand,//品牌
		"match_model": match_model,//适配型号
		"remarks": remarks,//备注
		"put_in_begin": put_in_begin,//开始日期
		"put_in_end": put_in_end//结束日期
	}
	post(params,"put_out_search.php");
	
})
function post(params, url) { 
    // 创建form元素
    var temp_form = document.createElement("form");
    // 设置form属性
    temp_form .action = url;      
    temp_form .target = "_self";//自身页面跳转
    temp_form .method = "post";      
    temp_form .style.display = "none";
    // temp_form .target="_blank";//新页面跳转
    // 处理需要传递的参数 
    for (var x in params) { 
        var opt = document.createElement("textarea");      
        opt.name = x;      
        opt.value = params[x];      
        temp_form .appendChild(opt);      
    }      
    document.body.appendChild(temp_form);
    // 提交表单      
    temp_form .submit();     
} 

//大类变换时小类跟随变化
$('#big_part_id').change(function(){
	var big_id = $('#big_part_id').val();
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
$('#small_part_id').change(function() {
	var big_id = $('#big_part_id').val();
	var small_id = $('#small_part_id').val();
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
