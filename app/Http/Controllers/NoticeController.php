<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    public function noticeBoard(){

      $publishedNotices = DB::table('announcements')->where('publication_status',1)->orderBy('id','desc')->get();

        return view('user.notice.notice-board',[

            'publishedNotices' => $publishedNotices
        ]);

    }


    public function noticeBoardDetails($id){

        $notice = DB::table('announcements')->where('id',$id)->get();

        return view('/user/notice/notice-board-details',[

            'notice' => $notice

        ]);
    }

}
