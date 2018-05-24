@extends('user.master')

@section('content')

    <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Announcement <small>Notice Board</small></h2>
                        <br>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sl No </th>
                                    <th class="column-title">Pubished Date </th>
                                    <th class="column-title">Title </th>
                                    <th class="column-title">Notice </th>
                                    <th class="column-title">Action </th>
                                </tr>
                                </thead>
                                <?php $sl=1 ?>
                                @foreach($publishedNotices as  $publishedNotice)
                                <tbody>
                                <tr class="even pointer">
                                    <td class=" "> {{ $sl }} </td>
                                    <td class=" "> {{ $publishedNotice->submitted_date }} </td>
                                    <td class=" "> {{ $publishedNotice->title }} </td>
                                    <td class=" "> {{ $publishedNotice->description }} </td>
                                    <td><a href="{{ url('/user/notice-board-details/'.$publishedNotice->id) }}"  class="btn btn-primary btn-xs" title="delete">
                                            <span class="glyphicon glyphicon-zoom-in">View</span>
                                        </a></td>
                                </tr>

                                </tbody>
                                    <?php $sl++ ?>
                                   @endforeach
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div


@endsection