<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use DB;

class AnnouncementController extends Controller
{
    public function announcement(){
        return view('admin.announcement.announcementForm');
    }


    public function submitAnnouncement(Request $request){

        $this->validate($request, [
            'submitted_date' => 'required',
            'title' => 'required',
            'description' => 'required',
            'publication_status' => 'required'
        ]);

         $announcement = new Announcement();

         $announcement->submitted_date = $request->submitted_date;
         $announcement->title = $request->title;
         $announcement->description = $request->description;
         $announcement->publication_status = $request->publication_status;

         $announcement->save();

         return redirect('/employee/post-announcement')->with('message','Post public announcement successfully');
    }


    public function manageAnnouncement(){

        $announcements = DB::table('announcements')->orderBy('id','desc')->get();

        return view('/admin.announcement.manage-announcement',[

            'announcements' => $announcements
        ]);
    }


    public function unpublishedAnnouncement($announcementId){

        DB::table('announcements')->where('id', $announcementId)->update(['publication_status' => 0]);

        return redirect('employee/manage-announcement')->with('message', 'Unpublished annuncements publication status successfully');

    }


    public function publishedAnnouncement($announcementId){

        DB::table('announcements')->where('id', $announcementId)->update(['publication_status' => 1]);

        return redirect('employee/manage-announcement')->with('message', 'Published annuncements publication status successfully');

    }


    public function editAnnouncement($announcementId){

        $announcementId = DB::table('announcements')->where('id',$announcementId)->get();

        return view('admin.announcement.edit-announcement',[

            'announcementId' => $announcementId

        ]);
    }


    public function updateAnnouncement(Request $request){

        $announcement = Announcement::find($request->announcement_id);


            $announcement->submitted_date = $request->submitted_date;
            $announcement->title = $request->title;
            $announcement->description = $request->description;
            $announcement->publication_status = $request->publication_status;

            $announcement->save();

        return redirect('/employee/manage-announcement')->with('message','Update  announcement successfully :)');

    }


    public function deleteAnnouncement($announcementId){

        DB::table('announcements')->where('id',$announcementId)->delete();

        return redirect('/employee/manage-announcement')->with('message','Delete  announcement successfully :)');


    }

}
