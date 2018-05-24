<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ 'admin/dist/' }}/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
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
            <li class="active treeview">
                <a href="{{ url('/dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Employee</span>
                    <span class="pull-right-container">
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/employee/add-new-employee') }}"><i class="fa fa-circle-o"></i> Add New Employee</a></li>
                    <li><a href="{{ url('employee/manage-employee-personal-info') }}"><i class="fa fa-circle-o"></i> Manage Employee Personal Info</a></li>
                    <li><a href="{{ url('/employee/manage-employee-job-info') }}"><i class="fa fa-circle-o"></i> Manage Employee Job Info</a></li>
                    <li><a href="{{ url('/employee/view-ex-employee') }}"><i class="fa fa-circle-o"></i> View EX Employee</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Attendance</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Daily Attendance
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/employee/current-date') }}"><i class="fa fa-circle-o"></i> Current Date</a></li>
                            <li><a href="{{ url('/employee/select-attendence-date') }}"><i class="fa fa-circle-o"></i> Select Date</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Monthly Attendance
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Current Month
                                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ url('/employee/select-employee-for-current-month-attendance-report') }}"><i class="fa fa-circle-o"></i> Select Employee</a></li>
                                    <li><a href="{{ url('/employee/all-employees-current-month-attendance-report') }}"><i class="fa fa-circle-o"></i> All Employees</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Select Month
                                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ url('/employee/employee-month-select-form') }}"><i class="fa fa-circle-o"></i> Single Employee</a></li>
                                    <li><a href="{{ url('/employee/all-employees-attendance-select-month-form') }}"><i class="fa fa-circle-o"></i> All Employees</a></li>
                                </ul>
                            </li>


                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Leave</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/employee/leave-approval-table') }}"><i class="fa fa-circle-o"></i> Leave Approval</a></li>
                    <li class="treeview"><a href="#">
                            <i class="fa fa-circle-o"></i>
                            <span>Leave Employee</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/employee/current-month-leave-employees') }}"><i class="fa fa-circle-o"></i> Current Month</a></li>
                        <li><a href="{{ url('/employee/select-month-leave-employees') }}"><i class="fa fa-circle-o"></i> Select Month</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Resign</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/employee/resign-approval-table') }}"><i class="fa fa-circle-o"></i> Resign Approval</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Damarage</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/damarage/damarage-form') }}"><i class="fa fa-circle-o"></i>  Damarage Form</a></li>
                    <li><a href="{{ url('/damarage/select-damarage-employee') }}"><i class="fa fa-circle-o"></i> View Damarage Employee </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Payroll</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/payroll/advance-salary-approval') }}"><i class="fa fa-circle-o"></i>  Advance Salary Approval</a></li>
                    <li><a href="{{ url('/payroll/select-employee') }}"><i class="fa fa-circle-o"></i>  Advance Salary Employee</a></li>
                    <li><a href="{{ url('/payroll/employee-salary-sheet') }}"><i class="fa fa-circle-o"></i> Salary</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Announcement</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/employee/post-announcement') }}"><i class="fa fa-circle-o"></i>Post Announcement </a></li>
                    <li><a href="{{ url('/employee/manage-announcement') }}"><i class="fa fa-circle-o"></i> Manage Announcement</a></li>

                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>