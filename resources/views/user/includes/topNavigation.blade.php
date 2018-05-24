<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                        <img src="{{ asset('asset/user/images') }}/img.jpg" alt="">

                        @if(Session::has('validUserOfficialEmail'))
                       {{ Session::get('validUserOfficialEmail') }}
                       @else
                     {{  $validUserCheck }}
                       @endif

                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Profile</a></li>
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/user/logout') }}"> Logout</a>
                        </li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">{{ Session :: get('rejectNotification') }}</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src="{{ asset('asset/user/images') }}/img.jpg" alt="Profile Image" /></span>
                                <span>
                          <span>{{ Session::get('validUserOfficialEmail') }}</span>
                        </span>
                              <a href="{{ url('/user/damage-notification-session') }}"> <span class="message">
                          {{ Session::get('rejectMessage') }}
                        </span>
                              </a>
                            </a>
                        </li>
                        {{--<li>--}}
                            {{--<a>--}}
                                {{--<span class="image"><img src="{{ asset('asset/user/images') }}/img.jpg" alt="Profile Image" /></span>--}}
                                {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>