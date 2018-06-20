@include('user.includes.header.header')

<header class="main-header">
    <!-- Logo -->
    <a href="{{Route('receiver/dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b></b> Dashboard </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notification_click">
              <i class="fa fa-bell-o"></i>
              @if(!empty(Auth::user()->myNotification->where('user_id',Auth::user()->user_id)->where('status',1)->count()))
                <span class="label label-warning">
                  
                    {{Auth::user()->myNotification->where('user_id',Auth::user()->user_id)->where('status',1)->count()}}
                
                </span>
              @endif
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have  notifications</li>
              <li>
                  
                  <ul class="menu">       

                   @foreach(Auth::user()->myNotification as $notification)

                    <li>
                      <a href="#">
                        <i class="fa fa-warning text-yellow"></i>
                        {{$notification->message}}

                      </a>
                    </li>

                   @endforeach

                  </ul>
                
              </li>

              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::User()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  {{Auth::User()->name}} - Web Developer
                  <small>{{Auth::User()->created_at}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{Route('auth/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::User()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview main-dashboard">
          <a href="{{Route('receiver/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview sub-documents">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span> Documents </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li class="treeview-menu-documents" id="sub-create-category-document"><a href="{{Route('category_document')}}"><i class="fa fa-circle-o"></i> Category Document </a></li> -->
            <li class="treeview-menu-documents" id="sub-create-document"><a href="{{Route('user/documents')}}"><i class="fa fa-circle-o"></i> Documents </a></li>
            <!-- <li class="treeview-menu-documents" id="sub-request-document"><a href="{{Route('document/request')}}"><i class="fa fa-circle-o"></i> Request Document </a></li> -->
            <li class="treeview-menu-documents" id="sub-document-tracking"><a href="{{Route('receiver/documents/received')}}"><i class="fa fa-circle-o"></i> Received Documents </a></li>

          </ul>
        </li>
        </li>
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">  	

    @yield('content')

  </div>	


<script type="text/javascript">
  
  $('#notification_click').click(function(){

    $.ajax({

      type: 'GET',

      dataType: 'json',

      url: "{{url('user/notification/'.Auth::user()->user_id)}}",

      success:function(response){

      }

    });

  });

</script>
@include('user.includes.footer.footer')