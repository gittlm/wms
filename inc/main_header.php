 <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <!-- <a href="#" class="logo hidden-xs" style="width: 180px;"> -->
    <a href="#" class="logo hidden-xs">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg str_wrap">超级管理平台</span>
    </a>

    <!-- Header Navbar -->
    <!-- <nav class="navbar navbar-static-top" role="navigation" style="margin-left: 180px;"> -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div style="float:left;color:#fff;padding:15px 10px;" id="every_name"></div>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu pull-right">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="images/user-190.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?=$manager->name?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="images/user-190.png" class="img-circle" alt="User Image">
                <p><?=$manager->name?></p>
                <p class="visible-xs-block"><small>管理</small></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="javascript:void(0)" name="btn_edit_pwd" class="btn btn-default btn-flat"><i class="fa fa-key text-yellow"></i> 修改密码</a>
                </div> -->
                <div class="pull-right">
                  <a href=" logout.php" class="btn btn-default btn-flat"><i class="fa fa-power-off text-red"></i> 注销登陆</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
