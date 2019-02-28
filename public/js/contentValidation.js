
$(document).ready(function(){

	 $('#dropdown-home').attr('required', 'required');

  	$('#dropdown-home').change(function(){

        if($('#dropdown-home').val() == 'Mission')
        {
          
  	        $('#link-content').hide('slow');
  	        $('#type-content').hide('slow');
  	        $("#file-content").hide('slow');
  	        $('#title').attr('required', 'required');




        }
        if($('#dropdown-home').val() == 'Vision')
        {
          
  	        $('#link-content').hide('slow');
  	        $('#type-content').hide('slow');
  	        $("#file-content").hide('slow');
  	        $('#title').attr('required', 'required');
          
        }
        else if($('#dropdown-home').val() == 'Career')
        {
          $('#link-content').show('slow');
          $('#type-content').show('slow');
          $("#file-content").show('show');

        }
        else if($('#dropdown-home').val() == 'Store')
        {
          $('#link-content').show('slow');
          $('#type-content').show('slow');
          $("#file-content").show('show');

        }
        

    });

})


$(document).ready(function() {
    
     $('#dropdown-community').change(function(){

        if($('#dropdown-community').val() == 'Section 1')
        {
          $('#type-content').hide('slow');
          $('#link-content').show('slow');
          $("#file-content").hide();
        }
        else if($('#dropdown-community').val() == 'Section 2')
        {
          $('#type-content').show('slow');
          $('#content_title').show('slow');
          $("#file-content").show('slow');
        }
        else if($('#dropdown-community').val() == 'Section 3 Upload Video (IMAGE)')
        {
          $('#content_title').hide('slow');
          $('#ckedit_content').hide('slow');
          $("#file-content").show('slow');
        }
        else if($('#dropdown-community').val() == 'Section Mission')
        {
          $('#content_title').show('slow');
          $('#ckedit_content').show('slow');  
          $('#link-content').show('slow');
          $('#type-content').hide('slow');
          $("#file-content").hide();
        }
         else if($('#dropdown-community').val() == 'Section Partnership')
        {
          $('#content_title').hide('slow');
          $('#ckedit_content').hide('slow');
          $("#file-content").show('slow');
        }

    });



});


$(document).ready(function(){
  var append_address_to_textbox = $('#append_address_to_textbox').text();
  var txtDestination = $('#txtDestination').val(append_address_to_textbox)

  //this is for inserting section
  
  $('#save_menu_button').click(function(e){
     e.preventDefault();
     var menu_sec_desc = $('#menu_sec_desc').val();
     var textFieldVal = $("#menu_value").val();

     var formData = new FormData();
     formData.append('menu_sec_desc',menu_sec_desc);
     formData.append('menu_value',textFieldVal);

      swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willInsert) => {

      if (willInsert) {

        swal("Successfully Added New Menu Section", {
          icon: "success",
        });

      
         $.ajax({
          url:'/insert_menu_section',
          // data:{'field1':textFieldVal},
          data: formData,
          type:'POST',    
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function (response) {
              console.log(response);
              location.reload();
           },
           error: function (response) {
              console.log(response);
           }

       });

        
      } else {
        swal("Cancelled");
      }
    });

  });


  //this is for inserting menu

  $('#btn_menu_insert').click(function(e){
      e.preventDefault();

      var menu_section_choices = $('#menu_section_choices').val();
      var menu_name = $('#menu_name').val();
      var file_data = $('#menu_image_file').prop('files')[0];
      var menu_description = CKEDITOR.instances['menu_description'].getData();


      var formData = new FormData();
      formData.append('menu_section_choices',menu_section_choices);
      formData.append('menu_name',menu_name);
      formData.append('file',file_data);
      formData.append('menu_description',menu_description);

       swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willInsert) => {

      if (willInsert) {

        swal("Successfully Added New Menu", {
          icon: "success",
        });

       
      $.ajax({
          url:'/menu_inserting',
          data:formData,
          type:'POST',
          dataType:'JSON',
          processData: false,
          contentType: false,
          success: function(response) {
              console.log(response);
              location.reload();
          },
          error: function(response) {
              console.log(response);
          }
      });
        
      } else {
        swal("Cancelled");
      }
    });


  });



  $('#btn_menu_category_insert').click(function(e){

      e.preventDefault();

      var menu_category_choices = $('#menu_category_choices').val();
      var menu_category_name = $('#menu_category_name').val();
      var menu_category_file = $('#menu_category_file').prop('files')[0];
      var menu_category_description = CKEDITOR.instances['menu_category_description'].getData();
      var menu_category_price = $('#menu_category_price').val();
      var menu_noun_screen = $('#menu_noun_screen').val();


      var formData = new FormData();
      formData.append('menu_category_choices',menu_category_choices);
      formData.append('menu_category_name',menu_category_name);
      formData.append('file',menu_category_file);
      formData.append('menu_category_description',menu_category_description);
      formData.append('menu_category_price',menu_category_price);
      formData.append('menu_noun_screen',menu_noun_screen);


      swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willInsert) => {

      if (willInsert) {

        swal("Successfully Added New Menu Category", {
          icon: "success",
        });

         $.ajax({
          url:'/menu_category_inserting',
          data:formData,
          type:'POST',
          dataType:'JSON',
          processData: false,
          contentType: false,
          success: function(response) {
             console.log(response);
             location.reload();
          },
          error: function(response) {
              console.log(response);
          }

       

      });
        
      } else {
        swal("Cancelled");
      }
    });

     

  });

      $('#assign').hide();

    $('#role_choice').change(function(e) {

        $value = e.target.value;

        console.log($value);

        if($value == '3')
        {
            $('#assign').show(2000);
        }
        else
        {
             $('#assign').hide();
        }

    });


    (function($) {
      $.fn.currencyInput = function() {
        this.each(function() {
          var wrapper = $("<div class='currency-input' />");
          $(this).wrap(wrapper);
          $(this).before("<span class='currency-symbol'>$</span>");
          $(this).change(function() {
            var min = parseFloat($(this).attr("min"));
            var max = parseFloat($(this).attr("max"));
            var value = this.valueAsNumber;
            if(value < min)
              value = min;
            else if(value > max)
              value = max;
            $(this).val(value.toFixed(2)); 
          });
        });
      };
    })(jQuery);

    $(document).ready(function() {
      $('input.currency').currencyInput();
    });


    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });


    $('.custom-file-input').on('change', function() { 
       let fileName = $(this).val().split('\\').pop(); 
       $(this).next('.custom-file-label').addClass("selected").html(fileName); 
    });
    
    $(document).ready(function() {
      
       $('#tables').DataTable({
            "pageLength": 4

      });
      $('#tables_customer_details').DataTable({
            "pageLength": 4

      });
       
    });




    $(document).ready(function() {

        $('#tables_orders').DataTable( {
            "pageLength": 10,
        } );



    });


    $(document).ready(function() {

        $('#drivertable').DataTable( {
            "pageLength": 4,

        } );

    });

  
});


$(document).ready(function(){
    $('button#menu_group_editBtn').click(function(){

        var append_menu_id_edit = $(this).val();
        $('#editModalmenugroup').modal('show');

        $.ajax({
          url:'/edit_layout_menu_group',
          type:'get',
          data:{append_menu_id_edit:append_menu_id_edit},
          success:function(response) {
             var edited_menu_group_menu_sec_desc = response[0].menu_sec_desc;
             var edited_menu_group_menu_sec_id = response[0].menu_sec_id;
             var edited_menu_group_menu_sec_name = response[0].menu_sec_name;
              
             $('#edit_menu_value').val(edited_menu_group_menu_sec_name);
             $('#edit_menu_sec_desc').val(edited_menu_group_menu_sec_desc);
             $('#hidden_menu_sec_id').val(edited_menu_group_menu_sec_id);

          },
          error:function(response) {
            console.log(response);
          }
        })

    });
})


$(document).ready(function(){
    $('button#update_menu_group_button').click(function(){

        var edit_menu_value = $('#edit_menu_value').val();
        var edit_menu_sec_desc = $('#edit_menu_sec_desc').val();
        var hidden_menu_sec_id = $('#hidden_menu_sec_id').val();

          swal({
          title: "Are you sure to update this?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willInsert) => {
          if (willInsert) {
             $.ajax({
              url:'/update_layout_menu_group',
              type:'post',
              data:{edit_menu_value:edit_menu_value,edit_menu_sec_desc:edit_menu_sec_desc,hidden_menu_sec_id:hidden_menu_sec_id},
              success:function(response) {
                console.log(response);
              },
              error:function(response) {
                console.log(response);
              }
            })
            swal("Successfully Updated", {
              icon: "success",
            });
            location.reload();
          } else {
            swal("Cancelled");
          }
        });
        
       

    });





    $('button#menu_group_deleteBtn').click(function(){

        var deleted_menu_data = $(this).val();

          swal({
          title: "Are you sure to delete this?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willInsert) => {
          if (willInsert) {
             $.ajax({
              url:'/delete_layout_menu_group',
              type:'post',
              data:{deleted_menu_data:deleted_menu_data},
              success:function(response) {
                console.log(response);
                swal("Successfully Deleted", {
                  icon: "success",
                });
                location.reload();
              },
              error:function(response) {
                console.log(response);
              }
            })
            
          } else {
            swal("Cancelled");
          }
        });
        
       

    });
})


$(document).ready(function(){
    $('button#sub_menu_group_editBtn').click(function(){

        var append_sub_menu_id_edit = $(this).val();
       
        $('#editSubmenugroup').modal('show');

        $.ajax({
          url:'/edit_layout_sub_menu_group',
          type:'get',
          data:{append_sub_menu_id_edit:append_sub_menu_id_edit},
          success:function(response) {
              console.log(response);


             var edited_sub_menu_group_menu_sec_desc = response[0].menu_desc;
             var edited_sub_menu_group_menu_sec_id = response[0].menu_id;
             var edited_sub_menu_group_menu_sec_name = response[0].menu_name;
             var edit_sub_menu_group_image = response[0].menu_main_image;

             
              
             $('#sub_menu_name').val(edited_sub_menu_group_menu_sec_name);
             $('#sub_menu_description').val(edited_sub_menu_group_menu_sec_desc);
             $('#hidden_sub_menu_sec_id').val(edited_sub_menu_group_menu_sec_id);
            

          },
          error:function(response) {
            console.log(response);
          }
        })

    });
})


$(document).ready(function(){
    $('button#update_btn_sub_menu_insert').click(function(){

        var edit_sub_menu_value = $('#sub_menu_name').val();
        var edit_sub_menu_sec_desc = $('#sub_menu_description').val();
        var hidden_sub_menu_sec_id = $('#hidden_sub_menu_sec_id').val();
        var file_data = $('#sub_menu_image_file').prop('files')[0];

        var formData = new FormData();
        formData.append('edit_sub_menu_value',edit_sub_menu_value);
        formData.append('edit_sub_menu_sec_desc',edit_sub_menu_sec_desc);
        formData.append('file',file_data);
        formData.append('hidden_sub_menu_sec_id',hidden_sub_menu_sec_id);

          swal({
          title: "Are you sure to update this?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willInsert) => {
          if (willInsert) {
             $.ajax({
              url:'/update_layout_sub_menu_group',
              type:'post',
              data:formData,
              processData: false,
              contentType: false,
              success:function(response) {
                swal("Successfully Updated", {
                  icon: "success",
                });
                location.reload();
              },
              error:function(response) {
                console.log(response);
              }
            })
            
          } else {
            swal("Cancelled");
          }
        });
        
       

    });


    $('button#sub_menu_group_deleteBtn').click(function(){

        var deleted_sub_menu_data = $(this).val();

          swal({
          title: "Are you sure to delete this?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willInsert) => {
          if (willInsert) {
             $.ajax({
              url:'/delete_layout_sub_menu_group',
              type:'post',
              data:{deleted_sub_menu_data:deleted_sub_menu_data},
              success:function(response) {
                console.log(response);
                 swal("Successfully Deleted", {
                  icon: "success",
                });
                location.reload();
              },
              error:function(response) {
                console.log(response);
              }
            })
           
          } else {
            swal("Cancelled");
          }
        });
        
       

    });


})




$(document).ready(function(){
    $('button#noun_editBtn').click(function(){
        var noun_value_id = $(this).val();
        $('#editnounModal').modal('show');

        //
        $.ajax({
          url:'/edit_layout_noun_group',
          type:'get',
          data:{noun_value_id:noun_value_id},
          success:function(response){
          
            var append_menu_cat_desc = response[0].menu_cat_desc;
            var append_menu_cat_id = response[0].menu_cat_id;
            var append_menu_cat_name = response[0].menu_cat_name;
            var append_menu_cat_price = response[0].menu_cat_price;
            var append_menu_cat_screen_name = response[0].menu_cat_screen_name;
           


            $('#append_hidden_noun_name').val(append_menu_cat_id);
            $('#append_menu_category_name').val(append_menu_cat_name);
            $('#append_menu_category_price').val(append_menu_cat_price);
            $('#append_menu_category_description').val(append_menu_cat_desc);
            $('#append_menu_noun_screen').val(append_menu_cat_screen_name);
            


          },
          error:function(response){
            console.log(response);
          }
        })
    });


    $('button#btn_update_noun').click(function(){

        var append_hidden_noun_name = $('#append_hidden_noun_name').val();
        var append_menu_category_name = $('#append_menu_category_name').val();
        var append_menu_category_price = $('#append_menu_category_price').val();
        var append_menu_category_description = $('#append_menu_category_description').val();
        var append_menu_noun_screen = $('#append_menu_noun_screen').val();
        var file_data = $('#append_menu_category_file').prop('files')[0];


        var formData = new FormData();
        formData.append('append_hidden_noun_name',append_hidden_noun_name);
        formData.append('append_menu_category_name',append_menu_category_name);
        formData.append('append_menu_category_price',append_menu_category_price);
        formData.append('append_menu_category_description',append_menu_category_description);
        formData.append('append_menu_noun_screen',append_menu_noun_screen);
        formData.append('file',file_data);


        $.ajax({
            url:'/update_layout_noun_group',
            type:'post',
            data:formData,
            processData: false,
            contentType: false,
            success:function(response) {
              swal("Successfully Updated", {
                icon: "success",
              });
              location.reload();
            },
            error:function(response) {
              console.log(response);
            }

        })


    });


    $('button#noun_deleteBtn').click(function(){

        var deleted_noun_data = $(this).val();

          swal({
          title: "Are you sure to delete this?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willInsert) => {
          if (willInsert) {
             $.ajax({
              url:'/delete_layout_noun_group',
              type:'post',
              data:{deleted_noun_data:deleted_noun_data},
              success:function(response) {
                console.log(response);
                 swal("Successfully Deleted", {
                  icon: "success",
                });
                location.reload();
              },
              error:function(response) {
                console.log(response);
              }
            })
           
          } else {
            swal("Cancelled");
          }
        });
        
       

    });


});



$(document).ready(function(){
   

    $('button#btn_condiment_insert').click(function(){

        var condiment_name = $('#condiment_name').val();
        var condiment_screen = $('#condiment_screen').val();
        var condiment_price = $('#condiment_price').val();
        var file_data = $('#condiment_image').prop('files')[0];
        var select_condiments_value = $('#select_condiments_value').val();


        var formData = new FormData();
        formData.append('condiment_name',condiment_name);
        formData.append('condiment_screen',condiment_screen);
        formData.append('condiment_price',condiment_price);
        formData.append('file',file_data);
        formData.append('select_condiments_value',select_condiments_value);


          swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willInsert) => {

            if (willInsert) {

              swal("Successfully Added New Condiment", {
                icon: "success",
              });

                  $.ajax({
                  url:'/condiment_inserting',
                  type:'POST',
                  data:formData,
                  processData: false,
                  contentType: false,
                  success:function(response){
                    console.log(response);
                    location.reload();
                  },
                  error:function(response){
                    console.log(response);
                  }
                })
              
            } else {
              swal("Cancelled");
            }
          });
    });


    $('button#condiment_editBtn').click(function(){
        var edit_condiments_value = $(this).val();
        $('#edit_condimentModal').modal('show');

        //
        $.ajax({
          url:'/edit_condiment_inserting',
          type:'get',
          data:{edit_condiments_value:edit_condiments_value},
          success:function(response){
            console.log(response);


            var append_condiment_name = response[0].cat_condi_name;
            var append_condiment_screen = response[0].cat_condi_screen_name;
            var append_condiment_price = response[0].cat_condi_price;
            var append_menu_cat_price = response[0].cat_condi_price;
            var append_cat_condi_id = response[0].cat_condi_id;
           


            $('#append_condiment_name').val(append_condiment_name);
            $('#append_condiment_screen').val(append_condiment_screen);
            $('#append_condiment_price').val(append_condiment_price);
            $('#append_menu_cat_price').val(append_menu_cat_price);
            $('#append_cat_condi_id').val(append_cat_condi_id);
            


          },
          error:function(response){
            console.log(response);
          }
        })
    });



    $('button#update_btn_condiment').click(function(){
        var append_condiment_name = $('#append_condiment_name').val();
        var append_condiment_screen = $('#append_condiment_screen').val();
        var append_condiment_price = $('#append_condiment_price').val();
        var file_data = $('#append_condiment_image').prop('files')[0];
        var append_cat_condi_id = $('#append_cat_condi_id').val();

        var formData = new FormData();
        formData.append('append_condiment_name',append_condiment_name);
        formData.append('append_condiment_screen',append_condiment_screen);
        formData.append('append_condiment_price',append_condiment_price);
        formData.append('file',file_data);
        formData.append('append_cat_condi_id',append_cat_condi_id);


          swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willInsert) => {

            if (willInsert) {

              swal("Successfully Update Condiment", {
                icon: "success",
              });

               $.ajax({
                url:'/update_condiment',
                type:'POST',
                data:formData,
                processData: false,
                contentType: false,
                success:function(response){
                  console.log(response);
                  location.reload();
                },
                error:function(response) {
                  console.log(response);
                }
              })
              
            } else {
              swal("Cancelled");
            }
          });
    });


    $('button#condiment_deleteBtn').click(function(){

        var deleted_condiment_data = $(this).val();

          swal({
          title: "Are you sure to delete this?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willInsert) => {
          if (willInsert) {
             $.ajax({
              url:'/delete_condiment',
              type:'post',
              data:{deleted_condiment_data:deleted_condiment_data},
              success:function(response) {
                console.log(response);
                 swal("Successfully Deleted", {
                  icon: "success",
                });
                location.reload();
              },
              error:function(response) {
                console.log(response);
              }
            })
           
          } else {
            swal("Cancelled");
          }
        });
        
       

    });

});

 $(document).ready(function() {

        $('.first_render').DataTable( {
            "pageLength": 2,
             "bInfo": false ,
             "bLengthChange": false,

        } );


        $('.second_render').DataTable( {
            "pageLength": 2,
             "bInfo": false ,
             "bLengthChange": false,

        } );

  });


  $('button#createChainingbtn').click(function(){
    
    $('#chainingBuilderModal').modal('show');
    $('#nounBuilderModal').modal('show');

    $('#table_chaining_condiments').hide();
  }); 


  $('tr#nounClicked').click(function(){

      var noun_name = $(this).closest("tr").find(".nounScreenNameClicked").text();
      var noun_id = $(this).closest("tr").find(".nounScreenID").text();

   

      swal({
        title: "Are you sure to add " + noun_name + " ?",
        text: "Once you will add it will automatically send to the frame.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
          if (willInsert) {
            
            
            $('.noun_build_item').text(noun_name);
            $('.hidden_noun_id').val(noun_id);
           
          } else {
            swal("Cancelled");
          }
      });

  });

  var tbody = $('#chainingBuild').children('tbody');
  //Then if no tbody just select your table 
  var table = tbody.length ? tbody : $('#chainingBuild');

  $('tr.condimentsClicked').click(function(){
    
    var condiments_name = $(this).closest("tr").find(".condimentsScreenNameClicked").text();
    var condimentsScreenPriced = $(this).closest("tr").find(".condimentsScreenPriced").text();
    var condiments_section_id = $(this).closest("tr").find(".condiments_section_id").text();


    var input = '<input type="number"  id="qty" name="qty" class="form-control" value="1" min="1">';
    var del_button = '<button type="button" class="removeCondimentsButton form-control btn btn-danger" style="color:white">x</button>';

    swal({
        title: "Are you sure to add this condiments "+condiments_name+" to the button?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
          if (willInsert) {

             $('table#chainingBuild').append('<tr><td>'+input+'</td><td>'+condiments_name+'</td><td>'+condimentsScreenPriced+'</td><td><select class="form-control allow_to_open_condiments"><option value="No">No</option><option value="Yes">Yes</option></select></td><td class="get_section_condiment_id_table_data" style="display:none;">'+condiments_section_id+'</td><td>'+del_button+'</td></tr>');
              
              $("button.removeCondimentsButton").click(function () {
                 if ($('table#chainingBuild tr').length > 0) {
                    $(this).closest('tr').remove();
                  }
              });

          } else {
            swal("Cancelled");
          }
      });

  });


  $('#closeAddingChaining').click(function(){
    swal({
        title: "Are you sure to close this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
          if (willInsert) {

            location.reload();
           
          } else {
            
              swal("Form Close!", {
                  icon: "success",
              });

              location.reload();
          }
      });
  })



  $('#show_condimentsModalChain').click(function(){
    $('#nounBuilderModal').modal('hide');
    $('#condimentsBuilderModal').modal('show');
    $('#table_chaining_condiments').show();
  })

  $('#show_nounModalChain').click(function(){
    $('#nounBuilderModal').modal('show');
    $('#condimentsBuilderModal').modal('hide');
  });

  $('#closeCondiModal').click(function(){
      swal({
        title: "Are you sure to close this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
          if (willInsert) {

            $("button#build_success_insert").attr('disabled', false);
           
          } else {
            
            $('#condimentsBuilderModal').modal('show');
          }
      });
  });

  $('#closeNounModal').click(function(){
      swal({
        title: "Are you sure to close this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
          if (willInsert) {
            
            $("button#build_success_insert").attr('disabled', false);
           
          } else {
             $('#nounBuilderModal').modal('show');
          }
      });
  });

$('button#build_success_insert').click(function(){
    swal({
        title: "Are you sure you want build this item?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
          if (willInsert) {


              var rowCountTable = $('#chainingBuild >tbody >tr').length;

              if(rowCountTable == '0') {

                swal("You can't insert without a condiments.", {
                      icon: "warning",
                  });
              }
              else
              {
                 var hidden_noun_id = $('.hidden_noun_id').val();
                  var noun_build_item = $('.noun_build_item').text();



                  var formData = new FormData();
                  formData.append('hidden_noun_id',hidden_noun_id);
                  formData.append('noun_build_item','CH:'+noun_build_item);

                  $.ajax({
                      url:'/insert_menu_builder_properties',
                      type:'POST',
                      data:formData,
                      processData: false,
                      contentType: false,
                      success:function(response){
                        console.log(response);
                      },
                      error:function(response){
                        console.log(response);
                      }
                  });


                  table.find('tr').each(function (i) {

                    var $tds = $(this).find('td'),
                    Qty = $(this).closest('tr').find('td').eq(0).find('#qty').val()
                    Item = $tds.eq(1).text(),
                    price = $tds.eq(2).text(),
                    allow_to_open_condiments = $(this).closest('tr').find('td').eq(3).find('.allow_to_open_condiments').val(),
                    condiment_sec_id = $tds.eq(4).text();

                    var formData_details = new FormData();
                    formData_details.append('Qty',Qty);
                    formData_details.append('Item',Item);
                    formData_details.append('price',price);
                    formData_details.append('allow_to_open_condiments',allow_to_open_condiments);
                    formData_details.append('condiment_sec_id',condiment_sec_id);


                    
                    $.ajax({
                        url:'/insert_menu_builder_details',
                        type:'POST',
                        data:formData_details,
                        processData: false,
                        contentType: false,
                        success:function(response){
                          console.log(response);
                           location.reload();
                        },
                        error:function(response){
                          console.log(response);
                        }
                    });

                  });


                  swal("Successfully Created New Button", {
                      icon: "success",
                  });
              }
           
          } else {
            swal("Cancelled");
          }
      });
    
});



// var tbody = $('table#edit_chainingBuild').children('tbody');
// //Then if no tbody just select your table 
// var table = tbody.length ? tbody : $('table#edit_chainingBuild');


$(document).ready(function(){
  $('button#chain_editBtn').click(function(){

        $('#EditchainingBuilderModal').modal('show');
        $("button#show_nounModalChain").attr('disabled', true);

        var get_chain_id = $(this).val();
        $('.edit_hidden_noun_id').val(get_chain_id);
        
        $.ajax({
            url:'/get_chain_data',
            type:'get',
            data:{get_chain_data_id: get_chain_id},
            success:function(response){
              
              var get_chain_name = response[0].get_chain_name[0].chain_name;
              var menu_builder_properties_id = response[0].get_chain_name[0].menu_builder_properties_id;

              $('.edit_hidden_noun_id').val(menu_builder_properties_id);
              $('.edit_noun_build_item').text(get_chain_name);


               var get_chain_data = response[0].get_chain_data;
 

               $.each(get_chain_data, function (index, el) {

                var stringify = jQuery.parseJSON(JSON.stringify(el));

                var menu_cat_price = stringify['menu_cat_price'];
                var Qty = stringify['Qty'];
                var Price = stringify['Price'];
                var Condiments = stringify['Condiments'];
                var menu_builder_details_id = stringify['menu_builder_details_id'];
                var condiments_section_id = stringify['condiments_section_id'];
                

                // $('#edit_chainingBuild').append("<tr class='clickable-row'><td>" + Qty + "</td><td class='clickable-row-condiments'>" + Condiments + "</td><td>" + Price + "</td><td style='display:none;' data-attribute-chain-id="+menu_builder_details_id +" class='data-attribute-chain-id'>"+menu_builder_details_id+"</td></tr>");
               $('#edit_chainingBuild').append("<tr class='clickable-row'><td><input type='number' value="+Qty+" class='form-control'></td><td class='clickable-row-condiments'>" + Condiments + "</td><td>" + Price + "</td><td style='display:none;' data-attribute-condiments-section-id="+condiments_section_id+" data-attribute-chain-id="+menu_builder_details_id +" class='data-attribute-chain-id'>"+menu_builder_details_id+"</td</tr>");

              })

            },
            error:function(){
              console.log(response);
            }
        })




  })
})


// $('#edit_chainingBuild').on('click','tr.clickable-row',function () {
//       $(this).closest('tr.clickable-row').find('td:not(:last-child)').addClass('selected');
// });




$('#edit_chainingBuild').on('click','tr.clickable-row  td:not(:first-child)',function(e){
     
      $('table#edit_chainingBuild td.clickable-row-condiments').removeClass('selected');
      $('table#edit_chainingBuild td').removeClass('selected');
      $(this).closest('tr.clickable-row').find('td:not(:first-child)').addClass('selected');


      var find_each_id_will_update = $(this).closest('tr.clickable-row').find('td.data-attribute-chain-id.selected').attr('data-attribute-chain-id');

      $('.id_to_update_chain').val(find_each_id_will_update);

      var find_each_id_condiments = $(this).closest('tr.clickable-row').find('.data-attribute-chain-id').attr('data-attribute-condiments-section-id');
      $('table#edit_table_chaining_condiments').find('tbody').empty();

      $('#EditcondimentsBuilderModal').modal('show'); 

      $.ajax({
        url:'/get_each_id_section_condiments',
        type:'get',
        data:{find_each_id_condiments:find_each_id_condiments},
        success:function(response){
          
          var get_each_section = response[0].condiments_table;


          $.each(get_each_section, function (index, el) {

            var stringify = jQuery.parseJSON(JSON.stringify(el));

            var cat_condi_screen_name = stringify['cat_condi_screen_name'];
            var cat_condi_price = stringify['cat_condi_price'];
            var cat_condi_image = stringify['cat_condi_image'];
            var condiment_section_name = stringify['condiment_section_name'];
            var image = '<img src=/storage/' + cat_condi_image + ' class="responsive-img" style="width:100px;">';
            var condiments_section_id = stringify['condiments_section_id'];

            

            $('table#edit_table_chaining_condiments').append("<tr class='edit_condimentsClicked' style='font-size:14px; border:none;'><td>"+condiment_section_name  +"</td><td class='edit_condimentsScreenNameClicked'>" + cat_condi_screen_name + "</td><td class='edit_condimentsScreenPriced'>" + cat_condi_price + "</td><td>"+image+"</td><td class='edit_condimentsID' style='display:none;'>"+condiments_section_id+"</td></tr>");


          });

          $("table#edit_table_chaining_condiments tr").click(function(e){


              var condiments_name = $(this).closest("tr").find("td.edit_condimentsScreenNameClicked").text();
              var condimentsScreenPriced = $(this).closest("tr").find("td.edit_condimentsScreenPriced").text();

               $('#edit_chainingBuild .selected').eq(0).html(condiments_name);
                $('#edit_chainingBuild .selected').eq(1).html(condimentsScreenPriced);

              // var x = $('#edit_chainingBuild tr.clickable-row td.clickable-row-condiments.selected td:nth-child(2)').text();
              // $('#edit_chainingBuild tr.clickable-row td.selected td:nth-child(3)').html(condimentsScreenPriced);


              // var tableBhtml =  $(this).closest('tr').html();

              // var edit_condimentsID = $(this).closest("tr").find(".edit_condimentsID").text();
              // var id_to_edit_build = $('.id_to_update_chain').val();
              // var id_to_edit_builders = $('.id_to_update_chain').val();
              
              
              // $("#edit_chainingBuild tr.selected").replaceWith("<tr data-attribute-chain-id=" + id_to_edit_build + " class='clickable-row'><td class='new_condiments_name'>"+condiments_name+"</td><td>"+condimentsScreenPriced+"</td><td style='display:none;' data-attribute-condiments-section-id="+edit_condimentsID+" data-attribute-chain-id="+id_to_edit_builders +" class='data-attribute-chain-id'>"+id_to_edit_builders+"</td></tr>");
              // $('#EditcondimentsBuilderModal').modal('hide');

          });
        },
        error:function(response){
          console.log(response);
        }
      });


});



$('.edit_build_success_insert').click(function(){

  swal({
        title: "Are you sure to update this button?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
          if (willInsert) {

              $('table#edit_chainingBuild').find('.clickable-row').each(function (i) {

                    var $tds = $(this).find('td'),
                    condiments_name = $tds.eq(0).text(),
                    condimentsScreenPriced = $tds.eq(1).text(),
                    id_to_edit_build = $tds.eq(2).text()


                    var formData_edit_condiments = new FormData();
                    formData_edit_condiments.append('condiments_name',condiments_name);
                    formData_edit_condiments.append('condimentsScreenPriced',condimentsScreenPriced);
                    formData_edit_condiments.append('id_to_edit_build',id_to_edit_build);

                    $.ajax({
                      url:'/insert_update_build_chain',
                      type:'POST',
                      data:formData_edit_condiments,
                      processData: false,
                      contentType: false,
                      success:function(response){
                        console.log(response);
                        swal("Successfully Update");
                        location.reload();
                      },
                      error:function(response){
                        console.log(response);
                      }
                  });
 
              });
                     
          } else {
            swal("Cancelled");
          }
    });


});




$('#edit_chainingBuild').on('change','.changeQuantity',function(e){

      
      $('#EditcondimentsBuilderModal').modal('hide');
      alert($(this).val());

      
});

$('button#closeeditCondiModal').click(function(){
  // $("table#edit_table_chaining_condiments td").html('');
  // $('table#edit_table_chaining_condiments tbody').empty();
})


$('#closeBuildChainUpdate').click(function(){
    // $("button#edit_build_success_insert").attr('disabled', false);
    swal({
        title: "Are you sure to close this form?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
          if (willInsert) {
            
              swal("Cancelled Updating Condiments", {
                  icon: "success",
              });

              location.reload();
           
          } else {
            swal("Cancelled");
            location.reload();
          }
      });
});


$('button#condiment_deleteBtnLayout').click(function(){

        var layout_deleted_condiment_data = $(this).val();

        var data_attribute_menu_builder_details = $(".data-attribute-menu_builder-details").attr('data-attribute-menu_builder-details');

      

        swal({
        title: "Are you sure to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willInsert) => {
        if (willInsert) {
           $.ajax({
            url:'/delete_layout_condiment',
            type:'post',
            data:{layout_deleted_condiment_data:layout_deleted_condiment_data,data_attribute_menu_builder_details:data_attribute_menu_builder_details},
            success:function(response) {
              console.log(response);
               swal("Successfully Deleted", {
                icon: "success",
              });
              location.reload();
            },
            error:function(response) {
              console.log(response);
            }
          })
         
        } else {
          swal("Cancelled");
        }
      });
})



$(document).ready(function(){

    $('button#save_condiment_section_button').click(function(){

        var codiment_section_name = $('#codiment_section_name').val();
        var condiment_section_desc = $('#condiment_section_desc').val();

         swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willInsert) => {

            if (willInsert) {

              swal("Successfully Added New Condiment Section", {
                icon: "success",
              });

                  $.ajax({
                  url:'/insert_condiment_section',
                  type:'POST',
                  data:{codiment_section_name:codiment_section_name,condiment_section_desc:condiment_section_desc},
                  success:function(response){
                    console.log(response);
                    location.reload();
                  },
                  error:function(response){
                    console.log(response);
                  }
                })
              
            } else {
              swal("Cancelled");
            }
          });
       
    });


    $('button#condiment_section_editBtn').click(function(){
       var condiment_section_id = $(this).val();
       
       $('#editModalcondiment_section').modal('show');

       $.ajax({
          url:'/get_condiment_section',
          type:'get',
          data:{condiment_section_id:condiment_section_id},
          success:function(response){
            console.log(response);

            var condiment_section_desc = response[0].condiment_section_desc;
            var condiment_section_name = response[0].condiment_section_name;
            var condiments_section_id = response[0].condiments_section_id;

            $('#hidden_condiment_sec_id').val(condiments_section_id);
            $('#edit_codiment_section_name').val(condiment_section_name);
            $('#edit_condiment_section_desc').val(condiment_section_desc);


          },
          error:function(response){
            console.log(response);
          }
       })

    });



    $('button#update_condiment_section_button').click(function(){

       var hidden_condiment_sec_id =  $('#hidden_condiment_sec_id').val();
       var edit_codiment_section_name =  $('#edit_codiment_section_name').val();
       var edit_condiment_section_desc = $('#edit_condiment_section_desc').val();

        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willInsert) => {

            if (willInsert) {

              swal("Successfully Update", {
                icon: "success",
              });

                  $.ajax({
                  url:'/update_condiment_section',
                  type:'POST',
                  data:{hidden_condiment_sec_id:hidden_condiment_sec_id,edit_codiment_section_name:edit_codiment_section_name,edit_condiment_section_desc:edit_condiment_section_desc},
                  success:function(response){
                    console.log(response);
                    location.reload();
                  },
                  error:function(response){
                    console.log(response);
                  }
                })
              
            } else {
              swal("Cancelled");
            }
          });


    });




    $('button#condiment_section_deleteBtn').click(function(){

       var delete_condiment_sec_id =  $(this).val();

        swal({
            title: "Are you sure to delete this?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willInsert) => {

            if (willInsert) {

              swal("Successfully Deleted", {
                icon: "success",
              });

                  $.ajax({
                  url:'/delete_condiment_section',
                  type:'POST',
                  data:{delete_condiment_sec_id:delete_condiment_sec_id},
                  success:function(response){
                    console.log(response);
                    location.reload();
                  },
                  error:function(response){
                    console.log(response);
                  }
                })
              
            } else {
              swal("Cancelled");
            }
          });


    });
    
});


$(document).ready(function(){
  $("#search_attach_condiments").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#edit_table_chaining_condiments tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});