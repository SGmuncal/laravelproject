$(document).ready(function(){
	$.ajax({
		url:'/api/index',
		dataType: "json",
    	contentType: "application/json",
    	success:function(response) {
    		//console.log(response);

    		//call for content mission
    		var table_home_mission = jQuery.parseJSON(JSON.stringify(response[0].table_home_mission));
    		var mission_header = table_home_mission[0].content_title;
    		var mission_content = table_home_mission[0].content;

    		$('#mission_header').html(mission_header);
    		$('#mission_content').html(mission_content);


    		//call for content vision
    		var table_home_vision = jQuery.parseJSON(JSON.stringify(response[0].table_home_vision));
    		var vision_header = table_home_vision[0].content_title;
    		var vision_content = table_home_vision[0].content;

    		$('#vision_header').html(vision_header);
    		$('#vision_content').html(vision_content);


    		//call for content career
    		var table_home_career = jQuery.parseJSON(JSON.stringify(response[0].table_home_career));
    		var career_header = table_home_career[0].content_title;
    		var career_content = table_home_career[0].content;
    		var career_link = table_home_career[0].link;

    		$('#career_header').html(career_header);
    		$('#career_content').html(career_content);
    		$("#btn_position_here").attr("href", career_link); 



    		//call for content directory
    		var table_home_store = jQuery.parseJSON(JSON.stringify(response[0].table_home_store));
    		var store_header = table_home_store[0].content_title;
    		var store_content = table_home_store[0].content;
    		var store_link = table_home_store[0].link;
    		var store_file = table_home_store[0].file;
    		var directory_image = '<img src=/storage/' + store_file + ' class="d-block w-100">';

    		$('#store_header').html(store_header);
    		$('#store_content').html(store_content);
    		$("#btn_visit_us").attr("href", store_link); 
    		$('#store_directory_image').html(directory_image);


    		//call for active slider
    		var table_slider_active = response[0].table_slider_active;
    		$.each(table_slider_active, function (index, el) {

            var stringify_active_slider = jQuery.parseJSON(JSON.stringify(el));
            var slider_file_active = stringify_active_slider['file'];
            var slider_image_active = '<img src=/storage/' + slider_file_active + ' class="d-block w-100">';

            $('#active_slider').html(slider_image_active);

          });


    		//call for non active slider
    		var non_active_table_slider = response[0].non_active_table_slider;
    		$.each(non_active_table_slider, function (index, el) {

            var stringify_none_active_slider = jQuery.parseJSON(JSON.stringify(el));
            var slider_file_non_active = stringify_none_active_slider['file'];
            var slider_image_non_active = '<img src=/storage/' + slider_file_non_active + ' class="d-block w-100">';

            $('#non_active_slider').html(slider_image_non_active);

          })


    	},
    	error:function(response) {
    		console.log(response);
    	}
	});
});	

$(document).ready(function(){
	$.ajax({
		url:'/api/story',
		dataType: "json",
    	contentType: "application/json",
    	success:function(response) {
    		

    		var historytable = response[0].historytable;
    		$.each(historytable, function (index, el) {

            var stringify_historytable = jQuery.parseJSON(JSON.stringify(el));
          	var condition_direction = stringify_historytable['content_section'];
          	var condition_content_title = stringify_historytable['content_title'];
          	var condition_content_content = stringify_historytable['content'];

          	

          	var data;

          	data =  "<li>" + ((condition_direction == 'Right' ) ? '<div class="direction-r"><div class="flag-wrapper"><span class="hexa"></span><span class="time-wrapper"><span class="time">'+condition_content_title+'</span></span></div><div class="desc">'+condition_content_content+'</div></div>' 

          	 : '<div class="direction-l"><div class="flag-wrapper"><span class="hexa"></span><span class="time-wrapper"><span class="time">'+condition_content_title+'</span></span></div><div class="desc">'+condition_content_content+'</div></div>')+ "</li>";

          	$('#time_line_data').append(data);       

          });
    	},
    	error:function(response) {
    		console.log(response);
    	}
	});
});	

$(document).ready(function(){
	$.ajax({
		url:'/api/community',
		dataType: "json",
    	contentType: "application/json",
    	success:function(response) {
    		

    		//call for content community
    		var content_sec1 = jQuery.parseJSON(JSON.stringify(response[0].content_sec1));
    		var first_div_header = content_sec1[0].content_title;
    		var first_div_content = content_sec1[0].content;
    		var first_div_link = content_sec1[0].link;

    		$('#first_div_header').html(first_div_header);
    		$('#first_div_content').html(first_div_content);
    		$("#community_first_button").attr("href", first_div_link); 



    		var content_sec2 = jQuery.parseJSON(JSON.stringify(response[0].content_sec2));
    		var second_div_header = content_sec2[0].content_title;
    		var second_div_content = content_sec2[0].content;
    		var second_div_link = content_sec2[0].link;
    		var second_div_file = content_sec2[0].file;
    		var second_div_image = '<img src=/storage/' + second_div_file + ' class="d-block w-100">';

    		$('#second_div_header').html(second_div_header);
    		$('#second_div_content').html(second_div_content);
    		$("#community_second_button").attr("href", second_div_link);
    		$('#second_div_image').append(second_div_image);

            


    		
    		var community_videos = response[0].content_sec3;
    		$.each(community_videos, function (index, el) {

            var stringify_videos = jQuery.parseJSON(JSON.stringify(el));
            var video_file = stringify_videos['file'];
            var video_link = stringify_videos['link'];
            //var slider_image_active = '<img src=/storage/' + slider_file_active + ' class="d-block w-100">';
            var video_data;

            video_data = "<li><a href="+video_link+" id='target-link' target='someFrame'><img src=/storage/" + video_file + " width='90' height='65' style='cursor:pointer'></a><li>";

            $('#community_videos').append(video_data);

        	});


        	var content_sec4 = jQuery.parseJSON(JSON.stringify(response[0].content_sec4));
    		var fourth_div_header = content_sec4[0].content_title;
    		var fourth_div_content = content_sec4[0].content;
    		var fourth_div_link = content_sec4[0].link;

    		$('#fourth_div_header').html(fourth_div_header);
    		$('#fourth_div_content').html(fourth_div_content);
    		$("#community_fourth_button").attr("href", fourth_div_link); 




    		var community_list_foundation = response[0].content_sec5;
    		$.each(community_list_foundation, function (index, el) {

            var stringify_list_image_foundation = jQuery.parseJSON(JSON.stringify(el));
            var foundation_file = stringify_list_image_foundation['file'];
            var foundation_link = stringify_list_image_foundation['link'];
           
            var foundation_image_data;

            foundation_image_data = "<li><a href="+foundation_link+" id='target-link' target='someFrame'><img src=/storage/" + foundation_file + " width='120' height='100'  style='cursor:pointer'></a><li>";

            $('#foundation_image_list').append(foundation_image_data);

        	});


    	},
    	error:function(response) {
    		console.log(response);
    	}
	});
});	


$(document).ready(function(){
	$.ajax({
		url:'/api/peoplegallery',
		dataType: "json",
    	contentType: "application/json",
    	success:function(response) {
    		


    		var peoplegallery = response[0].gallery_table;
    		$.each(peoplegallery, function (index, el) {

	            var stringify_list_gallery = jQuery.parseJSON(JSON.stringify(el));
	            var gallery_file = stringify_list_gallery['file'];
	            var people_gallery_image = '<img src=/storage/' + gallery_file + ' class="d-block w-100">';
	            var gallery_id = stringify_list_gallery['content_id'];
	            var gallery_content_title = stringify_list_gallery['content_title'];
	            var gallery_event_dated = stringify_list_gallery['event_dated'];
	           
	            var peoplegallery_data;

	            peoplegallery_data = 
	            '<div class="col-md-4">\
		            <div class="card" style="margin-left:20px;">\
		            	<img class="card-img-top" src="/storage/'+gallery_file+'" alt="Card image cap" style="height:200px;">\
		            	<div class="card-body">\
		            		 <h5 class="card-tilte">\
		            		 	<a href="/peoplegallery_album/'+gallery_id+'" class="clicked_albums" data-id='+gallery_id+' style="color:black; font-weight: 500;">'+gallery_content_title+'</a>\
		            		 </h5>\
		            	</div>\
		            	<div class="card-footer">\
		            		<small class="text-muted"><i class="icon ion-md-calendar" style="font-size:15px; color:#800000;"></i><i class="far fa-calendar-check"></i> '+gallery_event_dated+'</small>\
		            	</div>\
		            </div>\
		            <br><br>\
	            </div>\
	            ';

	            $('#list_peoplegallery').append(peoplegallery_data);



        	});

        	

    	},
    	error:function(response) {
    		console.log(response);
    	}
	});
});	


$(document).ready(function(){   
	$(document).on('click','.clicked_albums',function(e) {
		var album_id= $(this).data('id'); 
		localStorage.setItem('_albumID',album_id);
    }); 
}); 


$(document).ready(function(){
	$.ajax({
		url:'/api/news_event',
		dataType: "json",
    	contentType: "application/json",
    	success:function(response) {
    		
    		

    		var news_event = response[0].news.data;
    		$.each(news_event, function (index, el) {

	            var stringify_list_news_event = jQuery.parseJSON(JSON.stringify(el));
	            var news_event_title = stringify_list_news_event['content_title'];
	            var news_event_content = stringify_list_news_event['content'];
	            var news_event_content_id = stringify_list_news_event['content_id'];
	           
	           
	            var news_event_data;

	            news_event_data = '<div class="line-content"><a href="/news_event_content/'+news_event_content_id+'" data-id='+news_event_content_id+' class="clicked_event" style="color:black; text-decoration: none;">\
		 			                  <h5 style=" font-size:20px;  font-weight: bold; ">'+news_event_title+'</h5>\
		 						   </a> <p>'+news_event_content+'</p></div><br>';
		 						   
		 						  
	           
	            $('.news_event_data').append(news_event_data);

	            

        	});

    		//Pagination
			pageSize = 3;
			incremSlide = 5;
			startPage = 0;
			numberPage = 0;

			var pageCount =  $(".line-content").length / pageSize;
			var totalSlidepPage = Math.floor(pageCount / incremSlide);
			    
			for(var i = 0 ; i<pageCount;i++){
			    $(".pagination").append('<li class="page-item"><a href="#" class="page-link">'+(i+1)+'</a></li> ');
			    if(i>pageSize){
			       $(".pagination li").eq(i).hide();
			    }
			}

			var prev = $("<li/>").addClass("prev").html("Prev").click(function(){
			   startPage-=5;
			   incremSlide-=5;
			   numberPage--;
			   slide();
			});

			prev.hide();

			var next = $("<li/>").addClass("next").click(function(){
			   startPage+=5;
			   incremSlide+=5;
			   numberPage++;
			   slide();
			});

			$(".pagination").prepend(prev).append(next);

			$(".pagination li").first().find("a").addClass("current");

			slide = function(sens){
			   $(".pagination  li").hide();
			   
			   for(t=startPage;t<incremSlide;t++){
			     $(".pagination  li").eq(t+1).show();
			   }
			   
			   
			    
			}

			showPage = function(page) {
				  $(".line-content").hide();
				  $(".line-content").each(function(n) {
				      if (n >= pageSize * (page - 1) && n < pageSize * page)
				          $(this).show();
				  });        
			}
			    
			showPage(1);
			$(".pagination  li a").eq(0).addClass("current");

			$(".pagination  li a").click(function() {
				 $(".pagination  li a").removeClass("current");
				 $(this).addClass("current");
				 showPage(parseInt($(this).text()));
			});
        

    	},
    	error:function(response) {
    		console.log(response);
    	}
	});
});	


$(document).ready(function(){   
	$(document).on('click','.clicked_event',function(e) {
		var event_id= $(this).data('id'); 
		localStorage.setItem('_eventID',event_id);
    }); 
}); 


$(document).ready(function(){
	$.ajax({
		url:'/api/careers',
		dataType: "json",
    	contentType: "application/json",
    	success:function(response) {
    		
    		var position_list = response[0].get_position;
    		$.each(position_list, function (index, el) {

	            var stringify_list_position = jQuery.parseJSON(JSON.stringify(el));
	            var position_name = stringify_list_position['position_name'];
	           
	           
	            var position_list_data;

	            position_list_data = "<option value='"+position_name+"'>"+position_name+"</option>";
	            

	            $('#append_option_list_position').append(position_list_data);



        	});


        	var position_data = response[0].positiontable;
    		$.each(position_data, function (index, el) {

	            var stringify_list_position_table = jQuery.parseJSON(JSON.stringify(el));
	            var position_name_div = stringify_list_position_table['position_name'];
	            var position_desc_div = stringify_list_position_table['position_desc'];
	            var position_created_div = stringify_list_position_table['created_at'];
	            var position_location_div = stringify_list_position_table['location'];
	            var position_id_div = stringify_list_position_table['id'];
	           
	           
	            var position_list_data;

	            position_list_data = 
	            '<div class="col-md-4">\
					<div class="list-group">\
					  <a href="/getjobdescription/'+position_id_div+'" data-id='+position_id_div+' class="list-group-item list-group-item-action flex-column align-items-start clicked_position_apply">\
					    <div class="d-flex w-100 justify-content-between">\
					      <h5 class="mb-1"><span class="title" style="color:black;"><b>'+position_name_div+'</b></span></h5>\
					      <small>'+position_created_div+'</small>\
					    </div>\
					    <p class="mb-1">\
					    	\
				             <span class="title" style="color:black;">'+position_location_div+'</span>\
				            <p style="font-size:12px;">\
				             	'+position_desc_div+'\
				            </p>\
			            \
					    </small>\
					  </a>\
						\
					  <br>\
					</div>\
					<br><br>\
				</div>';

	            $('#position_list').append(position_list_data);



        	});

        	

    	},
    	error:function(response) {
    		console.log(response);
    	}
	});
});	


$(document).ready(function(){   
	$(document).on('click','.clicked_position_apply',function(e) {
		var position_id= $(this).data('id'); 
		localStorage.setItem('_positionID',position_id);
    }); 
});


$('button#serach_position_btn').click(function(e) {
	e.preventDefault();
   var selected_on_option_position =  $('#append_option_list_position').val();
   $.ajax({
      url: '/api/search_job/'+selected_on_option_position+'',
      type: 'post',
      cache: false,
      success: function(response) {

      		$('#position_list').hide();

      		$('#search_position_list').html('')

        	var search_position_data = response.position_search;
        	
    		$.each(search_position_data, function (index, el) {

	            var stringify_sesarch_list_position_table = jQuery.parseJSON(JSON.stringify(el));
	            var search_position_name_div = stringify_sesarch_list_position_table['position_name'];
	            var search_position_desc_div = stringify_sesarch_list_position_table['position_desc'];
	            var search_position_created_div = stringify_sesarch_list_position_table['created_at'];
	            var search_position_location_div = stringify_sesarch_list_position_table['location'];
	            var search_position_id_div = stringify_sesarch_list_position_table['id'];
	           
	           
	            var search_position_list_data;

	            search_position_list_data = 
	            '<div class="col-md-4">\
					<div class="list-group">\
					  <a href="/getjobdescription/'+search_position_id_div+'" data-id='+search_position_id_div+' class="list-group-item list-group-item-action flex-column align-items-start clicked_position_apply">\
					    <div class="d-flex w-100 justify-content-between">\
					      <h5 class="mb-1"><span class="title" style="color:black;"><b>'+search_position_name_div+'</b></span></h5>\
					      <small>'+search_position_created_div+'</small>\
					    </div>\
					    <p class="mb-1">\
					    	\
				             <span class="title" style="color:black;">'+search_position_location_div+'</span>\
				            <p style="font-size:12px;">\
				             	'+search_position_desc_div+'\
				            </p>\
			            \
					    </small>\
					  </a>\
						\
					  <br>\
					</div>\
					<br><br>\
				</div>';

	            $('#search_position_list').append(search_position_list_data);



        	});
      },
      error:function(response) {
      	console.log(response);
      }
   });
}); 


function recaptchaCallback() {
    $('button#submit_contact_form').removeAttr('disabled');
};


$('button#submit_contact_form').click(function(e) {



	var contact_subject_option = $('#contact_subject_option').val();
	var contact_transaction_date = $('#contact_transaction_date').val();
	var contact_first_name = $('#contact_first_name').val();
	var contact_lname = $('#contact_lname').val();
	var contact_contact_number = $('#contact_contact_number').val();
	var contact_email_address = $('#contact_email_address').val();
	var contact_store_number = $('#contact_store_number').val();
	var contact_transaction_number = $('#contact_transaction_number').val();
	var contact_content_article = $('#contact_content_article').val();


	if(contact_subject_option.length == 0 || 
		contact_transaction_date.length == 0 || 
		contact_first_name.length == 0 || 
		contact_lname.length == 0 || 
		contact_contact_number.length == 0 ||
		contact_email_address.length == 0 ||
		contact_store_number.length == 0 ||
		contact_transaction_number.length == 0 ||
		contact_content_article.length == 0)
	{
		 swal("Please fill up all fields..", {
            icon: "warning",
          });
	}
	else{


		$.ajax({ 
			url:'/api/insert_contact',
			type:'post',
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
			processData: true,
			data:
			{
				contact_subject_option: contact_subject_option,
				contact_transaction_date: contact_transaction_date,
				contact_first_name: contact_first_name,
				contact_lname: contact_lname,
				contact_contact_number: contact_contact_number,
				contact_email_address: contact_email_address,
				contact_store_number: contact_store_number,
				contact_transaction_number: contact_transaction_number,
				contact_content_article: contact_content_article

			},
			success:function(response) {
				if(response == 'Successfully Submitted')
				{
					 swal("Your message has been sent to the administrator.", {
			            icon: "success",
			          });
				}
			},
			error:function(response) {
				console.log(response);
			}
		})
	}



})


$('button#online_application_btn').click(function(){

	var online_app_firstname = $('#online_app_firstname').val();
	var online_app_lname = $('#online_app_lname').val();
	var online_app_mname = $('#online_app_mname').val();
	var online_app_email = $('#online_app_email').val();
	var online_app_home_number = $('#online_app_home_number').val();
	var online_app_contact_number = $('#online_app_contact_number').val();
	var online_app_position_type = $('#online_app_position_type').val();
	var online_app_start_date = $('#online_app_start_date').val();
	var file_data = $('#online_app_file').prop('files')[0];

	var status_checkbox_string = '';
	$('.status_ads_Checkbox:checked').each(function(){        
        var values_status = $(this).val();
        status_checkbox_string += values_status;
    });

    var relocate_checkbox_string = '';
	$('.relocate_ads_Checkbox:checked').each(function(){        
        var values_relocate = $(this).val();
        relocate_checkbox_string += values_relocate;
    });


	var formData = new FormData();

  	formData.append('online_app_firstname',online_app_firstname);
  	formData.append('online_app_lname',online_app_lname);
  	formData.append('online_app_mname',online_app_mname);
  	formData.append('online_app_email',online_app_email);
  	formData.append('online_app_home_number',online_app_home_number);
  	formData.append('online_app_contact_number',online_app_contact_number);
  	formData.append('online_app_position_type',online_app_position_type);
  	formData.append('online_app_start_date',online_app_start_date);
  	formData.append('file',file_data);
  	formData.append('status_checkbox_string',status_checkbox_string);
  	formData.append('relocate_checkbox_string',relocate_checkbox_string);

 //  	$.ajax({
	// 	url:'/api/insertuserapplication',
	// 	type:'post',
	// 	contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
	// 	processData: false,
	// 	contentType: false,
	// 	data:formData,
	// 	success:function(response) {
	// 		if(response == 'Successfully Submitted')
	// 		{
	// 			 swal("Your message has been sent to the administrator.", {
	// 	            icon: "success",
	// 	          });
	// 		}
	// 	},
	// 	error:function(response) {
	// 		console.log(response);
	// 	}
	// })


    if(online_app_firstname.length == 0 
    	|| online_app_lname.length == 0 || 
    	online_app_mname.length == 0 || 
    	online_app_email.length == 0 || 
    	online_app_home_number.length == 0 || 
    	online_app_contact_number.length == 0 || 
    	online_app_position_type.length == 0 || 
    	online_app_start_date.length == 0 || 
    	status_checkbox_string.length == 0 || 
    	relocate_checkbox_string.length == 0 ||
    	file_data.length == 0)
    {
    	 swal("Please fill up all fields..", {
            icon: "warning",
          });
    }
    else
    {
    	$.ajax({
    		url:'/api/insertuserapplication',
			type:'post',
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
			processData: false,
			contentType: false,
			data:formData,
			success:function(response) {
				if(response == 'Successfully Submitted')
				{
					 swal("Your message has been sent to the administrator.", {
			            icon: "success",
			          });
				}
			},
			error:function(response) {
				console.log(response);
			}
    	})
    }




}) 