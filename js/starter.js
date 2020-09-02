
$(document).ready(function(){
  //初始时间插件
  $('#repair_time').mobiscroll().calendar({
    theme: "mobiscroll", 
    lang: "zh", 
    display: "bottom", 
    controls: ['calendar', 'time'],
    showScrollArrows: true
  });

   //添加故障完成日期按钮
  $("[name='btn-input']").click(function(){
    $("#fault_id").val(this.dataset.id);
    $("#input_modal").modal("show");
  });
	//添加故障完成日期表单
  $('#add_input_form').submit(function(e) {
    e.preventDefault();
		if ($("#repair_time").val() != "") {
      var params = {
        repair_time : $("#repair_time").val(), //故障完成日期
        id : $("#fault_id").val() //故障记录id
      }
			$.post("ajax/add_repair_date.php", params, function(data,status){
				if (status == "success") {
					$("#input_modal").modal("hide");
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
	 		});
		}
	});


});
