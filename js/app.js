//初始化日期插件
if ($(".form-date").length > 0) {
  $(".form-date").datetimepicker({
    language:  "zh-CN",
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0,
    format: "yyyy-mm-dd"
  });
}
if ($(".form-datetime").length > 0) {
  $(".form-datetime").datetimepicker({
    language:  "zh-CN",
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0,
    format: "yyyy-mm-dd hh:ii"
  });
}
$(document).ready(function(){
  if ($("#header").length > 0){
    $("#header").headroom();
  }
});
function MM_jumpMenu(targ,selObj,restore){ 
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
var changeSvg = function(classname,w,h){
  var obj = $("."+classname + " svg");
  obj.each(function(){
    var width = $(this).attr("width");
    var height = $(this).attr("height");
    $(this).attr("viewBox","0,0,"+width+","+height);
    $(this).attr("width",w);
    $(this).attr("height",h);
  });
}