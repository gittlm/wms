//查看详细信息
$('.table').on("click","tbody td a",function(){
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
//点击查看跳转到入库单页面
$('[name="btn_out"]').click(function(){
	var id = $(this).data("id");
	var name = $(this).data("part_items_name");
	window.location.href = "put_out_list.php?id="+id+"&name="+name+"";
})