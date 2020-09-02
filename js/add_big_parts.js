//添加大类
$('#add_big_sort_form').submit(function(e) {
	e.preventDefault();
	var name = $('#big_sort').val();
	var params = {
		"name":name,
		"type":1
	}
	$.post("ajax/add_part_file.php", params,function(data,status){
		if (status == "success") {
			$("#add_big_sort").modal("hide");
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
$('[name="btn_look"]').click(function(){
	var id = $(this).data("id");
    var name = $(this).data("name");
    window.location.href="add_small_parts.php?id="+id+"&big_name="+name;
})
//修改大类
$('[name="btn_edit"]').click(function(){
	$('#edit_big_sort').modal("show");
	var name = $(this).data("name");
	var id = $(this).data("id");
	$('#big_sort_edit').val(name);
	
	$('#edit_big_sort_form').submit(function(e) {
		e.preventDefault();
		var params = {
			"id": id,
			"name": $('#big_sort_edit').val(),
			"type": 1
		}
		$.post("ajax/change_part_file.php", params,function(data,status){
			if (status == "success") {
				$("#edit_big_sort").modal("hide");
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
	
})
