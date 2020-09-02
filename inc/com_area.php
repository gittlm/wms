<div class="row" id="statis_chart">
  <div class="col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?=$maint_manager->get_com_area_ele_num()?></h3>
        <p>部门维保总台数</p>
      </div>
      <div class="icon">
        <i class="ion ion-wrench"></i>
      </div>
      <a href="dpt_elevator.php" class="small-box-footer">详细信息 <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>10</h3>
        <p>今日应维保台数</p>
      </div>
      <div class="icon">
        <i class="ion ion ion-android-sunny"></i>
      </div>
      <a href="ele_maint_info.php?d1=<?=$start_date?>&d2=<?=$start_date?>" class="small-box-footer">详细信息 <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3>5</h3>
        <p>已维保超期台次</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-time"></i>
      </div>
      <a href="ele_fault_info.php?unfinished=1" class="small-box-footer">详细信息 <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3>3</h3>
        <p>超期未维保台次</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-timer"></i>
      </div>
      <a href="ele_fault_info.php?unfinished=1" class="small-box-footer">详细信息 <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
<div class="col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3>3</h3>
        <p>故障未处理完成数量</p>
      </div>
      <div class="icon">
        <i class="ion ion-alert-circled"></i>
      </div>
      <a href="ele_fault_info.php?unfinished=1" class="small-box-footer">详细信息 <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>0</h3>
        <p>45天内检验到期台数</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-checkbox-outline"></i>
      </div>
      <a href="ele_file.php?check_d1=2019-06-03&amp;check_d2=2019-07-03" class="small-box-footer">详细信息 <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>