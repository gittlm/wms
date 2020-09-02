//添加小类
$('#add_small_sort_form').submit(function(e) {
	e.preventDefault();
	var val = $('[name="big_sort"]').val();
	if(val != 0){
		var name = $('#small_sort').val();
		var params = {
			"big_sort_id": $('[name="big_sort"]').val(),
			"name":name,
			"type":2
		}
		$.post("ajax/add_part_file.php", params,function(data,status){
			if (status == "success") {
				$("#add_small_sort").modal("hide");
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
		$("#dialog_content").html("未选择大类");
		$("#dialog").modal("show");
	}
}) 
$('[name="btn_look"]').click(function(){
	var big_id = $('#big_id_hid').val();
	var big_name = $('#big_name_hid').val();
	var small_id = $(this).data("id");
    var small_name = $(this).data("name");
    window.location.href="add_parts_items.php?big_id="+big_id+"&big_name="+big_name+"&small_id="+small_id+"&small_name="+small_name;
})
//修改小类
$('[name="btn_edit"]').click(function(){
	$('#edit_small_sort').modal("show");
	var name = $(this).data("name");
	var id = $(this).data("id");
	var up_big_sort_id = $('[name="big_sort_edit_small"]').val()*1;
	$('#small_sort_edit').val(name);
	$('#edit_small_sort_form').submit(function(e) {
		e.preventDefault();
		var params = {
			"id": id,//小类ID
			"up_big_sort_id": up_big_sort_id,//大类原来的ID
			"big_sort_id": $('[name="big_sort_edit_small"]').val(),//大类修改后的ID
			"name": $('#small_sort_edit').val(),//小类修改后的名称
			"type": 2//小类类型
		}
		if(params.big_sort_id == "0"){
			$("#dialog_content").html("未选择大类");
			$("#dialog").modal("show");
		}else{
			$.post("ajax/change_part_file.php", params,function(data,status){
				if (status == "success") {
					$("#edit_small_sort").modal("hide");
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
		}
    })
	
})
