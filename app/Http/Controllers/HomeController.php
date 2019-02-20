<?php

namespace App\Http\Controllers;
use DB;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
use App\Mail\SendMailApplication;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('index');   
       
    }

    public function story() 
    {


        return View('story');
       
    }

    public function community() 
    {
       

        return view('community');
    }

    public function peoplegallery()
    {
        
        return View('peoplegallery');
    }

    public function peoplegallery_album($id)
    {

        return View('/peoplegallery_album');

    }

    public function news_event()
    {
        
        return View('news_event');
    }

    public function news_event_content($id)
    {

        return View('news_event_content');

    }


    public function directory()
    {


        return View('directory');


    }

    public function search_directory(Request $request)
    {

        $inpaddress = $request->input('inpaddress');

        if($inpaddress == 'Winnipeg' || $inpaddress == 'Edmonton' || $inpaddress == 'Calgary')
        {
            // dd($request);
             $locations = DB::table('store_locator')
             ->where('city','=',$inpaddress)
             ->where('store_status','=','Active')
             ->get();

            $user_location = DB::select("SELECT * FROM store_locator WHERE store_status = ? 
            AND (store_address LIKE '%".$inpaddress."%' OR city LIKE '%".$inpaddress."%' OR branch_name LIKE '%".$inpaddress."%') ORDER BY branch_name ASC",['Active']);

         

             return View('directory',compact('locations'))->with('user_location',$user_location);
        }
        else
        {
            $locations = DB::table('store_locator')
             ->where('city','=',$inpaddress)
             ->get();

            $user_location = DB::select("SELECT * FROM store_locator WHERE store_status = ? 
            AND (store_address LIKE '%".$inpaddress."%' OR city LIKE '%".$inpaddress."%' OR branch_name LIKE '%".$inpaddress."%') ORDER BY branch_name ASC ",['Active']);

         

             return View('directory',compact('locations'))->with('user_location',$user_location);
        }
        

       
    }

    public function careers()
    {   
        
        return View('careers');

    }

    public function search_job(Request $request)
    {

        return View('careers');

    }

    public function getjobdescription(Request $request, $id)
    {   
        // $position_id = $id;

        // $get_data = DB::select('SELECT id,position_name,location,position_desc,position_requirements FROM job_position WHERE id = ? AND status = ?',[$position_id,'Active']);

    
        return View('getjobdescription');
            // ->with('getposition',$get_data);
    }

    public function onlineapplication(Request $request, $id)
    {   
        $id_application = $id;
        $positiontable = DB::select('SELECT id,position_name FROM job_position WHERE id = ? AND status = ?',[$id_application,'Active']);

        return View('onlineapplication')->with('getjob',$positiontable);

    }

    // public function insertuserapplication(Request $request)
    // {

    //     $position_type = $request->input('position_type');
    //     $fname =  $request->input('fname');
    //     $lname = $request->input('lname');
    //     $mname = $request->input('mname');
    //     $email = $request->input('email');
    //     $homenumber = $request->input('homenumber');
    //     $cnumber = $request->input('cnumber'); 
    //     $employmentstatus = $request->input('employmentstatus');
    //     $relocate = $request->input('relocate');
    //     $startdate = $request->input('startdate');
    //     $file_upload_name = $request->input('file');
    //     $file_upload = $request->file('file');

    //     $now = new DateTime();
    //     $localstorage = 'public';

    //     $true = $this->validate($request,[
    //         'file' => 'required|mimes:pdf,doc,docx|max:10000', 
    //     ]);

    //     if($true)
    //     {
    //             $filename =  $request->file->getClientOriginalName();
    //             $request->file->storeAs('public',$filename);

    //            DB::insert('INSERT INTO onlineapplication (position_name,firstname,middlename,lastname,email,homenumber,phonenumber,employmentstatus,relocate,starting_date,destination,file_img_name,created_at) 
    //            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)',


    //         [


    //             $position_type,
    //             $fname,
    //             $mname,
    //             $lname,
    //             $email,
    //             $homenumber,
    //             $cnumber,
    //             $employmentstatus,
    //             $relocate,
    //             $startdate,
    //             $localstorage,
    //             $filename,
    //             $now

    //         ]);


    //         \Mail::send(new SendMailApplication());

    //         \Session::flash('message', 'Successfully submited!');
    //         return redirect()->back();

            
    //     }
    
        
    // }


    public function contact()
    {
        return View('contact');
    }

    // public function insertmail(Request $request)
    // {

      
    // }

    public function mailtext()
    {
        
        return View('mailtext');
    }


    public function onlinedelivery() {
        return View('online_delivery');
    }

    public function search_city_delivery(Request $request) {

        $city = $request->input('city');

        $city_information =  DB::select('SELECT id,city,branch_name,store_address,store_contactnumber,store_businesshour,store_lat,store_long,store_type FROM store_locator WHERE city = ? and store_status = ? ORDER BY store_address DESC ',[

            $city,
            'Active'
        ]);

        return View('search_city_delivery')->with('city_info',$city_information);

    }

    public function store_address(Request $request, $id) {

       
        $store_id = $id;
       

        return View('store_address');
    }
}