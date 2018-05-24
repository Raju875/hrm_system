<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        @include('user.includes.sidebarHeader')
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ url('/user/home') }}"><i class="fa fa-home"></i> Home </a>
                    </li>
                    <li><a><i class="fa fa-table"></i> Attendence <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/user/daily-attendence-sheet') }}">Daily Attendence Sheet</a></li>
                            <li><a href="{{ url('/usre/monthly-attendence-report') }}">Monthly Attendence Report</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Leave <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/user/leave-form') }}">Leave Form</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Salary <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/user/advance-salary-form') }}">Advance Salary Form</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Resign <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/user/resign-form') }}">Resign Form</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Notice  <span class="fa fa-chevron-down"></span>  </a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/user/notice-board') }}">Notice Board</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
       @include('user.includes.sidebarFooter')
        <!-- /menu footer buttons -->
    </div>
</div>