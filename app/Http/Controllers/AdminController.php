<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use DateTime;
use Session;
use Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{
    // use AuthenticatesUsers;


    //
    public function hiflyerdashboard()
    {
       
        $unread = DB::table('mail')
        ->where('Status', 'Unread')
        ->count();

        $session_unreaddata = Session::put('unreadmail',$unread);

        $applicant = DB::table('onlineapplication')
        ->where('Status', 'Pending')
        ->count();

        $session_pendingapplicant = Session::put('pendingapplicant',$applicant);

        $total_user = DB::table('users')
        ->where('Status','<>','Delete')
        ->count();

        $countmessage = DB::select('SELECT COUNT(id) as total_message FROM mail');


        $getmailunread = DB::table('mail')
        ->where('status','Unread')
        ->orderBy('id','DESC')
        ->limit('5')
        ->get();

       

    	return View('hiflyerdashboard')
        ->with('user',$total_user)
        ->with('unreadmessage',$session_unreaddata)
	    ->with('countmessage',$countmessage)
        ->with('pendingapplicant',$session_pendingapplicant)
        ->with('unread',$getmailunread);
    }


    public function mailfrom($id)
    {
         $id_user = $id;
     
         $getmailfromuser = DB::select('SELECT id,contact,subject,message,lastname,email,store_number,transaction_number,transaction_date,created_at,status FROM mail WHERE id = ?',[$id_user]);

         return View('mailfrom')->with('mailfrom',$getmailfromuser);

    }

    public function markread(Request $request,$id) 
    {
    	$id_user_update = $id;
    	$now = new DateTime();
        $button_update = $request->input('update');
        $status_update = 'Read';

        $button_delete = $request->input('delete');
        $status_delete = 'Deleted';

        if(isset($button_update))
        {
            DB::update('UPDATE mail SET status = ?,  updated_at = ? WHERE id = ?',[
                $status_update,
                $now,
                $id_user_update
            ]); 

            return redirect('hiflyerdashboard');
        }



        if(isset($button_delete))
        {
            DB::update('UPDATE mail SET status = ?,  updated_at = ? WHERE id = ?',[
                $status_delete,
                $now,
                $id_user_update
            ]);   

            return redirect('hiflyerdashboard');
        }
    }

    public function mails()
    {
    	$mail = DB::table('mail')
    	->orderBy('id', 'desc')
    	->get();
    	return View('mails')
    	->with('getmail',$mail);
    }


    public function viewapplicants() 
    {
    	$usersapplication = DB::table('onlineapplication')
        ->orderBy('id','DESC')
        ->get();

        return View('viewapplicants')->
        with('userapplication',$usersapplication);
    }

    public function viewapplication($id)
    {
        $application_id = $id;
        $usersapplication = DB::select('SELECT * FROM onlineapplication WHERE id = ?',[

            $application_id

        ]);
        return View('viewapplication')->with('application',$usersapplication);
    }

    public function updateapplication(Request $request)
    {
        $get_application_id = $request->input('hid_id');
        $applicant_status = $request->input('user_status');
        $now = new DateTime();
        DB::update('UPDATE onlineapplication SET Status = ?, update_at = ? WHERE id = ?',[
            $applicant_status,
            $now,
            $get_application_id
        ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }


    //--------------------------------------Home ---------------------------------- //

    public function home_update_manager()
    {
        $table_update_home = DB::select("SELECT cs.status,content_id,content_section,content_title,link,content,file,file_type FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? and cs.status != ? ",[

                'Home',
                'Delete'

            ]);
        return View('home_update_manager')->with('update_home',$table_update_home);
    }

    public function delete_home($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Delete',
                $now,
                $id_content


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_home($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Inactive',
                $now,
                $id_content


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function get_update_home($id)
    {
        $id_content = $id;

        $update_get_home = DB::select("SELECT cs.status,content_id,content_section,content_title,link,content,file,file_type FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? AND content_id = ? ",[

                'Home',
                $id_content

            ]);
        return View('get_update_home')->with('table_home',$update_get_home);
    }

    public function insert_update_home(Request $request)
    {


        $id_content = $request->input('hid_id');

        $content_header = $request->input('content_header');

        $content_article = $request->input('content_article');

        $asset_type = $request->input('asset_type');

        $content_bothimagevideo = $request->input('file');

        $home_status = $request->input('home_status');

        $file_upload = $request->file('file');

        $link = $request->input('button_link');

        $now = new DateTime();



        if($request->hasFile('file'))
        {
            $request->validate([
                'file' => 'required|mimes:mp4,jpg,jpeg,png',
                
            ]);
           
            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);
           

            DB::update('UPDATE content_structure SET  content_title = ?, content = ?, link = ?, status = ?, updated_at = ? WHERE content_id = ? ',[

                $content_header,
                $content_article,
                $link,
                $home_status,
                $now,
                $id_content

            ]);


            DB::update('UPDATE content_upload_assets SET file = ?, file_type = ?, updated_at = ? WHERE cid = ? ',[

                $filename,
                $asset_type,
                $now,
                $id_content


            ]);


           

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();

        }
        else
        {
            
            DB::update('UPDATE content_structure SET  content_title = ?, content = ?, link = ?, status = ?, updated_at = ? WHERE content_id = ? ',[

                $content_header,
                $content_article,
                $link,
                $home_status,
                $now,
                $id_content

            ]);


            
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }


        
    }

    //--------------------------------------Home ---------------------------------- //



    //--------------------------------------COMPANY ---------------------------------- //

    public function company_update_manager()
    {
        $table_update_history = DB::select("SELECT cs.status,content_id,content_section,content_title,link,content,file,file_type FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? and cs.status != ? ",[

                'History',
                'Delete'

            ]);
        return View('company_update_manager')->with('update_history',$table_update_history);
    }
    public function delete_company($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Delete',
                $now,
                $id_content


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_company($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Inactive',
                $now,
                $id_content


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }
    public function get_update_company($id)
    {
        $id_content = $id;

        $update_get_company = DB::select("SELECT cs.status,content_id,content_section,content_title,content FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? AND content_id = ? ",[

                'History',
                $id_content

            ]);
        return View('get_update_company')->with('table_company',$update_get_company);
    }



    public function insert_update_company(Request $request)
    {
        $id_content = $request->input('hid_id');
 

        $content_status = $request->input('company_status');
        $content_header = $request->input('content_header');
        $content_section = $request->input('content_section');
        $content_article = $request->input('content_article');

        $now = new DateTime();
        

        DB::update('UPDATE content_structure SET content_title = ?, content_section = ?, content = ?, status = ?, updated_at = ? WHERE content_id  = ? ',[


            $content_header,
            $content_section,
            $content_article,
            $content_status,
            $now,
            $id_content


        ]);
        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    //--------------------------------------COMPANY ---------------------------------- //


    //--------------------------------------NEWS ---------------------------------- //
    public function news_update_manager()
    {
        $table_update_news = DB::select("SELECT cs.status,content_id,content_section,content_title,content FROM content_structure as cs 
            WHERE content_pages = ? and cs.status != ? ",[

                'News',
                'Delete'

            ]);
        return View('news_update_manager')->with('update_news',$table_update_news);
    }
    public function delete_news($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Delete',
                $now,
                $id_content


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_news($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Inactive',
                $now,
                $id_content


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function get_update_news($id)
    {   
        $id_content = $id;

        $table_get_update_news = DB::select("SELECT cs.status,content_id,content_section,content_title,content FROM content_structure as cs 
            WHERE content_pages = ? AND content_id = ? ",[

                'News',
                $id_content

            ]);
        return View('get_update_news')->with('table_news',$table_get_update_news);
    }

    public function insert_update_news(Request $request)
    {
        $id_content = $request->input('hid_id');
 

        $content_status = $request->input('news_status');
        $content_header = $request->input('content_header');
        $content_article = $request->input('content_article');

        $now = new DateTime();
        

        DB::update('UPDATE content_structure SET content_title = ?, content = ?, status = ?, updated_at = ? WHERE content_id  = ? ',[


            $content_header,
            $content_article,
            $content_status,
            $now,
            $id_content


        ]);
        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function news_update_image_manager($id)
    {
        $image_id = $id;

        $get_images = DB::select('SELECT id,file FROM content_upload_assets WHERE cid = ? ',[

            $image_id


        ]);

        return View('news_update_image_manager')->with('update_images',$get_images);
    }

    public function get_news_image($id)
    {
        $image_id = $id;

        $get_update_image = DB::select('SELECT id,file FROM content_upload_assets WHERE id =? ',[
            $image_id
        ]);
        return View('get_news_image')->with('update_image',$get_update_image);
    }

    public function insert_news_image(Request $request)
    {
        $image_id = $request->input('hid_id');
        $now = new DateTime();

        if($request->hasFile('file'))
        {

            $request->validate([
                'file' => 'required|mimes:jpg,jpeg,png',
                
            ]);
          
            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);
           
            DB::update('UPDATE content_upload_assets SET file = ?, updated_at = ? WHERE id = ? ',[

                $filename,
                $now,
                $image_id


            ]);
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();

        }

    }

    //--------------------------------------NEWS ---------------------------------- //


    //--------------------------------------Gallery ---------------------------------- //

    public function gallery_update_manager()
    {
        $gallery_table = DB::select('SELECT cs.status,content_id,content_section,content_title,event_place,event_date,link,content,file,file_type FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? and cs.status != ?',[

            'Gallery',
            'Delete' 

        ]);
        return View('gallery_update_manager')->with('table_gallery',$gallery_table);
    }

    public function delete_gallery($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Delete',
                $now,
                $id_content


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_gallery($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Inactive',
                $now,
                $id_content


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function get_update_gallery($id)
    {
        $content_id = $id;

        $get_gallery_table = DB::select('SELECT content_id,id,file,content,event_place,event_date,content_title,cs.status,cs.created_at as date_created FROM content_structure as cs LEFT JOIN (SELECT id,cid,file FROM content_upload_assets) cua ON cs.content_id = cua.cid WHERE content_pages = ? AND content_id = ? ORDER BY content_id DESC',[

            'Gallery',
            $content_id


        ]);
        return View('get_update_gallery')->with('get_table',$get_gallery_table);
    }

    public function insert_update_gallery(Request $request)
    {

        $id_content = $request->input('hid_id');

        $content_status = $request->input('gallery_status');

        $content_header = $request->input('content_header');

        $content_article = $request->input('content_article');

        $event_place = $request->input('event_place');

        $event_date = $request->input('event_date');

        $now = new DateTime();

        if($request->hasFile('file'))
        {
            $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
            
            ]);

            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::update('UPDATE content_structure SET content_title = ?, content = ?, event_place = ?, event_date = ?, status = ?, updated_at = ? WHERE content_id = ?',[


                $content_header,
                $content_article,
                $event_place,
                $event_date,
                $content_status,    
                $now,
                $id_content

            ]);


            DB::update('UPDATE content_upload_assets SET file = ?, updated_at = ? WHERE cid = ?',[


                $filename,
                $now,
                $id_content

            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
            
        }
        else
        {
            DB::update('UPDATE content_structure SET content_title = ?, content = ?, event_place = ?, event_date = ?,  status = ?, updated_at = ? WHERE content_id = ?',[


                $content_header,
                $content_article,
                $event_place,
                $event_date,
                $content_status,    
                $now,
                $id_content

            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }

    }

    public function gallery_update_image_manager($id)
    {
        
        $image_id = $id;

        $get_update_image_gallery = DB::select('SELECT id,image FROM album_category WHERE cid =? ',[
            $image_id
        ]);

        return View('gallery_update_image_manager')->with('update_image',$get_update_image_gallery);

    }

    public function get_gallery_image($id)
    {
        $get_image_id = $id;

        $get_image = DB::select('SELECT id,image FROM album_category WHERE id =? ',[
            $get_image_id
        ]);

        return View('get_gallery_image')->with('get_update_image',$get_image);

    }

    public function delete_gallery_image($id)
    {
       
        $get_image_id = $id;
        
        DB::delete('DELETE FROM album_category WHERE id = ?',[
            $get_image_id
        ]);

        return redirect()->back();
    }

    public function insert_gallery_image(Request $request)
    {
        $image_id = $request->input('hid_id');
        $now = new DateTime();

        if($request->hasFile('file'))
        {

            $request->validate([
                'file' => 'required|mimes:jpg,jpeg,png',
                
            ]);
          
            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);
           
            DB::update('UPDATE album_category SET image = ?, updated_at = ? WHERE id = ? ',[

                $filename,
                $now,
                $image_id


            ]);
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();

        }

    }


    //--------------------------------------Gallery ---------------------------------- //



     //--------------------------------------Directory ---------------------------------- //


    public function directory_update_manager()
    {
        $store_table = DB::select('SELECT id,city,store_code,branch_name,store_address,store_contactnumber,
            store_businesshour,image,store_lat,store_long,store_type,store_status FROM store_locator WHERE store_status = ? OR store_status = ? ',[

            'Active',
            'Inactive'

        ]);
        return View('directory_update_manager')->with('store_table',$store_table);
    }

    public function delete_store($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE store_locator SET store_status = ?, updated_at = ? WHERE id = ?',[

                'Delete',
                $now,
                $id_content


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_store($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE store_locator SET store_status = ?, updated_at = ? WHERE id = ?',[

                'Inactive',
                $now,
                $id_content


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }



    public function get_update_store($id)
    {
        $store_id = $id;

        $get_store_table = DB::select('SELECT id,city,store_code,branch_name,store_address,store_contactnumber,store_businesshour,image,store_lat,store_long,store_type,store_status FROM store_locator WHERE id = ?',[

            $store_id
            

        ]);

        return View('get_update_store')->with('store_table',$get_store_table);
    }


    public function insert_update_store(Request $request)
    {
        $hid_id = $request->input('hid_id');
        $id_store = $hid_id;
        $city = $request->input('city');
        $branch = $request->input('branch');
        $store_type = $request->input('store_type');
        $store_code = $request->input('store_code');
        $store_number = $request->input('store_number');
        $store_address = $request->input('store_address');
        $store_hour = $request->input('store_hour');
        $lat = $request->input('lat');
        $long = $request->input('long');
        
        $content_image = $request->input('content_assets');

        $now = new DateTime();

        $file_upload = $request->file('content_assets');

        $store_status = $request->input('store_status');

        $string_store_type = implode(',',$store_type);

        if($request->hasFile('file'))
        {
             $request->validate([
             'file' => 'required|mimes:jpg,jpeg,png',
             ]);
             

            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

             DB::update('UPDATE store_locator SET city = ?, store_code = ?, branch_name = ?, store_address = ?, store_contactnumber = ?, store_businesshour = ?, store_lat = ?, store_long = ?, store_type = ?, image = ?, store_status = ?, updated_at = ? WHERE id = ? ',[


                $city,
                $store_code,
                $branch,
                $store_address,
                $store_number,
                $store_hour,
                $lat,
                $long,
                $string_store_type,
                $filename,
                $store_status,
                $now,
                $id_store



            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }
        else
        {
            DB::update('UPDATE store_locator SET city = ?, store_code = ?, branch_name = ?, store_address = ?, store_contactnumber = ?, store_businesshour = ?, store_lat = ?, store_long = ?, store_type = ?, store_status = ?, updated_at = ? WHERE id = ? ',[


                $city,
                $store_code,
                $branch,
                $store_address,
                $store_number,
                $store_hour,
                $lat,
                $long,
                $string_store_type,
                $store_status,
                $now,
                $id_store



                ]);
            \Session::flash('message', 'Successfully inserted!');
             return redirect()->back();
        }
    }





    //--------------------------------------Directory ---------------------------------- //




    //--------------------------------------Community ---------------------------------- //

    public function community_update_manager()
    {

        $table_update_community = DB::select("SELECT cs.status,content_id,content_section,content_title,link,content,file,file_type FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? and cs.status != ? ",[

                'Community',
                'Delete'
               

            ]);
        return View('community_update_manager')->with('update_community',$table_update_community);
    }
    public function delete_community($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Delete',
                $now,
                $id_content


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_community($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Inactive',
                $now,
                $id_content


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function get_update_community($id)
    {
        $content_id = $id;

        $get_table_update_community = DB::select("SELECT cs.status,content_id,content_section,content_title,link,content,file,file_type FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? and content_id = ? ",[

                'Community',
                $content_id

            ]);

        return View('get_update_community')->with('table_community',$get_table_update_community);
    }

    public function insert_update_community(Request $request)
    {


        $id_content = $request->input('hid_id');

        $content_header = $request->input('content_header');

        $content_article = $request->input('content_article');

        $community_status = $request->input('community_status');

        $file_upload = $request->file('file');

        $link = $request->input('button_link');

        $now = new DateTime();



        if($request->hasFile('file'))
        {
            $request->validate([
                'file' => 'required|mimes:jpg,jpeg,png',
                
            ]);
            
            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);
           

            DB::update('UPDATE content_structure SET  content_title = ?, content = ?, link = ?, status = ?, updated_at = ? WHERE content_id = ? ',[

                $content_header,
                $content_article,
                $link,
                $community_status,
                $now,
                $id_content

            ]);


            DB::update('UPDATE content_upload_assets SET file = ?, updated_at = ? WHERE cid = ? ',[

                $filename,
                $now,
                $id_content


            ]);
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();

        }
        else
        {
            
            DB::update('UPDATE content_structure SET  content_title = ?, content = ?, link = ?, status = ?, updated_at = ? WHERE content_id = ? ',[

                $content_header,
                $content_article,
                $link,
                $community_status,
                $now,
                $id_content

            ]);
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }


        
    }




     //--------------------------------------Community ---------------------------------- //




     //--------------------------------------Job ---------------------------------- //

    public function job_update_manager()
    {
        $table_job = DB::select('SELECT id,position_name,position_desc,position_requirements,location,status FROM job_position WHERE status = ? OR status = ? ',[

            'Active',
            'Inactive'

        ]);
        return View('job_update_manager')->with('update_job',$table_job);
    }

    public function delete_job($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE job_position SET status = ?, updated_at = ? WHERE id = ?',[

                'Delete',
                $now,
                $id_content


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_job($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE job_position SET status = ?, updated_at = ? WHERE id = ?',[

                'Inactive',
                $now,
                $id_content


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function get_update_job($id)
    {

        $job_id = $id;

        $get_table_job = DB::select('SELECT id,position_name,position_desc,position_requirements,location,status FROM job_position WHERE id = ? ',[

             $job_id

        ]);

        return View('get_update_job')

        ->with('get_update_job_table',$get_table_job);
    }


    public function insert_update_job(Request $request)
    {

        $hid_id = $request->input('hid_id');
        $id_job = $hid_id;

        $postname = $request->input('position_name');
        $postdescription = $request->input('postdescription');
        $postrequirements = $request->input('postrequirements');
        $location = $request->input('location');
        $job_status = $request->input('job_status');
        $now = new DateTime();

        DB::update('UPDATE job_position SET position_name = ?, position_desc = ?, position_requirements = ?, location = ?, status = ?, updated_at = ? WHERE id = ? ',[

            $postname,
            $postdescription,
            $postrequirements,
            $location,
            $job_status,
            $now,
            $id_job

        ]);
        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }



    //--------------------------------------Job ---------------------------------- //


    //--------------------------------------Slider ---------------------------------- //

    public function slider_update_manager()
    {
        $table_update_slider = DB::select("SELECT cs.status,content_id,content_section,content_title,link,content,file,file_type FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? and cs.status != ? ",[

                'Slider',
                'Delete'

            ]);
        return View('slider_update_manager')->with('update_slider',$table_update_slider);
    }
    public function delete_slider($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Delete',
                $now,
                $id_content


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_slider($id) 
    {
        $now = new DateTime();
        $id_content = $id;
        DB::update('UPDATE content_structure SET status = ?, updated_at = ? WHERE content_id = ?',[

                'Inactive',
                $now,
                $id_content


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function get_update_slider($id)
    {

        $content_id = $id;

        $get_table_carousel = DB::select('SELECT cs.status,content_id,content_section,content_title,link,content,file,file_type FROM content_structure as cs 
            LEFT JOIN content_upload_assets as cua ON cs.content_id = cua.cid
            WHERE content_pages = ? AND content_id = ? ',[

            'Slider',
            $content_id

        ]);

        return View('get_update_slider')->with('table_slider',$get_table_carousel);

    }

    public function insert_update_slider(Request $request)
    {

        $hid_id = $request->input('hid_id');

        $id_content = $hid_id;

        $content_status = $request->input('slider_status');

        $link = $request->input('link');

        $now = new DateTime();


    
        if($request->hasFile('file'))
        {
            $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
            
            ]);

            $filename = $request->file->hashName();
            $request->file->storeAs('public',$filename);


            DB::update('UPDATE content_upload_assets SET  file = ?, updated_at = ? WHERE cid = ?',[

                $filename,
                $now,
                $id_content

            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
            
        }
        else
        {
            DB::update('UPDATE content_structure SET  link = ?, status = ?, updated_at = ? WHERE content_id = ?',[

                $link,
                $content_status,    
                $now,
                $id_content

            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }
        
    }


    //--------------------------------------Slider ---------------------------------- //



    public function home_insert_manager()
    {
        return View('home_insert_manager');
    }

    public function content_inserting_home(Request $request)
    {
        $content_page = $request->input('content_page');

        $content_section = $request->input('content_section');

        $content_header = $request->input('content_header');

        $content_article = $request->input('content_article');

        $asset_type = $request->input('asset_type');

        $button_link = $request->input('button_link');

        $now = new DateTime();

        $userId =  Auth::user()->email;


        if($request->hasFile('file'))
        {
            $request->validate([
            'file' => 'required|mimes:mp4,jpg,jpeg,png,gif',
            
            ]);

            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::insert('INSERT INTO content_structure (uploader,content_pages,content_section,content_title,content,link,status,created_at) VALUES (?,?,?,?,?,?,?,?) ',[

                $userId,
                $content_page,
                $content_section,
                $content_header,
                $content_article,
                $button_link,
                'Active',
                $now

            ]);


            $last_id_insert = DB::select('SELECT LAST_INSERT_ID() as id FROM content_structure');
            foreach($last_id_insert as $result)
            {
              $id_last_inserted = $result->id;

            }


            DB::insert('INSERT INTO content_upload_assets (cid,file,file_type,created_at) VALUES (?,?,?,?) ',[

                 $id_last_inserted,
                 $filename,
                 $asset_type,
                 $now


            ]);

           


            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();


        }
        else
        {
             DB::insert('INSERT INTO content_structure (uploader,content_pages,content_section,content_title,content,link,status,created_at) VALUES (?,?,?,?,?,?,?,?) ',[

                $userId,
                $content_page,
                $content_section,
                $content_header,
                $content_article,
                $button_link,
                'Active',
                $now

            ]);

           

            $last_id_insert = DB::select('SELECT LAST_INSERT_ID() as id FROM content_structure');
            foreach($last_id_insert as $result)
            {
              $id_last_inserted = $result->id;

            }


       


            \Session::flash('message', 'Successfully submitted!');
              return redirect()->back();
        }

    
    }


    public function company_insert_manager()
    {
        return View('company_insert_manager');
    }

    public function content_inserting_history(Request $request)
    {
        $content_page = $request->input('content_page');
        $content_year = $request->input('content_year');
        $content_article = $request->input('content_article');
        $content_section = $request->input('content_section');
        $now = new DateTime();

        $userId =  Auth::user()->email;

        DB::insert('INSERT INTO content_structure (uploader,content_pages,content_title,content,content_section,status,created_at) VALUES (?,?,?,?,?,?,?) ',[

            $userId,
            $content_page,
            $content_year,
            $content_article,
            $content_section,
            'Active',
            $now

        ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
        
    }


    public function news_insert_manager()
    {
        return View('news_insert_manager');
    }

     public function content_inserting_news(Request $request)
    {

        $content_page = $request->input('content_page');
        $content_header = $request->input('content_header');
        $content_article = $request->input('content_article');
        $asset_type = $request->input('asset_type');
        $file_upload = $request->file('file');
        $now = new DateTime();
        $userId =  Auth::user()->email;

        if($request->hasFile('file'))
        {
            DB::insert('INSERT INTO content_structure (uploader,content_pages,content_title,content,status,created_at) VALUES (?,?,?,?,?,?) ',[

            $userId,
            $content_page,
            $content_header,
            $content_article,
            'Active',
            $now

            ]);

            $last_id_insert = DB::select('SELECT LAST_INSERT_ID() as id FROM content_structure');
            foreach($last_id_insert as $result)
            {
              $id_last_inserted = $result->id;

            }


            foreach($file_upload as $value)
            {
                
                $name=$value->hashName();
                $value->move(public_path().'/storage/',$name);
                DB::insert('INSERT INTO content_upload_assets (cid,file,file_type,created_at) VALUES (?,?,?,?) ',[

                     $id_last_inserted,
                     $name,
                     $asset_type,
                     $now


                ]);
            }
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }

    }


    public function gallery_insert_manager()
    {
        return View('gallery_insert_manager');
    }

    public function content_inserting_gallery(Request $request)
    {
        $content_page = $request->input('content_page');

        $content_header = $request->input('content_header');

        $content_article = $request->input('content_article');

        $event_place = $request->input('event_place');

        $event_date = $request->input('event_date');

        $now = new DateTime();

        $userId =  Auth::user()->email;

        
        if($request->hasFile('file'))
        {
            $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
            
            ]);

            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);
           

            DB::insert('INSERT INTO content_structure (uploader,content_pages,content_title,content,event_place,event_date,status,created_at) VALUES (?,?,?,?,?,?,?,?) ',[

                $userId,
                $content_page,
                $content_header,
                $content_article,
                $event_place,
                $event_date,
                'Active',
                $now

            ]);

            $last_id_insert = DB::select('SELECT LAST_INSERT_ID() as id FROM content_structure');
            foreach($last_id_insert as $result)
            {
              $id_last_inserted = $result->id;

            }

            DB::insert('INSERT INTO content_upload_assets (cid,file,file_type,created_at) VALUES (?,?,?,?) ',[

                 $id_last_inserted,
                 $filename,
                 'Image',
                 $now


            ]);


        }
        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();

    }


    public function gallery_album_insert_manager()
    {
        $select_allalbum = DB::select('SELECT content_id,content_title FROM content_structure WHERE content_pages = ? AND status = ? ',[

            'Gallery',
            'Active'

        ]);
        return View('gallery_album_insert_manager')->with('album',$select_allalbum);
    }

    public function gallery_album_insert(Request $request)
    {

        $file_upload = $request->file('file');
        $album_name = $request->input('album_name');
        $now = new DateTime();

        if($request->hasFile('file'))
        {
            foreach($file_upload as $value)
            {
                

                $filename =  $value->hashName();
                $request->file->storeAs('public',$filename);

                DB::insert('INSERT INTO album_category (cid,image,created_at) VALUES (?,?,?) ',[

                     $album_name,
                     $filename,
                     $now


                ]);
            }
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }

    }


    public function directory_insert_manager()
    {
        return View('directory_insert_manager');
    }

    public function content_inserting_directory(Request $request)
    {
        //$content_page = $request->input('content_page');
        $city = $request->input('city');
        $branch = $request->input('branch');
        $store_type = $request->input('store_type');
        $store_code = $request->input('store_code');
        $store_number = $request->input('store_number');
        $store_address = $request->input('store_address');
        $store_hour = $request->input('store_hour');
        $lat = $request->input('lat');
        $long = $request->input('long');
        $now = new DateTime();


        $string_store_type = implode(',',$store_type);

        if($request->hasFile('file'))
        {
            $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
            
            ]);



            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::insert('INSERT INTO store_locator 
            (city,store_code,branch_name,store_address,store_contactnumber,store_businesshour,store_lat,store_long,store_type,image,store_status,created_at)

            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)


            ',[$city,$store_code,$branch,$store_address,$store_number,$store_hour,$lat,$long,$string_store_type,$filename,'Active',$now]);
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
            
        }
        else
        {
             DB::insert('INSERT INTO store_locator 
            (city,store_code,branch_name,store_address,store_contactnumber,store_businesshour,store_lat,store_long,store_type,store_status,created_at)

            VALUES(?,?,?,?,?,?,?,?,?,?,?)


            ',[$city,$store_code,$branch,$store_address,$store_number,$store_hour,$lat,$long,$string_store_type,'Active',$now]);
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }

        


    }


    public function community_insert_manager()
    {
        return View('community_insert_manager');
    }

    public function content_inserting_community(Request $request)
    {
        $content_page = $request->input('content_page');

        $content_section = $request->input('content_section');

        $content_header = $request->input('content_header');

        $content_article = $request->input('content_article');

        $asset_type = $request->input('asset_type');

        $link = $request->input('button_link');


        $now = new DateTime();
        $userId =  Auth::user()->email;


        if($request->hasFile('file'))
        {
            $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
            
            ]);




           $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::insert('INSERT INTO content_structure (uploader,content_pages,content_section,content_title,link,content,status,created_at) VALUES (?,?,?,?,?,?,?,?) ',[

                $userId,
                $content_page,
                $content_section,
                $content_header,
                $link,
                $content_article,
                'Active',
                $now

            ]);


            $last_id_insert = DB::select('SELECT LAST_INSERT_ID() as id FROM content_structure');

            foreach($last_id_insert as $result)
            {
              $id_last_inserted = $result->id;

            }


            DB::insert('INSERT INTO content_upload_assets (cid,file,file_type,created_at) VALUES (?,?,?,?) ',[

                 $id_last_inserted,
                 $filename,
                 $asset_type,
                 $now


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();

        }
        else
        {
            DB::insert('INSERT INTO content_structure (uploader,content_pages,content_section,content_title,link,content,status,created_at) VALUES (?,?,?,?,?,?,?,?) ',[

                $userId,
                $content_page,
                $content_section,
                $content_header,
                $link,
                $content_article,
                'Active',
                $now

            ]);
            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
        }
    
    }


    public function job_insert_manager()
    {
        return View('job_insert_manager');
    }

    public function content_inserting_job(Request $request)
    {
        $postname = $request->input('postname');
        $postdescription = $request->input('postdescription');
        $postrequirements = $request->input('postrequirements');
        $location = $request->input('location');
        $status = 'Active';
        $now = new DateTime();

        DB::insert('INSERT INTO job_position (position_name,position_desc,position_requirements,location,status,created_at)
            VALUES (?,?,?,?,?,?)',[$postname,$postdescription,$postrequirements,$location,$status,$now]);
        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }


    public function slider_insert_manager()
    {
        return View('slider_insert_manager');
    }

    public function content_inserting_slider(Request $request)
    {
        

        $content_page = $request->input('content_page');

        $slider_link = $request->input('slider_link');

        $active_image = $request->input('active_image');

        $now = new DateTime();

        $userId =  Auth::user()->email;

        
        if($request->hasFile('file'))
        {

            DB::insert('INSERT INTO content_structure (uploader,content_pages,link,status,slider_sorting,created_at) VALUES (?,?,?,?,?,?) ',[

                $userId,
                $content_page,
                $slider_link,
                'Active',
                $active_image,
                $now

            ]);

            $last_id_insert = DB::select('SELECT LAST_INSERT_ID() as id FROM content_structure');

            foreach($last_id_insert as $result)
            {
              $id_last_inserted = $result->id;

            }

            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::insert('INSERT INTO content_upload_assets (cid,file,file_type,created_at) VALUES (?,?,?,?) ',[

                $id_last_inserted,
                $filename,
                'Image',
                $now

            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
           
        }
       
    }
   

   //////USER MANAGEMENT ///////////////////////////////////////////////////////

    public function user_management()
    {
        $user_list = DB::select('SELECT id,name,role,email,created_at,status FROM users WHERE status != ?',[

            'Delete'

        ]);
        return View('user_management')->with('users',$user_list);
    }

    public function get_update_user($id)
    {
        $user_id = $id;
        $get_user_update =  DB::select('SELECT id,name,password,role,email,created_at,status FROM users WHERE id = ?',[

            $user_id

        ]); 
        return View('get_update_user')->with('update_user',$get_user_update);
    }

    public function insert_update_user(Request $request)
    {
        $hid_id = $request->input('hid_id');
        $user_name = $request->input('user_name');
        $user_role = $request->input('user_role');
        $user_email = $request->input('user_email');
        $user_password = $request->input('user_password');
        $hashpassword = Hash::make($user_password);
        $user_status = $request->input('user_status');
        $now = new DateTime();

        DB::update('UPDATE users SET name = ?, role = ?, email = ?, password = ?, updated_at = ?, Status = ? WHERE id = ?',[

            $user_name,
            $user_role,
            $user_email,
            $hashpassword,
            $now,
            $user_status,
            $hid_id

        ]);

         \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function delete_user($id) 
    {
        $now = new DateTime();
        $id_user = $id;
        DB::update('UPDATE users SET Status = ?, updated_at = ? WHERE id = ?',[

                'Delete',
                $now,
                $id_user


            ]);

            \Session::flash('message', 'Successfully submitted!');
            return redirect()->back();
    }

    public function inactive_user($id) 
    {
        $now = new DateTime();
        $id_user = $id;
        DB::update('UPDATE users SET status = ?, updated_at = ? WHERE id = ?',[

                'Inactive',
                $now,
                $id_user


            ]);

        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function user_registered(Request $request)
    {
        $user_name = $request->input('user_name');
        $user_email = $request->input('user_email');
        $user_password = $request->input('user_password');
        $hashed_password = Hash::make($user_password);
        $user_position = $request->input('user_position');
        $manager_assign = $request->input('manager_assign');

        $now = new DateTime();

        DB::insert('INSERT INTO users (name,role,email,password,manager_location_assign,created_at,Status) VALUES   (?,?,?,?,?,?,?) ',[

            $user_name,
            $user_position,
            $user_email,
            $hashed_password,
            $manager_assign,
            $now,
            'Active'


        ]);
        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }


  

    //for delivery


    public function menu_section() {
        return View('menu_section');
    }


    public function menu_insert_manager()
    {
        $select_section = DB::select('SELECT menu_sec_id,menu_sec_name FROM menu_section WHERE menu_sec_status = ? ',[
            'Active'
        ]);
        return View('menu_insert_manager')->with('menu_section_choices',$select_section);
    }

    public function insert_menu_section(Request $request) {
        
        $field=$request->get('menu_value');
        $menu_sec_desc = $request->get('menu_sec_desc');
        $now = new DateTime();

        DB::insert('INSERT INTO menu_section (menu_sec_name,menu_sec_desc,menu_sec_created,menu_sec_status) VALUES (?,?,?,?) ',[
            $field,
            $menu_sec_desc,
            $now,
            'Active'
          ]);


        return response()->json('Successfully Inserted');
       
       
    
    }


    public function menu_inserting(Request $request) {

        $menu_section_choices = $request->input('menu_section_choices');

        $menu_name = $request->input('menu_name');

        $file_data = $request->input('file_data');

        $menu_description = $request->input('menu_description');

        $now = new DateTime();

       

        if($request->hasFile('file'))
        {
      
            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::insert('INSERT INTO menu (menu_name,menu_section_id,menu_desc,menu_main_image,menu_created,menu_status) VALUES (?,?,?,?,?,?) ',[

                $menu_name,
                $menu_section_choices,
                $menu_description,
                $filename,
                $now,
                'Active'


            ]);

             return response()->json('Successfully Inserted');
           
        }
        else
        {
            DB::insert('INSERT INTO menu (menu_name,menu_section_id,menu_desc,menu_created,menu_status) VALUES (?,?,?,?,?) ',[

                $menu_name,
                $menu_section_choices,
                $menu_description,
                $now,
                'Active'

            ]);

            return response()->json('Successfully Inserted');
        }
    }


    // public function menu_category_insert_manager() {

   



    //     return View('/menu_category_insert_manager')->with('menu_choices',$select_menu);
    // }





    public function customer_data() {



         $select_menu = DB::select('SELECT menu_cat_id,chain_id,menu_cat_name,menu_cat_desc,menu_cat_price,menu_cat_image FROM menu_category WHERE menu_cat_status = ?',[
            'Active'
        ]);

         

         $select_delivery_charge = DB::select('SELECT charge_value FROM delivery_charge_rate');


        if(Auth::user())
        {
            $get_customer_details = DB::select('SELECT customer_id,name,role,customer_name,customer_address,customer_order_note,customer_number,customer_registered,customer_email,customer_status,customer_location FROM customer_details as cd LEFT JOIN (SELECT * FROM users) users ON cd.customer_location = users.manager_location_assign WHERE customer_location = ? GROUP BY customer_id,customer_name ',[

                Auth::user()->store_name
            
                

            ]);

            $total_users = DB::select('SELECT COUNT(*) as "total_users" FROM customer_details WHERE customer_location = ? ',[

                Auth::user()->store_name

            ])[0]->total_users;


            $total_users_already_delivered = DB::select('SELECT COUNT(delivery_status) as "total_users_already_delivered" FROM order_properties WHERE order_ship_province = ? AND delivery_status =? ',[

                Auth::user()->store_name,
                'Delivered'

            ])[0]->total_users_already_delivered;


            $total_users_cancelled_deliver = DB::select('SELECT COUNT(delivery_status) as "total_users_cancelled_deliver" FROM order_properties WHERE order_ship_province = ? AND delivery_status =? ',[

                Auth::user()->store_name,
                'Cancelled'

            ])[0]->total_users_cancelled_deliver;


            $get_tax = DB::select('SELECT name,province_name,value FROM users LEFT JOIN(SELECT province_name,value FROM province_tax) pt ON users.manager_location_assign = pt.province_name WHERE users.role = ? LIMIT 1 ',[

                Auth::user()->role
            ]);

            return View('customer_data',compact('total_users','total_users_already_delivered','total_users_cancelled_deliver'))
            ->with('customer_details',$get_customer_details)
            ->with('category',$select_menu)
            ->with('tax',$get_tax)
            ->with('delivery_charge',$select_delivery_charge);
        }
        // else
        // {
            
        //     return View('customer_data',compact('total_users'))
            
        //     ->with('category',$select_menu);
        // }
    }

    public function customer_data_append(Request $request) {

        $customer_id = $request->get('customer_id');

        $get_customer_details_append = DB::select('SELECT customer_id,customer_name,customer_address,customer_number,customer_registered,customer_email,customer_status,customer_location FROM customer_details WHERE customer_id = ? ',[

            $customer_id

        ]);
        
        return response()->json($get_customer_details_append);
        // return View('customer_data')->with('append_details',$get_customer_details_append);
    }

    public function insert_customer_details(Request $request)
    {
         $customer_name = $request->input('customer_name');
         $customer_number = $request->input('customer_number');
         $customer_email = $request->input('customer_email');
         $customer_address = $request->input('customer_address');
         $customer_location = $request->input('customer_location');
         $customer_order = $request->input('customer_order');
         $customer_postal = $request->input('customer_postal');
         $now = new DateTime();

        //check first if exist user before insert
        $check_user_exist = DB::select("SELECT COUNT(*) as validation FROM customer_details WHERE 
         customer_number LIKE '%".$customer_number."%'");


        foreach($check_user_exist as $check_validation)
        {
          $get_validation = $check_validation->validation;

        }


         if($get_validation > 0)
         {
            return response()->json('User Already Exist');
         }
         else
         {
            DB::insert('INSERT INTO customer_details (customer_name,customer_number,customer_address,customer_location,customer_order_note,customer_email,customer_registered,customer_status,customer_postal_code) VALUES (?,?,?,?,?,?,?,?,?) ',[

                $customer_name,
                $customer_number,
                $customer_address,
                $customer_location,
                $customer_order,
                $customer_email,
                $now,
                'On Going',
                $customer_postal
            ]);

            return response()->json('Successfully Inserted');
         }


        
    }


    public function customize_customer_order() {

        //get all the menu

        $menu_sharing_image = DB::select('SELECT menu_sec_image FROM menu_section WHERE menu_sec_name = ? ORDER BY menu_sec_id DESC LIMIT 1 ',['Sharing']);

        $menu_data_sharing = DB::select(' SELECT menu_sec_name,menu_name,menu_sec_image,menu_main_image FROM menu_section as ms LEFT JOIN (SELECT menu_section_id,menu_name,menu_main_image FROM menu) m ON m.menu_section_id = ms.menu_sec_id WHERE menu_name != "" AND ms.menu_sec_name = ?  ORDER BY menu_name ASC', [

            'Sharing'

        ]);

        return View('customize_customer_order')
        ->with('menu_data_sharing',$menu_data_sharing)
        ->with('menu_sharing_image',$menu_data_sharing);
    }


    public function insert_customer_order_properties(Request $request) {

        $customer_id = $request->get('customer_id');
        $order_ship_address = $request->get('order_ship_address');
        $order_ship_province = $request->get('order_ship_province');
        $order_number = $request->get('order_number');
        $now = new DateTime();


        DB::insert('INSERT INTO order_properties (customer_id,order_date,or_number,order_ship_address,order_ship_province) 
            VALUES(?,?,?,?,?) ',[

             $customer_id,
             $now,
             $order_number,
             $order_ship_address,
             $order_ship_province


        ]);
        
        return response()->json('Successfully Inserted');

    } 


    public function insert_customer_order_details_properties(Request $request) {

        
        $product_id = $request->get('product_id');
        $UnitPrice = $request->get('UnitPrice');
        $Quantity = $request->get('Quantity');

        $last_id_insert = DB::select('SELECT max(order_id) as id FROM order_properties');

        foreach($last_id_insert as $result)
        {
          $id_last_inserted = $result->id;

        }

        DB::insert('INSERT INTO order_details_properties (order_properties_id,product_id,UnitPrice,Quantity) 
            VALUES(?,?,?,?) ',[

             $id_last_inserted,
             $product_id,
             $UnitPrice,
             $Quantity


        ]);

        return response()->json('Successfully Inserted');


    } 

    public function insert_customer_payment_details(Request $request) {

        $payment_customer_id = $request->get('payment_customer_id');
        $total_amount = $request->get('total_amount');
        $customer_sub_total = $request->get('customer_sub_total');
        $payment_order_number = $request->get('payment_order_number');
        $tax_rate = $request->get('tax_rate');

        $last_id_insert = DB::select('SELECT max(order_id) as id FROM order_properties');

        foreach($last_id_insert as $result)
        {
          $id_last_inserted = $result->id;

        }

        DB::insert('INSERT INTO payment (customer_id,amount,subtotal,order_number,total_tax,order_id) 
            VALUES(?,?,?,?,?,?) ',[

             $payment_customer_id,
             $total_amount,
             $customer_sub_total,
             $payment_order_number,
             $tax_rate,
             $id_last_inserted


        ]);

        return response()->json('Successfully Inserted');

    } 


    public function customers_details() {

        if(Auth::user())
        {
            $get_customer_details = DB::select('SELECT customer_id,name,role,customer_name,customer_address,customer_number,customer_registered,customer_email,customer_status,customer_location FROM customer_details as cd LEFT JOIN (SELECT * FROM users) users ON cd.customer_location = users.manager_location_assign WHERE customer_location = ? GROUP BY customer_id,customer_name ',[

                Auth::user()->store_name
            
                

            ]);

           return View('customers_details')->with('customer_details',$get_customer_details);
        }
        
    }


    public function customer_profile($id) {

        $customer_details_id = DB::select('SELECT * FROM customer_details WHERE customer_id = ? ',[$id]);

        $select_order_properties = DB::select('SELECT * FROM order_properties WHERE customer_id = ? ORDER BY order_id DESC LIMIT 3',[$id]);

        $select_order_details = DB::select('SELECT order_properties_id,menu_cat_image,or_number,Quantity,Subtotal,menu_cat_name FROM order_properties as op LEFT JOIN (SELECT order_properties_id,product_id,UnitPrice,Quantity,(UnitPrice * Quantity) as Subtotal FROM order_details_properties) odp ON op.order_id = odp.order_properties_id 
        LEFT JOIN (SELECT menu_cat_image,menu_cat_name,menu_cat_id FROM menu_category) mc ON odp.product_id = mc.menu_cat_id
        WHERE customer_id = ?  ',[
            $id
        ]);

        return View('customer_profile')
        ->with('customer_details',$customer_details_id)
        ->with('order_properties',$select_order_properties)
        ->with('customer_order',$select_order_details);

    } 


    public function delivery_status() {

        if(Auth::user())
        {
             $order_details = DB::select('SELECT op.order_id,op.customer_id,customer_name,customer_number,op.or_number,delivery_status,order_ship_address,delivery_status,order_date,amount,driver_name FROM order_properties as op LEFT JOIN (SELECT customer_id,order_id,amount,subtotal FROM payment) p ON op.order_id = p.order_id LEFT JOIN (SELECT customer_id,customer_name,customer_location,customer_number FROM customer_details) cd ON op.customer_id = cd.customer_id LEFT JOIN (SELECT driver_id,driver_name FROM driver) drive ON op.driver_id = drive.driver_id WHERE customer_location = ? AND DATE(order_date)=CURDATE()
            ',[Auth::user()->store_name]);

            $select_driver_by_store = DB::select('SELECT driver_id,driver_name,driver_email,driver_number,store_driver,driver_status FROM driver WHERE store_driver = ? ',[
                Auth::user()->store_name
            ]);

            $select_driver_by_store = DB::select('SELECT driver_id,driver_name,driver_email,driver_number,store_driver,driver_status FROM driver WHERE driver_status = ? AND store_driver = ? ',['Available',Auth::user()->store_name]);


            return view('delivery_status')
            ->with('driver_details',$select_driver_by_store)
            ->with('customer_orders_details',$order_details);
        }


       
    }

    public function delivery_confirmation_status($customer_id,$order_id) {


        $customer_details_id = DB::select('SELECT * FROM customer_details WHERE customer_id = ? ',[$customer_id]);

        $select_delivery_charge = DB::select('SELECT charge_value FROM delivery_charge_rate');
       
        $select_order_properties = DB::select('SELECT * FROM order_properties as op 
        LEFT JOIN (SELECT order_id,amount,subtotal,total_tax FROM payment) p 
        ON op.order_id = p.order_id
        WHERE op.order_id = ? LIMIT 1',[$order_id]);

        $select_order_details = DB::select('SELECT order_properties_id,menu_cat_image,or_number,Quantity,Subtotal,menu_cat_name FROM order_properties as op LEFT JOIN (SELECT order_properties_id,product_id,UnitPrice,Quantity,(UnitPrice * Quantity) as Subtotal FROM order_details_properties) odp ON op.order_id = odp.order_properties_id 
        LEFT JOIN (SELECT menu_cat_image,menu_cat_name,menu_cat_id FROM menu_category) mc ON odp.product_id = mc.menu_cat_id
        WHERE order_id = ?  ',[
            $order_id
        ]);

        return View('delivery_confirmation_status')
        ->with('customer_details',$customer_details_id)
        ->with('order_properties',$select_order_properties)
        ->with('delivery_charge',$select_delivery_charge)
        ->with('customer_order',$select_order_details);


    }

    public function order_detail($customer_id,$order_id) {

        $customer_details_id = DB::select('SELECT * FROM customer_details WHERE customer_id = ? ',[$customer_id]);

        $select_delivery_charge = DB::select('SELECT charge_value FROM delivery_charge_rate');
       
        $select_order_properties = DB::select('SELECT * FROM order_properties as op 
        LEFT JOIN (SELECT order_id,amount,subtotal,total_tax FROM payment) p 
        ON op.order_id = p.order_id
        WHERE op.order_id = ? LIMIT 1',[$order_id]);

        $select_order_details = DB::select('SELECT order_properties_id,menu_cat_image,or_number,Quantity,Subtotal,menu_cat_name FROM order_properties as op LEFT JOIN (SELECT order_properties_id,product_id,UnitPrice,Quantity,(UnitPrice * Quantity) as Subtotal FROM order_details_properties) odp ON op.order_id = odp.order_properties_id 
        LEFT JOIN (SELECT menu_cat_image,menu_cat_name,menu_cat_id FROM menu_category) mc ON odp.product_id = mc.menu_cat_id
        WHERE order_id = ?  ',[
            $order_id
        ]);

        return View('order_detail')
        ->with('customer_details',$customer_details_id)
        ->with('order_properties',$select_order_properties)
        ->with('delivery_charge',$select_delivery_charge)
        ->with('customer_order',$select_order_details);
    }


    public function customer_all_orders($id,Request $request) {

        $filter = $request->get('filter');
        if(isset($filter))
        {
            $customer_details_id = DB::select('SELECT * FROM customer_details WHERE customer_id = ? ',[$id]);

            $select_order_properties = DB::select('SELECT * FROM order_properties WHERE customer_id = ? ORDER BY order_id DESC LIMIT 3 ',[$id]);

            $select_order_details = DB::select('SELECT order_properties_id,menu_cat_image,or_number,Quantity,Subtotal,menu_cat_name FROM order_properties as op LEFT JOIN (SELECT order_properties_id,product_id,UnitPrice,Quantity,(UnitPrice * Quantity) as Subtotal FROM order_details_properties) odp ON op.order_id = odp.order_properties_id 
            LEFT JOIN (SELECT menu_cat_image,menu_cat_name,menu_cat_id FROM menu_category) mc ON odp.product_id = mc.menu_cat_id
            WHERE customer_id = ?  ',[
                $id
            ]);

            return View('customer_all_orders')
            ->with('customer_details',$customer_details_id)
            ->with('order_properties',$select_order_properties)
            ->with('customer_order',$select_order_details);
        }
        else
        {
            $customer_details_id = DB::select('SELECT * FROM customer_details WHERE customer_id = ? ',[$id]);

            $select_order_properties = DB::select('SELECT * FROM order_properties WHERE customer_id = ? ORDER BY order_id DESC LIMIT 4',[$id]);

            $select_order_details = DB::select('SELECT order_properties_id,menu_cat_image,or_number,Quantity,Subtotal,menu_cat_name FROM order_properties as op LEFT JOIN (SELECT order_properties_id,product_id,UnitPrice,Quantity,(UnitPrice * Quantity) as Subtotal FROM order_details_properties) odp ON op.order_id = odp.order_properties_id 
            LEFT JOIN (SELECT menu_cat_image,menu_cat_name,menu_cat_id FROM menu_category) mc ON odp.product_id = mc.menu_cat_id
            WHERE customer_id = ?  ',[
                $id
            ]);


            return View('customer_all_orders')
            ->with('customer_details',$customer_details_id)
            ->with('order_properties',$select_order_properties)
            ->with('customer_order',$select_order_details);
        }

        
    }

    public function order_status_update(Request $request) {
        
        $deliver_status = $request->get('deliver_status');
        $cancelled_status = $request->get('cancelled_status');
        $order_id = $request->get('order_id');

        if($deliver_status == 'Delivered')
        {
            DB::update('UPDATE order_properties SET delivery_status = ? WHERE order_id = ? ',[
                $deliver_status,
                $order_id
            ]);

            return response()->json('Successfully Updated');

        }
        if($cancelled_status == 'Cancelled')
        {
            DB::update('UPDATE order_properties SET delivery_status = ? WHERE order_id = ? ',[
                $cancelled_status,
                $order_id
            ]);

            return response()->json('Successfully Updated');
        }

    }


    public function delivery_driver() {

        $select_driver_by_store = DB::select('SELECT driver_id,driver_name,driver_email,driver_number,store_driver,driver_status FROM driver WHERE store_driver = ? ',[
            Auth::user()->store_name
        ]);

        return View('delivery_driver')->with('drivers',$select_driver_by_store);
        
    }

    public function driver_registered(Request $request) {

        $driver_name = $request->get('driver_name');
        $driver_email = $request->get('driver_email');
        $driver_number = $request->get('driver_number');
        $driver_store = $request->get('driver_store');
        $now = new DateTime();

        DB::insert('INSERT INTO driver (driver_name,driver_email,driver_number,store_driver,date_created) VALUES   (?,?,?,?,?) ',[

           $driver_name,
           $driver_email,
           $driver_number,
           $driver_store,
           $now


        ]);

       
        return response()->json('Successfully Inserted');
    }


    public function store_account_list()
    {
        $user_list = DB::select('SELECT id,name,role,store_name,manager_location_assign,email,created_at,status FROM users WHERE status != ? AND role = ?',[

            'Delete',
            '3'

        ]);
        return View('store_account_list')->with('users',$user_list);
    }


    public function store_registered(Request $request)
    {
        $user_name = $request->input('user_name');
        $user_email = $request->input('user_email');
        $user_password = $request->input('user_password');
        $hashed_password = Hash::make($user_password);
        $user_position = $request->input('user_position');
        $manager_assign = $request->input('manager_assign');
        $store_name = $request->input('store_name');
        $store_postal = $request->input('store_postal');

        $now = new DateTime();

        DB::insert('INSERT INTO users (name,role,email,password,manager_location_assign,store_name,created_at,Status,store_postal_code) VALUES   (?,?,?,?,?,?,?,?,?) ',[

            $user_name,
            '3',
            $user_email,
            $hashed_password,
            $manager_assign,
            $store_name,
            $now,
            'Active',
            $store_postal


        ]);
        \Session::flash('message', 'Successfully submitted!');
        return redirect()->back();
    }

    public function update_driver_status_available(Request $request) {

        $driver_id = $request->get('driver_id');
        $now = new DateTime();

        $table_updated = DB::update('UPDATE driver SET driver_status = ?, date_updated = ? WHERE driver_id = ? ',[

            'Available',
            $now,
            $driver_id

        ]);
  
        return response()->json('Successfully Inserted');
    }

    public function update_driver_status_offline(Request $request) {

        $driver_id = $request->get('driver_id');
        $now = new DateTime();

        $table_updated = DB::update('UPDATE driver SET driver_status = ?, date_updated = ? WHERE driver_id = ? ',[

            'Offline',
            $now,
            $driver_id

        ]);
    
        return response()->json('Successfully Inserted');
    }

    public function customer_detail_ordering_logic(Request $request) {

        $order_id = $request->get('order_id');
        $customer_id = $request->get('customer_id');


        $customer_details_id = DB::select('SELECT * FROM order_properties WHERE customer_id = ? ',[$customer_id]);

        $select_delivery_charge = DB::select('SELECT charge_value FROM delivery_charge_rate');
       
        $select_order_properties = DB::select('SELECT * FROM order_properties as op 
        LEFT JOIN (SELECT order_id,amount,subtotal,total_tax FROM payment) p 
        ON op.order_id = p.order_id
        WHERE op.order_id = ? LIMIT 1',[$order_id]);

        $select_order_details = DB::select('SELECT order_properties_id,menu_cat_image,or_number,Quantity,Subtotal,menu_cat_name FROM order_properties as op LEFT JOIN (SELECT order_properties_id,product_id,UnitPrice,Quantity,(UnitPrice * Quantity) as Subtotal FROM order_details_properties) odp ON op.order_id = odp.order_properties_id 
        LEFT JOIN (SELECT menu_cat_image,menu_cat_name,menu_cat_id FROM menu_category) mc ON odp.product_id = mc.menu_cat_id
        WHERE order_id = ?  ',[
            $order_id
        ]);

        return response()->json(array(['customer_details_id'=>$customer_details_id,'select_delivery_charge'=>$select_delivery_charge,
            'select_order_properties'=>$select_order_properties,'select_order_details'=>$select_order_details]));
    }

    public function fetch_detail_order_monitor(Request $request) {

        $response_order_id = $request->get('response_order_id');
        $response_customer_id = $request->get('response_customer_id');

        $customers_details_id = DB::select('SELECT * FROM customer_details WHERE customer_id = ? ',[$response_customer_id]);

        $customer_details_id = DB::select('SELECT * FROM order_properties WHERE customer_id = ? ',[$response_customer_id]);

        $select_delivery_charge = DB::select('SELECT charge_value FROM delivery_charge_rate');
       
        $select_order_properties = DB::select('SELECT * FROM order_properties as op 
        LEFT JOIN (SELECT order_id,amount,subtotal,total_tax FROM payment) p 
        ON op.order_id = p.order_id
        WHERE op.order_id = ? LIMIT 1',[$response_order_id]);

        $select_order_details = DB::select('SELECT order_properties_id,menu_cat_image,or_number,Quantity,Subtotal,menu_cat_name FROM order_properties as op LEFT JOIN (SELECT order_properties_id,product_id,UnitPrice,Quantity,(UnitPrice * Quantity) as Subtotal FROM order_details_properties) odp ON op.order_id = odp.order_properties_id 
        LEFT JOIN (SELECT menu_cat_image,menu_cat_name,menu_cat_id FROM menu_category) mc ON odp.product_id = mc.menu_cat_id
        WHERE order_id = ?  ',[
            $response_order_id
        ]);

        return response()->json(array(['customer_details_id'=>$customer_details_id,'select_delivery_charge'=>$select_delivery_charge,
            'select_order_properties'=>$select_order_properties,'select_order_details'=>$select_order_details,'customers_details_id'=>$customers_details_id]));

    }


    public function get_assign_customer_to_driver(Request $request) {

        $assign_customer = $request->get('customer_id');

        $customers_details_id = DB::select('SELECT customer_name FROM customer_details WHERE customer_id = ? ',[$assign_customer]);

        return response()->json($customers_details_id);
    }

    public function update_customer_driver(Request $request) {
        
        $driver_id = $request->get('driver_id');
        $assign_customer_order_id = $request->get('assign_customer_order_id');

        DB::update('UPDATE order_properties SET driver_id = ? WHERE order_id = ? ',[
            $driver_id,
            $assign_customer_order_id
        ]);

        return response()->json('Successfully Update');
        
    }


    public function update_customer_status(Request $request) {

        $update_customer_or_number = $request->get('update_customer_or_number');
        $update_status = $request->get('update_status');
        $deleted_order = $request->get('deleted_order');

        if($update_status == 'Kitchen') {
             
             DB::update('UPDATE order_properties SET delivery_status = ? WHERE or_number = ? ',[

                'Kitchen',
                $update_customer_or_number

             ]);
             return response()->json('Successfully Update');
        }
        elseif($update_status == 'Road') {
            DB::update('UPDATE order_properties SET delivery_status = ? WHERE or_number = ? ',[

                'Road',
                $update_customer_or_number

             ]);
            return response()->json('Successfully Update');
        }
        elseif($update_status == 'Completed') {
            DB::update('UPDATE order_properties SET delivery_status = ? WHERE or_number = ? ',[

                'Completed',
                $update_customer_or_number

             ]);
            return response()->json('Successfully Update');
        }
        elseif($update_status == 'Cancelled') {
            DB::update('UPDATE order_properties SET delivery_status = ? WHERE or_number = ? ',[

                'Cancelled',
                $deleted_order

             ]);
            return response()->json('Successfully Update');
        }


       
        
    }
    
    public function logic_get_customer_data() {

        $get_customer_details = DB::select('SELECT customer_id,customer_name,customer_address,customer_order_note,customer_number,customer_registered,customer_email,customer_status,customer_location FROM customer_details as cd LEFT JOIN (SELECT * FROM users) users ON cd.customer_location = users.manager_location_assign WHERE customer_location = ? GROUP BY customer_id,customer_name ORDER BY customer_id DESC',[

            Auth::user()->store_name
        
            

        ]);
        return response()->json(array('data'=>$get_customer_details));
        // return View('logic_get_customer_data')->with('customer_details',$get_customer_details);
    }


    public function get_imaginary_customer_details() {

         $get_customer_details = DB::select('SELECT * FROM customer_details WHERE customer_location = ? ORDER BY customer_id DESC LIMIT 1',[

            Auth::user()->store_name
        
            

        ]);
        return response()->json($get_customer_details);
    }


    public function layout_menu_group() {

        $menu_section = DB::select('SELECT menu_sec_id,menu_sec_name,menu_sec_desc FROM menu_section WHERE menu_sec_status = ?',['Active']); 
        return View('layout_menu_group')->with('menu_section',$menu_section);
    }

    public function edit_layout_menu_group(Request $request) {

        $append_menu_id_edit = $request->get('append_menu_id_edit');


        $menu_section = DB::select('SELECT menu_sec_id,menu_sec_name,menu_sec_desc FROM menu_section WHERE menu_sec_id = ?',[
            $append_menu_id_edit
        ]); 

        return response()->json($menu_section);
    }

    public function update_layout_menu_group(Request $request) {

        $edit_menu_value = $request->get('edit_menu_value');
        $edit_menu_sec_desc = $request->get('edit_menu_sec_desc');
        $hidden_menu_sec_id = $request->get('hidden_menu_sec_id');
        $now = new DateTime();

        DB::update('UPDATE menu_section SET menu_sec_name = ?, menu_sec_desc = ?, menu_sec_updated = ? WHERE menu_sec_id = ? ',[
            $edit_menu_value,
            $edit_menu_sec_desc,
            $now,
            $hidden_menu_sec_id

        ]);


        return response()->json('Successfully Update');
    }


    public function delete_layout_menu_group(Request $request) {

        $deleted_menu_data = $request->get('deleted_menu_data');

        DB::update('DELETE FROM menu_section WHERE menu_sec_id = ? ',[
            $deleted_menu_data,
        ]);


        return response()->json('Successfully Deleted');
    }


    public function layout_sub_menu_group() {


        $sub_menu_section = DB::select('SELECT menu_id,menu_section_id,menu_name,menu_desc,menu_main_image FROM menu WHERE menu_status = ?',['Active']); 

        $menu_section_id = DB::select('SELECT menu_sec_id,menu_sec_name FROM menu_section WHERE menu_sec_status = ? ',['Active']);

        return View('layout_sub_menu_group')
        ->with('sub_menu_section',$sub_menu_section)
        ->with('menu_section_id',$menu_section_id);

    }


    public function edit_layout_sub_menu_group(Request $request) {

        $menu_id_edit = $request->get('append_sub_menu_id_edit');

        $sub_menu_section = DB::select('SELECT menu_id,menu_section_id,menu_name,menu_desc,menu_main_image FROM menu WHERE menu_id  = ? ',[

            $menu_id_edit

        ]); 


        return response()->json($sub_menu_section);


    }


    public function update_layout_sub_menu_group(Request $request) {

        $edit_sub_menu_value = $request->get('edit_sub_menu_value');
        $edit_sub_menu_sec_desc = $request->get('edit_sub_menu_sec_desc');
        $hidden_sub_menu_sec_id = $request->get('hidden_sub_menu_sec_id');
        $now = new DateTime();

        

        if($request->hasFile('file')) {


            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::update('UPDATE menu  SET menu_name = ?, menu_desc = ?, menu_main_image = ?, menu_updated = ? WHERE menu_id = ? ',[
                $edit_sub_menu_value,
                $edit_sub_menu_sec_desc,
                $filename,
                $now,
                $hidden_sub_menu_sec_id

            ]);

             return response()->json('Successfully Update');
        }
        else
        {
            DB::update('UPDATE menu  SET menu_name = ?, menu_desc = ?, menu_updated = ? WHERE menu_id = ? ',[
                $edit_sub_menu_value,
                $edit_sub_menu_sec_desc,
                $now,
                $hidden_sub_menu_sec_id

            ]);

             return response()->json('Successfully Update');
        }


       
    }



    public function delete_layout_sub_menu_group(Request $request) {

        $deleted_sub_menu_data = $request->get('deleted_sub_menu_data');

        DB::update('DELETE FROM menu WHERE menu_id = ? ',[
            $deleted_sub_menu_data,
        ]);


        return response()->json('Successfully Deleted');
    }



    public function layout_noun_group() {

        $noun_table = DB::select('SELECT menu_cat_id,menu_name,menu_cat_name,menu_cat_screen_name,menu_cat_desc,menu_cat_price,menu_cat_image FROM menu as m LEFT JOIN (SELECT menu_cat_id,menu_id,menu_cat_name,menu_cat_screen_name,menu_cat_desc,menu_cat_price,menu_cat_image FROM menu_category WHERE menu_cat_status = ?) mc ON m.menu_id = mc.menu_id WHERE menu_cat_id != "" ',[

            'Active'

        ]);

        $select_menu = DB::select('SELECT menu_id,menu_name FROM menu WHERE menu_status = ?',[
            'Active'
        ]);

        return view('layout_noun_group')
        ->with('noun_table',$noun_table)
        ->with('menu_choices',$select_menu);
    }


    public function menu_category_inserting(Request $request) {


        $menu_category_choices = $request->get('menu_category_choices');

        $menu_category_name = $request->get('menu_category_name');

        $menu_category_description = $request->get('menu_category_description');

        $menu_category_price = $request->get('menu_category_price');

        $menu_noun_screen = $request->get('menu_noun_screen');

        $now = new DateTime();



        if($request->hasFile('file'))
        {
      
            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::insert('INSERT INTO menu_category (menu_id,menu_cat_name,menu_cat_desc,menu_cat_price,menu_cat_image,menu_cat_created,menu_cat_status,menu_cat_screen_name) VALUES (?,?,?,?,?,?,?,?) ',[

                $menu_category_choices,
                $menu_category_name,
                $menu_category_description,
                $menu_category_price,
                $filename,
                $now,
                'Active',
                $menu_noun_screen


            ]);

            return response()->json('Successfully Inserted');
           
        }
        else
        {
            DB::insert('INSERT INTO menu_category (menu_id,menu_cat_name,menu_cat_desc,menu_cat_price,menu_cat_created,menu_cat_status,menu_cat_screen_name) VALUES (?,?,?,?,?,?,?,?) ',[

                $menu_category_choices,
                $menu_category_name,
                $menu_category_description,
                $menu_category_price,
                $now,
                'Active',
                $menu_noun_screen


            ]);

            return response()->json('Successfully Inserted');
        }
    }

    public function edit_layout_noun_group(Request $request) {

        $get_value_id = $request->get('noun_value_id');

        $noun_table = DB::select('SELECT menu_cat_id,menu_cat_name,menu_cat_screen_name,menu_cat_desc,menu_cat_price,menu_cat_image FROM menu_category WHERE menu_cat_id = ? ',[

            $get_value_id

        ]);

        return response()->json($noun_table);
    }


    public function update_layout_noun_group(Request $request) {

        $append_hidden_noun_name = $request->get('append_hidden_noun_name');
        $append_menu_category_name = $request->get('append_menu_category_name');
        $append_menu_category_price = $request->get('append_menu_category_price');
        $append_menu_category_description = $request->get('append_menu_category_description');
        $append_menu_noun_screen = $request->get('append_menu_noun_screen');
        $now = new DateTime();



        if($request->hasFile('file'))
        {

            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::update('UPDATE menu_category SET menu_cat_name =?, menu_cat_screen_name =?, menu_cat_desc =?, menu_cat_price=?, menu_cat_image=?, menu_cat_updated =? WHERE menu_cat_id =? ',[

                $append_menu_category_name,
                $append_menu_noun_screen,
                $append_menu_category_description,
                $append_menu_category_price,
                $filename,
                $now,
                $append_hidden_noun_name

            ]);

            return response()->json('Successfully Update');
        }
        else
        {

            DB::update('UPDATE menu_category SET menu_cat_name =?, menu_cat_screen_name =?, menu_cat_desc =?, menu_cat_price=?, menu_cat_updated =? WHERE menu_cat_id =? ',[

                $append_menu_category_name,
                $append_menu_noun_screen,
                $append_menu_category_description,
                $append_menu_category_price,
                $now,
                $append_hidden_noun_name

            ]);

            return response()->json('Successfully Update');
        }

    }

    public function delete_layout_noun_group(Request $request) {

        $deleted_noun_data = $request->get('deleted_noun_data');

        DB::update('DELETE FROM menu_category WHERE menu_cat_id = ? ',[
            $deleted_noun_data,
        ]);


        return response()->json('Successfully Deleted');
    }


    public function layout_condiments_group() {

        $condiment_section_table = DB::select('SELECT condiments_section_id,condiment_section_name FROM menu_section_condiments WHERE condiment_section_status = ? ',['Active']);

        $condiments_table = DB::select('SELECT cat_condi_id,condiment_section_name,cat_condi_name,cat_condi_price,cat_condi_image,cat_condi_screen_name FROM menu_cat_condiments LEFT JOIN (SELECT condiments_section_id,condiment_section_name FROM menu_section_condiments) msc ON menu_cat_condiments.condiments_section_id = msc.condiments_section_id WHERE cat_condi_status = ? ',[
            'Active'
        ]);


        return View('layout_condiments_group')
        ->with('condiments_table',$condiments_table)
        ->with('condiment_section_table',$condiment_section_table);

     }


     public function condiment_inserting(Request $request) {


        $condiment_name = $request->get('condiment_name');
        $condiment_screen = $request->get('condiment_screen');
        $condiment_price = $request->get('condiment_price');
        $select_condiments_value = $request->get('select_condiments_value');
        $now = new DateTime();

        if($request->hasFile('file'))
        {

            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::insert('INSERT INTO menu_cat_condiments (condiments_section_id,cat_condi_name,cat_condi_screen_name,cat_condi_price,cat_condi_image,cat_condi_status,cat_condi_created) VALUES (?,?,?,?,?,?,?) ',[

                $select_condiments_value,
                $condiment_name,
                $condiment_screen,
                $condiment_price,
                $filename,
                'Active',
                $now

            ]);

            return response()->json('Successfully Inserted');

        }
        else
        {
             DB::insert('INSERT INTO menu_cat_condiments (condiments_section_id,cat_condi_name,cat_condi_screen_name,cat_condi_price,cat_condi_status,cat_condi_created) VALUES (?,?,?,?,?,?) ',[

                $select_condiments_value,
                $condiment_name,
                $condiment_screen,
                $condiment_price,
                'Active',
                $now

            ]);

            return response()->json('Successfully Inserted');
        }

     }



     public function edit_condiment_inserting(Request $request) {

        $edit_condiments_value = $request->get('edit_condiments_value');

        $condiments_table = DB::select('SELECT cat_condi_id,cat_condi_name,cat_condi_price,cat_condi_image,cat_condi_screen_name FROM menu_cat_condiments WHERE cat_condi_id = ? ',[

            $edit_condiments_value

        ]);

        return response()->json($condiments_table);
     }


     public function update_condiment(Request $request) {

        $append_condiment_name = $request->get('append_condiment_name');
        $append_condiment_screen = $request->get('append_condiment_screen');
        $append_condiment_price = $request->get('append_condiment_price');
        $append_cat_condi_id = $request->get('append_cat_condi_id');
        $now = new DateTime();


        if($request->hasFile('file'))
        {
            $filename =  $request->file->hashName();
            $request->file->storeAs('public',$filename);

            DB::update('UPDATE menu_cat_condiments SET cat_condi_name=?, cat_condi_screen_name=?, cat_condi_price=?, cat_condi_image=?, cat_condi_updated=? WHERE cat_condi_id =? ',[

                $append_condiment_name,
                $append_condiment_screen,
                $append_condiment_price,
                $filename,
                $now,
                $append_cat_condi_id

            ]);

            return response()->json('Successfully Update');
        }
        else
        {
             DB::update('UPDATE menu_cat_condiments SET cat_condi_name=?, cat_condi_screen_name=?, cat_condi_price=?, cat_condi_updated=? WHERE cat_condi_id =? ',[

                $append_condiment_name,
                $append_condiment_screen,
                $append_condiment_price,
                $now,
                $append_cat_condi_id

            ]);

             return response()->json('Successfully Update');
        }

     }

     public function delete_condiment(Request $request) {

            $deleted_condiment_data = $request->get('deleted_condiment_data');

            DB::update('DELETE FROM menu_cat_condiments WHERE cat_condi_id = ? ',[
                $deleted_condiment_data,
            ]);


            return response()->json('Successfully Deleted');
     }


     public function layout_chaining_group() {


        $condiments_table = DB::select('SELECT condiments_section_id,cat_condi_id,cat_condi_name,cat_condi_price,cat_condi_image,cat_condi_screen_name FROM menu_cat_condiments WHERE cat_condi_status = ? ',[
            'Active'
        ]);

        $noun_table = DB::select('SELECT menu_cat_id,chain_conditional,menu_id,menu_cat_name,menu_cat_screen_name,menu_cat_desc,menu_cat_price,menu_cat_image FROM menu_category WHERE menu_cat_status = ? AND chain_conditional = ? ',[

            'Active',
            '0'

        ]);


        $chain_table = DB::select('SELECT noun_builder_id,menu_builder_properties_id,chain_name,created_at FROM menu_builder_properties WHERE chain_status = ? ',[
            'Active'
        ]);

        return View('layout_chaining_group')
        ->with('noun_table',$noun_table)
        ->with('condiments_table',$condiments_table)
        ->with('chain_table',$chain_table);
     }


    public function insert_menu_builder_properties(Request $request) {

        $nounScreenID = $request->get('hidden_noun_id');
        $noun_build_item = $request->get('noun_build_item');
        $now = new DateTime();

        DB::insert('INSERT INTO menu_builder_properties (noun_builder_id,chain_name,created_at,chain_status) VALUES (?,?,?,?) ',[

            $nounScreenID,
            $noun_build_item,
            $now,
            'Active'

        ]);


        $last_id_insert = DB::select('SELECT max(menu_builder_properties_id) as id FROM menu_builder_properties');

        foreach($last_id_insert as $result)
        {
          $id_last_inserted = $result->id;

        }

        DB::update('UPDATE menu_category SET chain_id = ?, chain_conditional = ? WHERE  menu_cat_id =? ',[

            $id_last_inserted,
            '1',
            $nounScreenID

        ]);

        return response()->json('Successfully Inserted');
    }


    public function insert_menu_builder_details(Request $request) {

        $Qty = $request->get('Qty');
        $Item = $request->get('Item');
        $price = $request->get('price');
        $condiment_sec_id = $request->get('condiment_sec_id');
        $allow_to_open_condiments = $request->get('allow_to_open_condiments');
        $now = new DateTime();

        $last_id_insert = DB::select('SELECT max(menu_builder_properties_id) as id FROM menu_builder_properties');

        foreach($last_id_insert as $result)
        {
          $id_last_inserted = $result->id;

        }

        DB::insert('INSERT INTO menu_builder_details (menu_builder_properties_id,Qty,Condiments,Price,allow_to_open_condiments,condiments_section_id,build_created) 
            VALUES(?,?,?,?,?,?,?) ',[

             $id_last_inserted,
             $Qty,
             $Item,
             $price,
             $allow_to_open_condiments,
             $condiment_sec_id,
             $now


        ]);

        return response()->json('Successfully Inserted');


    }


    public function get_chain_data(Request $request) {


        $get_chain_id = $request->get('get_chain_data_id');


        $get_chain_name = DB::select('SELECT SUBSTRING(chain_name, 4) AS chain_name,menu_builder_properties_id  FROM menu_builder_properties WHERE noun_builder_id = ? ',[
            $get_chain_id
        ]);


        $get_chain_data = DB::select('SELECT mbd.condiments_section_id,mbd.menu_builder_details_id,allow_to_open_condiments,menu_cat_price,Qty,Price,Condiments FROM menu_category as mc LEFT JOIN (SELECT menu_builder_properties_id,noun_builder_id FROM menu_builder_properties) mbp ON mc.menu_cat_id = mbp.noun_builder_id LEFT JOIN (SELECT menu_builder_properties_id,Qty,Price,Condiments,menu_builder_details_id,allow_to_open_condiments,condiments_section_id FROM menu_builder_details) mbd ON mbp.menu_builder_properties_id = mbd.menu_builder_properties_id WHERE menu_cat_id = ? ',[

            $get_chain_id

        ]);

        return response()->json(array(['get_chain_name'=>$get_chain_name,'get_chain_data'=>$get_chain_data]));


    }


    public function logical_delete_id_builder(Request $request) {

        $edit_find_each_id_will_update = $request->get('edit_find_each_id_will_update');
        return $edit_find_each_id_will_update;

    }

    public function insert_update_build_chain(Request $request) {

        $condiments_name = $request->get('condiments_name');
        $condimentsScreenPriced = $request->get('condimentsScreenPriced');
        $id_to_edit_build = $request->get('id_to_edit_build');

        // Check if button name "Submit" is active, do this 

         DB::update('UPDATE menu_builder_details SET Condiments = ?, Price = ? WHERE menu_builder_details_id = ? ',[

            $condiments_name,
            $condimentsScreenPriced,
            $id_to_edit_build

        ]);


        // for($i=0;$i<$count;$i++){

        //     DB::update('UPDATE menu_builder_details SET Condiments = ?, Price = ? WHERE menu_builder_details_id = ? ',[

        //         $condiments_name,
        //         $condimentsScreenPriced,
        //         $id_to_edit_build

        //     ]);

        //     $sql1="UPDATE $tbl_name SET name='$name[$i]', lastname='$lastname[$i]', email='$email[$i]' WHERE id='$id[$i]'";
        //     $result1=mysql_query($sql1);
        // }
    

        // DB::update('UPDATE menu_builder_details SET Condiments = ?, Price = ? WHERE menu_builder_details_id = ? ',[

        //     $condiments_name,
        //     $condimentsScreenPriced,
        //     $id_to_edit_build

        // ]);

        return response()->json('Successfully Update');

    }


    public function delete_layout_condiment(Request $request) {

        $layout_deleted_condiment_data = $request->get('layout_deleted_condiment_data');

        $data_attribute_menu_builder_details = $request->get('data_attribute_menu_builder_details');

        DB::delete('DELETE FROM menu_builder_properties WHERE noun_builder_id = ? ',[
            $layout_deleted_condiment_data,
        ]);


         DB::delete('DELETE FROM menu_builder_details WHERE menu_builder_properties_id = ? ',[
            $data_attribute_menu_builder_details,
        ]);


        DB::update('UPDATE menu_category SET chain_id = ?, chain_conditional = ? WHERE menu_cat_id = ? ',[
            '',
            '0',
            $layout_deleted_condiment_data,
        ]);
        return response()->json('Successfully Update');

    }

    public function layout_condiments_section(){

        $condiment_section_table = DB::select('SELECT condiments_section_id,condiment_section_name,condiment_section_desc FROM menu_section_condiments WHERE condiment_section_status = ? ',['Active']);

        return View('layout_condiments_section')->with('condiment_section_table',$condiment_section_table);
    }


    public function insert_condiment_section(Request $request) {

        $codiment_section_name = $request->get('codiment_section_name');
        $condiment_section_desc = $request->get('condiment_section_desc');
        $now = new DateTime();

        DB::insert('INSERT INTO menu_section_condiments (condiment_section_name,condiment_section_desc,condiment_section_status,condiment_section_created) VALUES (?,?,?,?) ',[

            $codiment_section_name,
            $condiment_section_desc,
            'Active',
            $now

        ]);

        return response()->json('Successfully Inserted');

    }


    public function get_condiment_section(Request $request) {


       $condiment_section_id = $request->get('condiment_section_id');

       $get_condiment_section_table = DB::select('SELECT condiments_section_id,condiment_section_name,condiment_section_desc FROM menu_section_condiments WHERE condiments_section_id = ? ',[$condiment_section_id]);

       return response()->json($get_condiment_section_table);
    }

    public function update_condiment_section(Request $request) {

        $hidden_condiment_sec_id = $request->get('hidden_condiment_sec_id');
        $edit_codiment_section_name = $request->get('edit_codiment_section_name');
        $edit_condiment_section_desc = $request->get('edit_condiment_section_desc');
        $now = new DateTime();

        DB::update('UPDATE menu_section_condiments SET condiment_section_name = ?, condiment_section_desc =?, condiment_section_updated =? WHERE condiments_section_id =? ',[

            $edit_codiment_section_name,
            $edit_condiment_section_desc,
            $now,
            $hidden_condiment_sec_id

        ]);


        return response()->json('Successfully Update');

    }

    public function delete_condiment_section(Request $request){

        $delete_condiment_sec_id = $request->get('delete_condiment_sec_id');

        DB::delete('DELETE FROM menu_section_condiments WHERE condiments_section_id =? ',[

            $delete_condiment_sec_id

        ]);

        return response()->json('Successfully Delete');
    }


    public function get_each_id_section_condiments(Request $request){

        $find_each_id_condiments = $request->get('find_each_id_condiments');

        $condiments_table = DB::select('SELECT msc.condiments_section_id,cat_condi_id,condiment_section_name,cat_condi_name,cat_condi_price,cat_condi_image,cat_condi_screen_name FROM menu_cat_condiments LEFT JOIN (SELECT condiments_section_id,condiment_section_name FROM menu_section_condiments) msc ON menu_cat_condiments.condiments_section_id = msc.condiments_section_id WHERE cat_condi_status = ? AND msc.condiments_section_id =? ',[
            'Active',
            $find_each_id_condiments
        ]);



        return response()->json(array(['condiments_table'=>$condiments_table]));

    }



    public function get_noun_group_combination(Request $request) {

        $chain_id = $request->get('chain_id');
        
        $noun_chaining = DB::select('SELECT mbd.condiments_section_id,Qty,Condiments,Price,allow_to_open_condiments FROM menu_category as mc LEFT JOIN (SELECT condiments_section_id,menu_builder_properties_id,Qty,Condiments,Price,allow_to_open_condiments FROM menu_builder_details) mbd ON mc.chain_id = mbd.menu_builder_properties_id WHERE mc.chain_id = ? ',[

            $chain_id

        ]);

        return response()->json(array(['noun_chaining' => $noun_chaining]));
    }


}
