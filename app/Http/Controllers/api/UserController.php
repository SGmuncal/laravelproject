<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use DateTime;
use App\Mail\SendMail;
use App\Mail\SendMailApplication;

class UserController extends Controller
{
    //
    public function index() {
    	
    	$non_active_table_slider = DB::select('SELECT content_id,link,file,slider_sorting,content_pages FROM content_structure as cs LEFT JOIN (SELECT cid,file FROM content_upload_assets) cua ON cs.content_id = cua.cid WHERE content_pages = ? AND cs.status = ? AND slider_sorting = ? ORDER BY content_id DESC ',[

            'Slider',
            'Active',
            '0'

        ]);

        $table_home_mission = DB::select('SELECT content_title,content FROM content_structure WHERE content_pages = ? AND status = ? AND content_section = ? ORDER BY content_id  DESC LIMIT 1
            ',[

            'Home',
            'Active',
            'Mission'

        ]);

        $table_home_vision = DB::select('SELECT content_title,content FROM content_structure WHERE content_pages = ? AND status = ? AND content_section = ? ORDER BY content_id  DESC LIMIT 1
            ',[

            'Home',
            'Active',
            'Vision'

        ]);


         $table_home_store = DB::select('SELECT content_id,link,file,content_title,content,content_pages,content_section FROM content_structure as cs LEFT JOIN (SELECT cid,file FROM content_upload_assets) cua ON cs.content_id = cua.cid WHERE content_pages = ? AND cs.status = ? AND content_section = ? ORDER BY content_id DESC LIMIT 1',[

            'Home',
            'Active',
            'Store'

        ]);


        $table_home_career = DB::select('SELECT content_id,link,file,content_title,content,content_pages,content_section FROM content_structure as cs LEFT JOIN (SELECT cid,file FROM content_upload_assets) cua ON cs.content_id = cua.cid WHERE content_pages = ? AND cs.status = ? AND content_section = ? ORDER BY content_id DESC LIMIT 1',[

            'Home',
            'Active',
            'Career'

        ]);

        $table_slider_active = DB::select('SELECT content_id,link,file,slider_sorting,content_pages FROM content_structure as cs LEFT JOIN (SELECT cid,file FROM content_upload_assets) cua ON cs.content_id = cua.cid WHERE content_pages = ? AND cs.status = ? AND slider_sorting = ? ORDER BY content_id DESC LIMIT 1 ',[

            'Slider',
            'Active',
            '1'

        ]);


    	return response()->json(array([

    		'non_active_table_slider' => $non_active_table_slider, 
    		'table_home_mission' => $table_home_mission,
    		'table_home_vision' => $table_home_vision,
    		'table_home_store' => $table_home_store,
    		'table_home_career' => $table_home_career,
    		'table_slider_active' => $table_slider_active



    	]));
    }

    public function story() {

		$historytable = DB::select('SELECT content_section,content_title,content FROM content_structure WHERE content_pages = ? AND status = ? ',['History','Active']);
       	return response()->json(array(['historytable' => $historytable]));
    }

    public function community() 
    {
        $content_sec1 = DB::select('SELECT content_title,content,link FROM content_structure WHERE content_pages = ? AND content_section = ? AND status = ? ORDER BY content_id DESC LIMIT 1',[

            'Community',
            'Section 1',
            'Active'

        ]);

        $content_sec2 = DB::select('SELECT content_title,file,link,content,status,created_at FROM `content_structure` as cs 
        LEFT JOIN (SELECT cid,file,file_type FROM content_upload_assets) cua ON cs.content_id = cua.cid
        WHERE content_pages = ? AND content_section = ? AND cs.status = ?
        ORDER BY content_id DESC LIMIT 1',[

            'Community',
            'Section 2',
            'Active'


        ]);


        $content_sec3 = DB::select('SELECT file,link,status FROM `content_structure` as cs 
        LEFT JOIN (SELECT cid,file,file_type FROM content_upload_assets) cua ON cs.content_id = cua.cid
        WHERE content_pages = ? AND content_section = ? AND cs.status = ?
        ORDER BY content_id',[

            'Community',
            'Section 3 Upload Video (IMAGE)',
            'Active'


        ]);


        $content_sec4 = DB::select('SELECT content_title,content,link FROM content_structure WHERE content_pages = ? AND content_section = ? AND content_structure.status = ? ORDER BY content_id DESC LIMIT 1',[

            'Community',
            'Section Mission',
            'Active'

        ]);


        $content_sec5 = DB::select('SELECT content_title,file,link,status FROM `content_structure` as cs 
        LEFT JOIN (SELECT cid,file,file_type FROM content_upload_assets) cua ON cs.content_id = cua.cid
        WHERE content_pages = ? AND content_section = ? AND cs.status = ?
        ORDER BY content_id',[

            'Community',
            'Section Partnership',
            'Active'


        ]);


        return response()->json(array([

        	'content_sec1'=>$content_sec1, 
        	'content_sec2'=>$content_sec2,
        	'content_sec3'=>$content_sec3,
        	'content_sec4'=>$content_sec4,
        	'content_sec5'=>$content_sec5,

        ]));

    }


    public function peoplegallery()
    {
        $gallery_table = DB::select('SELECT content_id,id,file,content,content_title,event_place,DATE_FORMAT(event_date, "%M %d, %Y") as event_dated,status FROM content_structure as cs LEFT JOIN (SELECT id,cid,file FROM content_upload_assets) cua ON cs.content_id = cua.cid WHERE content_pages = ? AND cs.status = ? ORDER BY content_id DESC',[

            'Gallery',
            'Active'   
        ]);
       
       return response()->json(array(['gallery_table'=>$gallery_table]));
    }


    public function peoplegallery_album($id, Request $request)
    {
     
        $get_title = DB::select('SELECT content_title,event_place,DATE_FORMAT(event_date, "%M %d, %Y") as event_dated FROM content_structure WHERE content_id = ? AND status = ? ',[$id,'Active']);

        $get_image = DB::select('SELECT cid,image,created_at FROM album_category WHERE cid = ?',[$id]);



        return response()->json(array(['logic_title' => $get_title,'get_image' =>$get_image]));
    }


    public function news_event()
    {
        $news = DB::table('content_structure')
        ->where('content_pages','News')
        ->where('status','Active')
        ->orderBy('content_id','DESC')
        ->paginate('4');
        
        return response()->json(array(['news'=>$news]));
    }

    public function news_event_content($id)
    {

        $news = DB::select('SELECT content_id,content_section,content_title,content,created_at,file_type,link,file,status FROM content_structure as cs 
            LEFT JOIN (SELECT cid,file,file_type FROM content_upload_assets) cua ON cs.content_id = cua.cid
            WHERE content_pages = ? AND cs.status = ? AND content_id = ? ORDER BY content_id DESC ',[


                'News',
                'Active',
                $id


            ]);
        
        return response()->json(array(['news' =>$news]));

    }

    public function directory()
    {
        $directories = DB::table('store_locator')
        ->where('store_status','Active')
        ->where('City','=','Winnipeg')
        ->orderBy('branch_name','ASC')
        ->get();

        $locations = DB::table('store_locator')
         ->where('city','=','Winnipeg')
         ->where('store_status','=','Active')
         ->get();
         
         return response()->json(array(['directories' => $directories, 'locations' => $locations]));

    }

    public function careers()
    {   
        $positiontable = DB::table('job_position')
        ->where('status','Active')->get();
        $get_position = DB::select('SELECT position_name FROM job_position WHERE status="Active" GROUP BY position_name ');

        return response()->json(array(['positiontable' => $positiontable, 'get_position' => $get_position]));

    }

    public function getjobdescription($id)
    {   
        $position_id = $id;

        $get_data_job = DB::select('SELECT id,position_name,location,position_desc,position_requirements FROM job_position WHERE id = ? AND status = ?',[$position_id,'Active']);

        return response()->json(array('get_data_job' => $get_data_job));

    }

    public function search_job($id)
    {

        $position_name = $id;

        if($position_name == '')
        {
            return redirect()->back();
        }

        if($position_name == 'alljob')
        {
            $jobtable = DB::select('SELECT id,position_name,position_desc,position_requirements,created_at,location FROM job_position WHERE status = ? ',[

                'Active'

            ]); 

            $get_position = DB::select('SELECT position_name FROM job_position WHERE status= ? GROUP BY position_name',['Active']);
        }
        else
        {
            $jobtable = DB::select('SELECT id,position_name,position_desc,position_requirements,created_at,location FROM job_position WHERE position_name LIKE  AND status = ? ',[

                $position_name,
                'Active'

            ]); 

            $get_position = DB::select('SELECT position_name FROM job_position WHERE status= ? GROUP BY position_name',['Active']);
        }
        


        return response()->json(array('position_search' => $jobtable, 'position_name' => $get_position));


    }

    public function insert_contact(Request $request) {

      $subject  = $request->get('contact_subject_option');
      $fname = $request->get('contact_first_name');
      $lname = $request->get('contact_lname');
      $contact = $request->get('contact_contact_number');
      $email = $request->get('contact_email_address');
      $message = $request->get('contact_content_article');
      $storenum = $request->get('contact_store_number');
      $transactionnumber = $request->get('contact_transaction_number');
      $datetransaction = $request->get('contact_transaction_date');


     
      $now = new DateTime();

      DB::insert('INSERT INTO mail (firstname,lastname,email,contact,message,store_number,subject,transaction_date,transaction_number,status,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?) ',[

            $fname,
            $lname,
            $email,
            $contact,
            $message,
            $storenum,
            $subject,
            $datetransaction,
            $transactionnumber,
            'Unread',
            $now

      ]);


         
         $data = array(
            'contents' => $message,
            'firstname' => $fname,
            'lastname' => $lname,
            'email' => $email,
            'transactionnumber' => $transactionnumber,
            'storenumber' => $storenum,
            'contactnumber' => $contact,
            'subject' => $subject,
        );
    

        \Mail::send('mailtext', $data,function($message){
            // $message->to('shiela.abundo@hiflyer.ca','Hiflyer');
            $message->to('george.muncal@hiflyer.ca','Hiflyer');
            $message->from('noreplyhfiofi@gmail.com','Hiflyer');
            $message->subject('New Notification');
        });


       return response()->json('Successfully Submitted');


    }


    public function insertuserapplication(Request $request) {

        $position_type = $request->get('online_app_position_type');
        $fname =  $request->get('online_app_firstname');
        $lname = $request->get('online_app_lname');
        $mname = $request->get('online_app_mname');
        $email = $request->get('online_app_email');
        $homenumber = $request->get('online_app_home_number');
        $cnumber = $request->get('online_app_contact_number'); 
        $employmentstatus = $request->get('status_checkbox_string');
        $relocate = $request->get('relocate_checkbox_string');
        $startdate = $request->get('online_app_start_date');
        $file_upload_name = $request->get('file');
        $file_upload = $request->file('file');

        $now = new DateTime();

       

        if($request->hasFile('file')) {

             $filename =  $request->file->hashName();
             $request->file->storeAs('public',$filename);
             
            DB::insert('INSERT INTO onlineapplication (position_name,firstname,middlename,lastname,email,homenumber,phonenumber,employmentstatus,relocate,starting_date,file_img_name,created_at) 
           VALUES (?,?,?,?,?,?,?,?,?,?,?,?)',


                [


                    $position_type,
                    $fname,
                    $mname,
                    $lname,
                    $email,
                    $homenumber,
                    $cnumber,
                    $employmentstatus,
                    $relocate,
                    $startdate,
                    $filename,
                    $now

                ]);


                // \Mail::send(new SendMailApplication());


                return response()->json('Successfully Submitted');

        }
        else
        {
            return response()->json('Failed to Submit');
        }

       
    
    }

}
