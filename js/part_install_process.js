$(document).ready(function(){
	//列表的显示
	show_table();
	//图片的显示
	show_photo();
	//专用配件使用记录
	btn_click();
})

var show_table = function(){
	$('[name="install_num"]').click(function(){
		var id = $(this).data("part_orders_id");
		var table = $(this).parentsUntil("table");
		var name = table.find("tr").eq(3).find("td").eq(1).html();
		var params = {
			"id": id,
			"name":name
		}
		$.post('ajax/get_part_install_out_records_file.php', params, function(data,status){
			if(status == "success"){
				$("#show_table").modal("show");
				$('#return_show').html(data);
			}
		})
	})
}
var show_photo = function(){
	$('.box').on("click",".btn_photo",function(){
		var id = $(this).find("i").data("id");
		var img_path='';
		$.post('ajax/get_part_install_pics_file.php', {"id":id}, function(data,status){
			var j = eval ("(" + data + ")");
			for (var i = 0; i < j.pic_path_array.length; i++) {
				img_path += '</br><img src="'+j.pic_path_array[i]["path"]+'" alt="" class="img-thumbnail text-center"></br></br>';
			}
			if(j.pic_path_array.length > 0){
				$('.pic_look').html(img_path);
			}
		})
		$('#show_photo').modal("show");
	})
} 
var btn_click = function(){
	$("#special_part_list").click(function(){
		window.location.href = "special_part_list.php";
	})
}