<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/','HomeController@index')->name('index');
Route::get('/index','HomeController@index')->name('index');
Route::get('/story','HomeController@story')->name('story');
Route::get('/community','HomeController@community')->name('community');
Route::get('/peoplegallery','HomeController@peoplegallery')->name('peoplegallery');
Route::get('/peoplegallery_album/{id}','HomeController@peoplegallery_album')->name('peoplegallery_album');
Route::get('/news_event','HomeController@news_event')->name('news_event');
Route::get('/news_event_content/{id}','HomeController@news_event_content')->name('news_event_content');
Route::get('/directory','HomeController@directory')->name('directory');
Route::get('/search_directory','HomeController@search_directory')->name('search_directory');
Route::get('/careers','HomeController@careers')->name('careers');
Route::get('/search_job','HomeController@search_job')->name('search_job');
Route::get('/getjobdescription/{id}','HomeController@getjobdescription')->name('getjobdescription');
Route::get('/onlineapplication/{id}','HomeController@onlineapplication')->name('onlineapplication');
Route::post('/insertuserapplication','HomeController@insertuserapplication')->name('insertuserapplication');
Route::get('/contact','HomeController@contact')->name('contact');
Route::post('/insertmail','HomeController@insertmail')->name('insertmail');


///// ADMIN SIDE UPDATE MANAGER //////////


Route::get('/hiflyerdashboard','AdminController@hiflyerdashboard')->name('hiflyerdashboard');

Route::get('/mails','AdminController@mails')->name('mails');
Route::get('/mailfrom/{id}','AdminController@mailfrom')->name('mailfrom');

Route::post('/markread/{id}','AdminController@markread')->name('markread');

Route::get('/viewapplicants','AdminController@viewapplicants')->name('viewapplicants');
Route::get('/viewapplication/{id}','AdminController@viewapplication')->name('viewapplication');
Route::post('/updateapplication','AdminController@updateapplication')->name('updateapplication');



//for home
Route::get('/home_update_manager','AdminController@home_update_manager')->name('home_update_manager');
Route::get('/get_update_home/{id}','AdminController@get_update_home')->name('get_update_home');
Route::get('/delete_home/{id}','AdminController@delete_home')->name('delete_home');
Route::get('/inactive_home/{id}','AdminController@inactive_home')->name('inactive_home');
Route::post('/insert_update_home','AdminController@insert_update_home')->name('insert_update_home');


//for company
Route::get('/company_update_manager','AdminController@company_update_manager')->name('company_update_manager');
Route::get('/delete_company/{id}','AdminController@delete_company')->name('delete_company');
Route::get('/inactive_company/{id}','AdminController@inactive_company')->name('inactive_company');
Route::get('get_update_company/{id}','AdminController@get_update_company')->name('get_update_company');
Route::post('insert_update_company','AdminController@insert_update_company')->name('insert_update_company');



//for news
Route::get('/news_update_manager','AdminController@news_update_manager')->name('news_update_manager');
Route::get('/delete_news/{id}','AdminController@delete_news')->name('delete_news');
Route::get('/inactive_news/{id}','AdminController@inactive_news')->name('inactive_news');
Route::get('get_update_news/{id}','AdminController@get_update_news')->name('get_update_news');
Route::post('insert_update_news','AdminController@insert_update_news')->name('insert_update_news');
Route::get('news_update_image_manager/{id}','AdminController@news_update_image_manager')->name('news_update_image_manager');

Route::get('get_news_image/{id}','AdminController@get_news_image')->name('get_news_image');

Route::post('insert_news_image','AdminController@insert_news_image')->name('insert_news_image');



//for gallery
Route::get('gallery_update_manager','AdminController@gallery_update_manager')->name('gallery_update_manager');
Route::get('/delete_gallery/{id}','AdminController@delete_gallery')->name('delete_gallery');
Route::get('/inactive_gallery/{id}','AdminController@inactive_gallery')->name('inactive_gallery');
Route::get('get_update_gallery/{id}','AdminController@get_update_gallery')->name('get_update_gallery');
Route::post('insert_update_gallery','AdminController@insert_update_gallery')->name('insert_update_gallery');
Route::get('gallery_update_image_manager/{id}','AdminController@gallery_update_image_manager')->name('gallery_update_image_manager');
Route::get('get_gallery_image/{id}','AdminController@get_gallery_image')->name('get_gallery_image');
Route::get('delete_gallery_image/{id}','AdminController@delete_gallery_image')->name('delete_gallery_image');
Route::post('insert_gallery_image','AdminController@insert_gallery_image')->name('insert_gallery_image');




//for directory
Route::get('directory_update_manager','AdminController@directory_update_manager')->name('directory_update_manager');
Route::get('/delete_store/{id}','AdminController@delete_store')->name('delete_store');
Route::get('/inactive_store/{id}','AdminController@inactive_store')->name('inactive_store');
Route::get('/get_update_store/{id}','AdminController@get_update_store')->name('get_update_store');
Route::post('/insert_update_store','AdminController@insert_update_store')->name('insert_update_store');


//for community
Route::get('community_update_manager','AdminController@community_update_manager')->name('community_update_manager');
Route::get('/delete_community/{id}','AdminController@delete_community')->name('delete_community');
Route::get('/inactive_community/{id}','AdminController@inactive_community')->name('inactive_community');
Route::get('/get_update_community/{id}','AdminController@get_update_community')->name('get_update_community');
Route::post('/insert_update_community','AdminController@insert_update_community')->name('insert_update_community');


//for job
Route::get('job_update_manager','AdminController@job_update_manager')->name('job_update_manager');
Route::get('/delete_job/{id}','AdminController@delete_job')->name('delete_job');
Route::get('/inactive_job/{id}','AdminController@inactive_job')->name('inactive_job');
Route::get('/get_update_job/{id}','AdminController@get_update_job')->name('get_update_job');
Route::post('/insert_update_job','AdminController@insert_update_job')->name('insert_update_job');


//for slider
Route::get('slider_update_manager','AdminController@slider_update_manager')->name('slider_update_manager');
Route::get('/delete_slider/{id}','AdminController@delete_slider')->name('delete_slider');
Route::get('/inactive_slider/{id}','AdminController@inactive_slider')->name('inactive_slider');
Route::get('/get_update_slider/{id}','AdminController@get_update_slider')->name('get_update_slider');
Route::post('/insert_update_slider','AdminController@insert_update_slider')->name('insert_update_slider');




//for user_management
Route::get('/user_management','AdminController@user_management')->name('user_management');
Route::get('/get_update_user/{id}','AdminController@get_update_user')->name('get_update_user');
Route::get('/delete_user/{id}','AdminController@delete_user')->name('delete_user');
Route::get('/inactive_user/{id}','AdminController@inactive_user')->name('inactive_user');
Route::post('/insert_update_user','AdminController@insert_update_user')->name('insert_update_user');
Route::post('/user_registered','AdminController@user_registered')->name('user_registered');




///// ADMIN SIDE INSERT MANAGER //////////
Route::get('/home_insert_manager','AdminController@home_insert_manager')->name('home_insert_manager');
Route::post('/content_inserting_home','AdminController@content_inserting_home')->name('content_inserting_home');
Route::get('/company_insert_manager','AdminController@company_insert_manager')->name('company_insert_manager');
Route::post('/content_inserting_history','AdminController@content_inserting_history')->name('content_inserting_history');
Route::get('/news_insert_manager','AdminController@news_insert_manager')->name('news_insert_manager');
Route::post('/content_inserting_news','AdminController@content_inserting_news')->name('content_inserting_news');
Route::get('/gallery_insert_manager','AdminController@gallery_insert_manager')->name('gallery_insert_manager');
Route::post('/content_inserting_gallery','AdminController@content_inserting_gallery')->name('content_inserting_gallery');
Route::get('/gallery_album_insert_manager','AdminController@gallery_album_insert_manager')->name('gallery_album_insert_manager');
Route::post('/gallery_album_insert','AdminController@gallery_album_insert')->name('gallery_album_insert');
Route::get('/directory_insert_manager','AdminController@directory_insert_manager')->name('directory_insert_manager');
Route::post('/content_inserting_directory','AdminController@content_inserting_directory')->name('content_inserting_directory');

Route::get('/community_insert_manager','AdminController@community_insert_manager')->name('community_insert_manager');
Route::post('/content_inserting_community','AdminController@content_inserting_community')->name('content_inserting_community');


Route::get('/job_insert_manager','AdminController@job_insert_manager')->name('job_insert_manager');
Route::post('/content_inserting_job','AdminController@content_inserting_job')->name('content_inserting_job');


Route::get('/slider_insert_manager','AdminController@slider_insert_manager')->name('slider_insert_manager');
Route::post('/content_inserting_slider','AdminController@content_inserting_slider')->name('content_inserting_slider');


Route::get('/mailtext','HomeController@mailtext')->name('mailtext');

Route::get('/online_delivery','HomeController@onlinedelivery')->name('online_delivery');


Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/cms_template_home', function () {
    return view('/cms_template/cms_template_home');
});
Route::get('/cms_template_company_story', function () {
    return view('/cms_template/cms_template_company_story');
});
Route::get('/cms_template_news', function () {
    return view('/cms_template/cms_template_news');
});
Route::get('/cms_template_people_gallery', function () {
    return view('/cms_template/cms_template_people_gallery');
});
Route::get('/cms_template_directory', function () {
    return view('/cms_template/cms_template_directory');
});
Route::get('/cms_template_community', function () {
    return view('/cms_template/cms_template_community');
});
Route::get('/cms_template_job', function () {
    return view('/cms_template/cms_template_job');
});

Route::get('/cms_template_slider', function () {
    return view('/cms_template/cms_template_slider');
});
Route::get('/cms_template_menu', function () {
    return view('/cms_template/cms_template_menu');
});
Route::get('/cms_template_menus_choices', function () {
	return view('/cms_template/cms_template_menus_choices');
});


Route::get('/search_city_delivery','HomeController@search_city_delivery')->name('search_city_delivery');
Route::get('/store_address/{id}','HomeController@store_address')->name('store_address');


//delivery

Route::get('/menu_section','AdminController@menu_section')->name('menu_section');
Route::post('/insert_menu_section','AdminController@insert_menu_section')->name('insert_menu_section');



Route::get('/menu_insert_manager','AdminController@menu_insert_manager')->name('menu_insert_manager');
Route::post('/menu_inserting','AdminController@menu_inserting')->name('menu_inserting');



Route::get('/menu_category_insert_manager','AdminController@menu_category_insert_manager')->name('menu_category_insert_manager');
Route::post('/menu_category_inserting','AdminController@menu_category_inserting')->name('menu_category_inserting');



Route::get('/customer_data','AdminController@customer_data')->name('customer_data');
Route::post('/insert_customer_details','AdminController@insert_customer_details')->name('insert_customer_details');



Route::get('/customize_customer_order/','AdminController@customize_customer_order')->name('customize_customer_order');
Route::get('/customer_data_append/','AdminController@customer_data_append')->name('customer_data_append');


Route::post('/insert_wish_list_menu_order','AdminController@insert_wish_list_menu_order')->name('insert_customer_order_properties');

Route::post('/insert_wish_list_menu_belong_condiments','AdminController@insert_wish_list_menu_belong_condiments')->name('insert_wish_list_menu_belong_condiments');

Route::post('/insert_customer_payment_details','AdminController@insert_customer_payment_details')->name('insert_customer_payment_details');


Route::get('/customers_details','AdminController@customers_details')->name('customers_details');
Route::get('/customer_profile/{id}','AdminController@customer_profile')->name('customer_profile');


Route::get('/delivery_status','AdminController@delivery_status')->name('delivery_status');

Route::get('/delivery_confirmation_status/{customer_id}/{order_id}','AdminController@delivery_confirmation_status')->name('delivery_confirmation_status');
Route::get('/order_detail/{customer_id}/{order_id}','AdminController@order_detail')->name('order_detail');

Route::post('/customer_all_orders/{id}','AdminController@customer_all_orders')->name('customer_all_orders');
Route::get('/customer_all_orders/{id}','AdminController@customer_all_orders')->name('customer_all_orders');


Route::post('/order_status_update','AdminController@order_status_update')->name('order_status_update');

Route::get('/delivery_driver','AdminController@delivery_driver')->name('delivery_driver');







//store management
Route::get('/store_account_list','AdminController@store_account_list')->name('store_account_list');
Route::post('/store_registered','AdminController@store_registered')->name('store_registered');
Route::post('/driver_registered','AdminController@driver_registered')->name('driver_registered');
Route::post('/update_driver_status_available','AdminController@update_driver_status_available')->name('update_driver_status_available');
Route::post('/update_driver_status_offline','AdminController@update_driver_status_offline')->name('update_driver_status_offline');

// Route::get('/search_driver','AdminController@search_driver')->name('search_driver');

Route::get('/customer_detail_ordering_logic','AdminController@customer_detail_ordering_logic')->name('customer_detail_ordering_logic');
Route::get('/fetch_detail_order_monitor','AdminController@fetch_detail_order_monitor')->name('fetch_detail_order_monitor');

Route::get('/get_assign_customer_to_driver','AdminController@get_assign_customer_to_driver')->name('get_assign_customer_to_driver');

Route::post('/update_customer_driver','AdminController@update_customer_driver')->name('update_customer_driver');


Route::post('/update_customer_status','AdminController@update_customer_status')->name('update_customer_status');

Route::get('/logic_get_customer_data','AdminController@logic_get_customer_data')->name('logic_get_customer_data');

Route::get('/get_imaginary_customer_details','AdminController@get_imaginary_customer_details')->name('get_imaginary_customer_details');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::get('/layout_menu_group','AdminController@layout_menu_group')->name('layout_menu_group');
Route::get('/edit_layout_menu_group','AdminController@edit_layout_menu_group')->name('edit_layout_menu_group');
Route::post('/update_layout_menu_group','AdminController@update_layout_menu_group')->name('update_layout_menu_group');
Route::post('/delete_layout_menu_group','AdminController@delete_layout_menu_group')->name('delete_layout_menu_group');



Route::get('/layout_sub_menu_group','AdminController@layout_sub_menu_group')->name('layout_sub_menu_group');
Route::get('/edit_layout_sub_menu_group','AdminController@edit_layout_sub_menu_group')->name('edit_layout_sub_menu_group');
Route::post('/update_layout_sub_menu_group','AdminController@update_layout_sub_menu_group')->name('update_layout_sub_menu_group');
Route::post('/delete_layout_sub_menu_group','AdminController@delete_layout_sub_menu_group')->name('delete_layout_sub_menu_group');



Route::get('/layout_condiments_section','AdminController@layout_condiments_section')->name('layout_condiments_section');
Route::post('/insert_condiment_section','AdminController@insert_condiment_section')->name('insert_condiment_section');
Route::get('/get_condiment_section','AdminController@get_condiment_section')->name('get_condiment_section');
Route::post('/update_condiment_section','AdminController@update_condiment_section')->name('update_condiment_section');
Route::post('/delete_condiment_section','AdminController@delete_condiment_section')->name('delete_condiment_section');



Route::get('/layout_noun_group','AdminController@layout_noun_group')->name('layout_noun_group');
Route::get('/edit_layout_noun_group','AdminController@edit_layout_noun_group')->name('edit_layout_noun_group');
Route::post('/update_layout_noun_group','AdminController@update_layout_noun_group')->name('update_layout_noun_group');
Route::post('/delete_layout_noun_group','AdminController@delete_layout_noun_group')->name('delete_layout_noun_group');



Route::get('/layout_condiments_group','AdminController@layout_condiments_group')->name('layout_condiments_group');
Route::post('/condiment_inserting','AdminController@condiment_inserting')->name('condiment_inserting');
Route::get('/edit_condiment_inserting','AdminController@edit_condiment_inserting')->name('edit_condiment_inserting');
Route::post('/update_condiment','AdminController@update_condiment')->name('update_condiment');
Route::post('/delete_condiment','AdminController@delete_condiment')->name('delete_condiment');


Route::get('/layout_chaining_group','AdminController@layout_chaining_group')->name('layout_chaining_group');
Route::post('/insert_menu_builder_properties','AdminController@insert_menu_builder_properties')->name('insert_menu_builder_properties');
Route::post('/insert_menu_builder_details','AdminController@insert_menu_builder_details')->name('insert_menu_builder_details');



Route::get('/get_chain_data','AdminController@get_chain_data')->name('get_chain_data');

Route::post('/logical_delete_id_builder','AdminController@logical_delete_id_builder')->name('logical_delete_id_builder');
Route::post('/insert_update_build_chain','AdminController@insert_update_build_chain')->name('insert_update_build_chain');
Route::post('/delete_layout_condiment','AdminController@delete_layout_condiment')->name('delete_layout_condiment');


Route::get('/get_each_id_section_condiments','AdminController@get_each_id_section_condiments')->name('get_each_id_section_condiments');


Route::get('/get_noun_group_combination','AdminController@get_noun_group_combination')->name('get_noun_group_combination');


Route::get('/customers_wish_list','AdminController@customers_wish_list')->name('customers_wish_list');