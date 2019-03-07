$(document).ready(function () {


  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var auth_postal_code = $('#auth_postal_code').val();

  var customer_address = $('input#origin-input').val(auth_postal_code);

  



  var tbody = $('#myTable').children('tbody');
  //Then if no tbody just select your table 
  var table = tbody.length ? tbody : $('#myTable');


  //function for getting the data from search product by clicking to the table row
  $('.append_customer_price_order').hide();
    $("tr#productClicked").click(function () {

          var menu_name = $(this).closest("tr").find(".menu_name").text();
          var menu_price = $(this).closest("tr").find(".menu_price").text();
          var chain_id =  $(this).closest("tr").find(".chain_id").text();

          swal({
          title: "Are you sure to add " + menu_name + " ?",
          text: "Once you will add it will automatically send to the cart",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willInsert) => {
          if (willInsert) {
            swal("Successfully Added to your form.", {
              icon: "success",
            });

           $('.append_customer_price_order').show();
           $('.append_customer_noun_order').text(menu_name);
           $('.append_customer_price_order').text(menu_price);
           


          $.ajax({
            url:'/get_noun_group_combination',
            type:'get',
            data:{chain_id:chain_id},
            success:function(response){
               var noun_chaining = response[0].noun_chaining;
               $.each(noun_chaining, function (index, el) {

                var stringify_noun_chaining = jQuery.parseJSON(JSON.stringify(el));

                // console.log(stringify['menu_cat_image']);
                var Qty = stringify_noun_chaining['Qty'];
                var Condiments = stringify_noun_chaining['Condiments'];
                var Price = stringify_noun_chaining['Price'];
                var allow_to_open_condiments = stringify_noun_chaining['allow_to_open_condiments'];

                var condiments_section_id = stringify_noun_chaining['condiments_section_id'];

                
                
                if(Qty == null && Condiments === null && Price === null)
                {

                }
                else
                {
                  $("table#noun_chaining_order").append("<tr class='editCondiments'><td class='condiments_order_quantity'>"+Qty+"</td><td>"+Condiments+"</td><td class='total'>"+Price+"</td><td class='allow_to_open_condiments_conditional' style='display:none;'>"+allow_to_open_condiments+"</td><td class='condi_section_id' style='display:none;'>"+condiments_section_id+"</td></tr>");
                }
                

              })

              var sum_sub_total_price = 0;
              $('td.total').each(function () {

                sum_sub_total_price += parseFloat($(this).text());
               
                
              
              });

              var with_decimal_subprice = parseFloat(sum_sub_total_price).toFixed(2);
              var menu_price_total_condiments = parseFloat(with_decimal_subprice) + parseFloat(menu_price);
              var menu_price_total_condiments_converted = parseFloat(menu_price_total_condiments).toFixed(2);
              

              $('.append_customer_noun_order_price').text(menu_price_total_condiments_converted);
              

            },
            error:function(response){
              console.log(response);
            }
          });


          

          $('.tbody_noun_chaining_order').html('');

        }
      });

    });

    $('.conditional_table_hidden_condiments').hide();

    $('table#noun_chaining_order').on('click','tr.editCondiments',function(e){
      
        var allow_to_open_condiments_conditional =  $(this).closest("tr").find(".allow_to_open_condiments_conditional").text();
        var condiments_order_quantity = $(this).closest("tr").find(".condiments_order_quantity").text();
        // $('tr#append_imaginary_upsize_condiments').removeClass('selected_upsize');
        
        if(allow_to_open_condiments_conditional == 'Yes' && condiments_order_quantity != '-') {

            $('.conditional_table_hidden_noun').hide();

            $('.conditional_table_hidden_condiments').show();


            //$('table#noun_chaining_order tr').removeClass('selected');
            
            if($('#noun_chaining_order').find('.selected').length){    

                  swal("You can't upsize the ongoing item", {
                    icon: "error",
                    
                  });

             }
             else
             {

               // $(this).find('tr').addClass('selected');

               $(this).closest('tr').addClass('selected');

               var find_each_id_condiments = $(this).find('td.condi_section_id').text();

               $("table#customer_table_update_chain_order tbody").html('');

                $('#customer_modal_update_chain_order').modal('show');

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
                      var image = '<img src=/storage/' + cat_condi_image + ' class="responsive-img" style="width:100px;">';
                      

                      var hidden_allowed_to_open_condiments_customize = 'Yes';


                      
                      // $('#edit_chainingBuild').append("<tr class='clickable-row'><td>" + Qty + "</td><td class='clickable-row-condiments'>" + Condiments + "</td><td>" + Price + "</td><td style='display:none;' data-attribute-chain-id="+menu_builder_details_id +" class='data-attribute-chain-id'>"+menu_builder_details_id+"</td></tr>");             
                      //$('table#customer_table_update_chain_order tbody').append("<tr class='customer_edit_table_chaining_condiments' style='font-size:14px; border:none;'><td class='customer_edit_condimentsScreenNameClicked'>" + cat_condi_screen_name + "</td><td class='customer_edit_condimentsScreenPriced'>" + cat_condi_price + "</td><td>"+image+"</td></tr>");
                      
                      var dataTable = $("#customer_table_update_chain_order").DataTable({
                         "pageLength": 8,
                        "createdRow": function( row, data, dataIndex ) {
                            
                              $(row).addClass( 'customer_edit_table_chaining_condiments' );
                              $( row ).find('td:eq(0)')
                              .addClass('customer_edit_condimentsScreenNameClicked');
                              $( row ).find('td:eq(1)')
                              .addClass('customer_edit_condimentsScreenPriced');
                           
                          },

                        "bDestroy": true
                      });

                      /////////////////////////////////////////////
                      

                        // use data table row.add, then .draw for table refresh
                      dataTable.row.add([cat_condi_screen_name, cat_condi_price, image]).draw();
                    


                    });

                    $("#customer_table_update_chain_order tbody tr").on('click',function(e){

                        //this is the item of table B that will append if the table A has no class
                        var customer_edit_condimentsScreenNameClicked = $(this).find('.customer_edit_condimentsScreenNameClicked').text();
                        var customer_edit_condimentsScreenPriced = $(this).find('.customer_edit_condimentsScreenPriced').text();

                        //here will check if table A has selected upsize or not
                        
                        if($('#noun_chaining_order').find('td.selected_upsize').length){    

                            swal("You can't upsize the ongoing item", {
                              icon: "error",
                              
                            });

                       }else if($('#noun_chaining_order').find('tr.selected').length){

                            $('table#noun_chaining_order .selected').after('<tr class="editCondiments" id="append_imaginary_upsize_condiments"><td contenteditable="true" class="editable_qty">1</td><td>'+customer_edit_condimentsScreenNameClicked+'</td><td class="upsize_price">'+customer_edit_condimentsScreenPriced+'</td><td class="done_upsizing_condiments"><i class="fas fa-check"></i></td><td class="remove_upsizing_condiments"><i class="far fa-trash-alt"></i></td></tr>');
                            $('tr#append_imaginary_upsize_condiments td:not(:nth-child(4)):not(:nth-child(5))').addClass('selected_upsize');

                       }
                       else
                       {
                          swal("You can't upsize item, please select one of the item.", {
                              icon: "error",
                              
                            });
                       }


                       $('td.done_upsizing_condiments').on('click',function(){


                          swal({
                            title: "Do you want to upsize this condiments?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                          })
                            .then((willInsert) => {
                              if (willInsert) {

                                //computation here..
                                var condiments_quantity = $(this).closest("tr").find("td.editable_qty").text();
                                var condiments_order_quantity = $('table#noun_chaining_order').find("tr.selected td.condiments_order_quantity").text();                             
                                var comp_condiments_quantity_vs_condiments_order =  condiments_order_quantity - condiments_quantity;

                                if(comp_condiments_quantity_vs_condiments_order == "0") {

                                   $('table#noun_chaining_order').find("tr.selected").remove();
                                }
                                else
                                {
                                  $('table#noun_chaining_order').find("tr.selected td.condiments_order_quantity").text(comp_condiments_quantity_vs_condiments_order);
                                }





                                //upsize and total text
                                var upsize_price = $(this).closest("tr").find("td.upsize_price").text();
                                var append_customer_noun_order_price = $('.append_customer_noun_order_price').text();


                                //multiply quantity and price and set it default
                                var multiplyed_quantity_price = parseFloat(condiments_quantity) * parseFloat(upsize_price);
                                //need this
                                var with_decimal_append_multiplyed_quantity_price = parseFloat(multiplyed_quantity_price).toFixed(2);

                                $('td.upsize_price').text(with_decimal_append_multiplyed_quantity_price);
                                

                                //get_total_price with upsize
                                // var with_decimal_upsize_price = parseFloat(upsize_price).toFixed(2);
                                
                                var with_decimal_append_customer_noun_order_price = parseFloat(append_customer_noun_order_price).toFixed(2);

                                var menu_price_total_upsize_price = parseFloat(with_decimal_append_multiplyed_quantity_price) + parseFloat(with_decimal_append_customer_noun_order_price);
                                var menu_price_total_upsize_price_converted = parseFloat(menu_price_total_upsize_price).toFixed(2);
                                $('.append_customer_noun_order_price').text(menu_price_total_upsize_price_converted);
                                $('table#noun_chaining_order td').removeClass('upsize_price');



                                $('tr#append_imaginary_upsize_condiments td:not(:nth-child(4)):not(:nth-child(5))').removeClass('selected_upsize');

                                $('#noun_chaining_order tr').removeClass('selected');
                                $("#noun_chaining_order td.done_upsizing_condiments").remove();
                                $("#noun_chaining_order td.remove_upsizing_condiments").remove();
                                $('td.editable_qty').attr('contenteditable','false');
                                $('tr#append_imaginary_upsize_condiments').removeAttr('id');
                                $('.conditional_table_hidden_condiments').hide();
                                $('.conditional_table_hidden_noun').show();
                                $("table#customer_table_update_chain_order tbody").remove();

                                swal("Upsize Success", {
                                  icon: "success",
                             
                                });

                              } else {
                                swal("Cancelled");
                              }
                            });

       

                       });
                      
                       $('td.remove_upsizing_condiments').on('click',function(){
                          $(this).closest('tr').remove();
                       });
                          
                        
                    });

                  },
                  error:function(response){
                    console.log(response);
                  }
                });
             }        
        }
        else if(allow_to_open_condiments_conditional == 'Yes' && condiments_order_quantity == '-')
        {
            $('.conditional_table_hidden_noun').hide();

            $('.conditional_table_hidden_condiments').show();


            $('table#noun_chaining_order tr').removeClass('selected');

            $(this).addClass('selected');

          

            var find_each_id_condiments = $(this).find('td.condi_section_id').text();
             $("table#customer_table_update_chain_order tbody").html('');

              $('#customer_modal_update_chain_order').modal('show');

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
                    var image = '<img src=/storage/' + cat_condi_image + ' class="responsive-img" style="width:100px;">';
                    
                    // $('#edit_chainingBuild').append("<tr class='clickable-row'><td>" + Qty + "</td><td class='clickable-row-condiments'>" + Condiments + "</td><td>" + Price + "</td><td style='display:none;' data-attribute-chain-id="+menu_builder_details_id +" class='data-attribute-chain-id'>"+menu_builder_details_id+"</td></tr>");
                    
                    $('table#customer_table_update_chain_order tbody').append("<tr class='customer_edit_table_chaining_condiments' style='font-size:14px; border:none;'><td class='customer_edit_condimentsScreenNameClicked'>" + cat_condi_screen_name + "</td><td class='customer_edit_condimentsScreenPriced'>" + cat_condi_price + "</td><td>"+image+"</td></tr>");
                  
                  });


                  $(".customer_edit_table_chaining_condiments").click(function(e){



                    var customer_edit_condimentsScreenNameClicked = $(this).closest('tr').find('.customer_edit_condimentsScreenNameClicked').text();
                    var customer_edit_condimentsScreenPriced = $(this).closest('tr').find('.customer_edit_condimentsScreenPriced').text();
                    
                    $('.tbody_noun_chaining_order tr.selected td:nth-child(2)').html(customer_edit_condimentsScreenNameClicked);
                    $('.tbody_noun_chaining_order tr.selected td:nth-child(3)').html(customer_edit_condimentsScreenPriced);


                    var sum_sub_total_price = 0;
                    $('td.total').each(function () {
                      sum_sub_total_price += parseFloat($(this).text());           
                    });

                    var append_customer_price_order = $('.append_customer_price_order').text();
                    var convert_append_customer_price_order = parseFloat(append_customer_price_order).toFixed(2);

                    var menu_price_total_condiments = parseFloat(append_customer_price_order) + parseFloat(sum_sub_total_price);
                    var convert_with_decimal_menu_price_total_condiments = parseFloat(menu_price_total_condiments).toFixed(2);
                    $('.append_customer_noun_order_price').text(convert_with_decimal_menu_price_total_condiments)

                  });

                },
                error:function(response){
                  console.log(response);
                }
              });
        }
        else
        {

        }

    });




    $('button.back_to_noun').click(function(){

        $('.conditional_table_hidden_noun').show();

        $('.conditional_table_hidden_condiments').hide();

        $('table#noun_chaining_order tr').removeClass('selected');

        $("table#customer_table_update_chain_order tbody").remove();

    });

    $('button#close_customer_modal_chaining').click(function(){
          $("table#customer_table_update_chain_order tbody").html('');
    });


    $('#refresh_order').click(function () {
      swal({
        title: "Do you want to end this transaction?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willInsert) => {
          if (willInsert) {
            swal("Transaction Close", {
              icon: "success",
         
            });

            location.reload();
          } else {
            swal("Cancelled");
          }
        });
    });



  $(document).ready(function () {
    $('#filter_orders').on('change', function () {
      var value = this.value;
      var customer_id = $(this).find(':selected').attr('data-user-id');

      $.ajax({
        url: '/customer_all_orders/' + customer_id,
        type: 'get',
        data: { filter: value },
        success: function (response) {
          console.log(response);

         
        },
        error: function (error) {
          console.log(error);
        }
      })


    });
  })
})


$(document).ready(function () {
  $('#registerDriverButton').click(function (e) {

    var driver_name = $('#driver_name').val();
    var driver_email = $('#driver_email').val();
    var driver_number = $('#driver_number').val();
    var driver_store = $('#driver_store').val();

    $.ajax({
      url: '/driver_registered',
      type: 'post',
      data: { driver_name: driver_name, driver_email: driver_email, driver_number: driver_number, driver_store: driver_store },
      success: function (res) {
        swal({
          title: "Are you sure to submit this?",
          text: "Happy to be Driver",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
          .then((willInsert) => {
            if (willInsert) {
              swal("Successfully Inserted", {
                icon: "success",
              });
              location.reload();
            } else {
              swal("Cancelled");
            }
          });
      },
      error: function (res) {
        console.log(res);
      }
    });
  });


  // $('button#assigndriverButton').click(function(){







  //          $.ajax({
  //              url:'/driver_data_append',
  //              type:'GET',
  //              dataType: 'JSON',
  //              data:{customer_id: details_id},
  //              success: function(response) {

  //                  var address_customer = response[0]['customer_address'];
  //                  var id_customer = response[0]['customer_id'];
  //                  var province_customer = response[0]['customer_location'];

  //                  $('#place_customer').text(address_customer);
  //                  $('#hidden_customer_id').val(id_customer);
  //                  $('#hidden_province').val(province_customer);


  //              },
  //               error: function(response) {
  //                  console.log(response);
  //              }
  //          });

  // });



  $('#closeDriverAssign').click(function () {
    location.reload();
  })


  var tbody_driver = $('#driversLineupTable').children('tbody');

  //Then if no tbody just select your table 
  var table_driver = tbody_driver.length ? tbody_driver : $('#driversLineupTable');

  $('button#assigndriverButton').click(function () {


    var fired_button = $(this).val();
    $('#driver_details').val(fired_button);
    var driver_id = $('#driver_details').val();

    // var driver_name = $(this).closest("tr").find(".driver_name").text();
    // var driver_email = $(this).closest("tr").find(".driver_email").text();
    // var driver_number = $(this).closest("tr").find(".driver_number").text();

    swal({
      title: "Do you wish you want add this driver in the line up?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
      .then((willInsert) => {
        if (willInsert) {

          $.ajax({
            url: '/update_driver_status_available',
            type: 'post',
            data: { driver_id: driver_id },
            success: function (res) {
              swal("Driver is now active", {
                icon: "success",
              });
              $(this).closest('tr').remove();
              location.reload();
            },
            error: function (res) {

              console.log(res);

            }
          });

        } else {
          swal("Cancelled");
        }
      });

  });

  $('button#lineupdriverButton').click(function () {


    var fired_button = $(this).val();
    $('#lineupdriverButton').val(fired_button);
    var driver_id = $('#lineupdriverButton').val();

    swal({
      title: "Do you wish you want off this driver in the line up?",
      text: "Driver is now sign off",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
      .then((willInsert) => {
        if (willInsert) {

          $.ajax({
            url: '/update_driver_status_offline',
            type: 'post',
            data: { driver_id: driver_id },
            success: function (res) {
              swal("Driver is now offline", {
                icon: "success",
              });
              $(this).closest('tr').remove();
              location.reload();
            },
            error: function (res) {
              console.log(res);
            }
          });





        } else {
          swal("Cancelled");
        }
      });
  });

});



$(document).ready(function () {


  $(".drag-wrapper").draggable({
    appendTo: "body",
    cursor: "move",
    helper: 'clone'
  });


  $('.kitchen').droppable({
    tolerance: "intersect",
    accept: '.from-launch',
    revert: 'invalid',
    drop: function (event, ui) {


      var driver = ui.draggable.attr('data-driver');
      if (driver == '') {
        swal("Look for driver", {
          icon: "warning",
        });
      }
      else {
        ui.draggable.removeClass("from-launch").addClass("from-kitchen2");
        $(this).append($(ui.draggable));
        var update_customer_or_number = ui.draggable.attr('data-customer-or-number');
        var update_status = 'Kitchen';

        $.ajax({
          url: '/update_customer_status',
          data: { update_customer_or_number: update_customer_or_number, update_status: update_status },
          type: 'post',
          success: function (response) {
            console.log(response);
          },
          error: function (response) {
            console.log(response);
          }
        });

      }

    }

  });


  $(".Road").droppable({
    tolerance: "intersect",
    accept: ".from-kitchen2",
    activeClass: "ui-state-default",
    hoverClass: "ui-state-hover",
    drop: function (event, ui) {
      ui.draggable.removeClass("from-kitchen2").addClass("from-kitchen3");
      $(this).append($(ui.draggable));
      var update_customer_or_number = ui.draggable.attr('data-customer-or-number');
      var update_status = 'Road';

      $.ajax({
        url: '/update_customer_status',
        data: { update_customer_or_number: update_customer_or_number, update_status: update_status },
        type: 'post',
        success: function (response) {
          console.log(response);
        },
        error: function (response) {
          console.log(response);
        }
      });
    }
  });


  $(".Completed").droppable({
    tolerance: "intersect",
    accept: ".from-kitchen3",
    activeClass: "ui-state-default",
    hoverClass: "ui-state-hover",
    drop: function (event, ui) {
      ui.draggable.removeClass("from-kitchen3").addClass("from-kitchen4");
      $(this).append($(ui.draggable));
      var update_customer_or_number = ui.draggable.attr('data-customer-or-number');
      var update_status = 'Completed';

      $.ajax({
        url: '/update_customer_status',
        data: { update_customer_or_number: update_customer_or_number, update_status: update_status },
        type: 'post',
        success: function (response) {
          console.log(response);
        },
        error: function (response) {
          console.log(response);
        }
      });

      swal("Order completed", {
        icon: "success",
      });
    }
  });


});

$('#dismiss_monitoring_detail').click(function () {
  location.reload();
});



$('button#gather_customer_order').on('click', function () {
  var order_id = $(this).attr('data-order-id');
  var customer_id = $(this).attr('data-customer-id');



  $.ajax({
    url: '/customer_detail_ordering_logic',
    type: 'GET',
    data: { order_id: order_id, customer_id: customer_id },
    success: function (response) {

      var response_customer_id = response[0].customer_details_id[0].customer_id;
      var response_order_id = response[0].customer_details_id[0].order_id;
      var response_order_number = response[0].customer_details_id[0].or_number;

      $.ajax({
        url: '/fetch_detail_order_monitor',
        type: 'GET',
        dataType: 'json',
        data: { response_order_id: response_order_id, response_customer_id: response_customer_id },
        success: function (res) {




          var customers_details_id = jQuery.parseJSON(JSON.stringify(res[0].customers_details_id));

          var customer_number_monitor = customers_details_id[0].customer_number;
          var customer_name_monitor = customers_details_id[0].customer_name;
          var customer_address_monitor = customers_details_id[0].customer_address;
          var customer_address_email = customers_details_id[0].customer_email;

          $('.monitor_customer_address').append(customer_address_monitor);
          $('.monitor_customer_number').append(customer_number_monitor);
          $('.monitor_customer_name').append(customer_name_monitor);
          $('.monitor_customer_email').append(customer_address_email);


          $('.order_number_monitoring').append(response_order_number)


          // var select_order_properties = jQuery.parseJSON(JSON.stringify(res[0].select_order_properties));
          // console.log(select_order_properties);
          var select_delivery_charge = jQuery.parseJSON(JSON.stringify(res[0].select_delivery_charge));
          $('#label_delivery_charge').append(select_delivery_charge[0].charge_value);


          var select_order_properties = jQuery.parseJSON(JSON.stringify(res[0].select_order_properties));
          $('#label_province_tax_rate').append(select_order_properties[0].total_tax);



          var select_order_details = response[0].select_order_details;

          var select_order_details_monitor = res[0].select_order_properties;

          $('#label_province_tax_rate').append(select_order_details_monitor[0].charge_value);
          $('#sub_total').append(select_order_details_monitor[0].subtotal);
          $('#total_price_label').append(select_order_details_monitor[0].amount);




          $.each(select_order_details, function (index, el) {

            var stringify = jQuery.parseJSON(JSON.stringify(el));
            // console.log(stringify['menu_cat_image']);
            var cat_image = stringify['menu_cat_image'];
            var menu_cat_name = stringify['menu_cat_name'];
            var Quantity = stringify['Quantity'];
            var Subtotal = stringify['Subtotal'];
            var image = '<img src=/storage/' + cat_image + ' class="responsive-img" style="width:100px;">';
            $("#result").append("<tr><td>" + image + "</td><td>" + menu_cat_name + "</td><td>" + Quantity + "</td><td>" + Subtotal + "</td></tr>");

          })


        }
      })

    }
  })
});



$('button#assign_btn').click(function () {

  var order_id = $(this).attr('data-order-id');
  var customer_id = $(this).attr('data-customer-id');


  $(".driver_info").hide();

  $.ajax({
    url: '/get_assign_customer_to_driver',
    type: 'get',
    data: { customer_id: customer_id },
    success: function (response) {

      var name_customer = response[0]['customer_name'];
      console.log(response);
      // var id_customer = response[0]['customer_id'];

      $('#assign_customer').append(name_customer);
      $('#assign_customer_order_id').val(order_id);
    },
    error: function (error) {
      console.log(error);
    }

  })

  var counter = 5;

  setInterval(function () {
    counter--;
    if (counter >= 0) {
      span = document.getElementById("count");
      span.innerHTML = counter;
    }
    // Display 'counter' wherever you want to display it.
    if (counter === 0) {
      //    alert('this is where it happens');
      clearInterval(counter);
      $(".find_driver").hide();
      $(".driver_info").show();


    }

  }, 1000);
});

$('#dismiss_driver_assign').click(function () {
  location.reload();
});


$('button#assign_customer_button').click(function () {

  var driver_id = $(this).val();
  var assign_customer_order_id = $('#assign_customer_order_id').val();

  swal({
    title: "Are you sure to assign this to customer?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
    .then((willInsert) => {
      if (willInsert) {
        swal("Successfully Assigned to the customer", {
          icon: "success",
        });
        $.ajax({
          url: '/update_customer_driver',
          type: 'post',
          data: { driver_id: driver_id, assign_customer_order_id: assign_customer_order_id },
          success: function (response) {

          },
          error: function (error) {
            console.log(error);
          }
        });

      } else {
        swal("Cancelled");
      }
    });


});



$(document).ready(function () {
  function dateTime() {
    var format = "";
    var ndate = new Date();
    var hr = ndate.getHours();
    var h = hr % 12;

    if (hr < 12) {
      greet = 'Good Morning';
      format = 'AM';
    }
    else if (hr >= 12 && hr <= 17) {
      greet = 'Good Afternoon';
      format = 'PM';
    }
    else if (hr >= 17 && hr <= 24)
      greet = 'Good Evening';

    var m = ndate.getMinutes().toString();
    var s = ndate.getSeconds().toString();

    if (h < 12) {
      h = "0" + h;
      $("h2.day-message").html(greet);
    } else if (h < 18) {
      $("h2.day-message").html(greet);
    } else {
      $("h2.day-message").html(greet);
    }

    if (s < 10) {
      s = "0" + s;
    }

    if (m < 10) {
      m = "0" + m;
    }

    $('.date').html(h + ":" + m + ":" + s + format);
  }

  setInterval(dateTime, 1000);
});



$('i#btn-deleted-order').click(function () {

  var deleted_order = $(this).attr('data-or-number-deleted');
  var update_status = 'Cancelled';

  swal({
    title: "Do you want cancel this order?",
    text: "Once you submit this, you can't recover the order",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
    .then((willInsert) => {
      if (willInsert) {

        $.ajax({
          url: '/update_customer_status',
          data: { deleted_order: deleted_order, update_status: update_status },
          type: 'post',
          success: function (response) {
            console.log(response);
          },
          error: function (response) {
            console.log(response);
          }
        });

        swal("Order Cancelled", {
          icon: "success",
        });

        location.reload();
      }
      else {
        swal("Cancelled");
      }

    });
});


$('#save_customer_details').click(function () {

    var customer_address = $('input#destination-input').val();
    var customer_name = $('#customer_name').val();
    var customer_number = $('#customer_number').val();
    var customer_email = $('#customer_email').val();
    var customer_postal = $('#customer_postal').val();
    var customer_location = $('#customer_location').val();
    var customer_order = CKEDITOR.instances['customer_order'].getData();

    var formData = new FormData();
    formData.append('customer_name', customer_name);
    formData.append('customer_number', customer_number);
    formData.append('customer_email', customer_email);
    formData.append('customer_address', customer_address);
    formData.append('customer_location', customer_location);
    formData.append('customer_order', customer_order);
    formData.append('customer_postal', customer_postal);


    var int_length = ('' + customer_number).length;


    if (customer_name.length === 0 ||
      customer_number.length === 0 ||
      customer_email.length === 0 ||
      customer_address.length === 0 ||
      customer_postal.length === 0) {

      swal({
        title: "Please Fill The Empty Box.",
        icon: "warning",
        button: "Done",
      });

    }
    else if (customer_number.length != 11) {
      swal({
        title: "Customer Number Must Be 11 Digits.",
        icon: "warning",
        button: "Done",
      });
    }
    else {


      $.ajax({
        url: '/insert_customer_details',
        data: formData,
        type: 'POST',
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (response) {
          if (response == 'User Already Exist') {
            swal({
              title: "This User Already Exist Please do search!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            });
          }
          else {



            swal({
              title: "Sucessfully Registered",
              icon: "success",  
              button: "Done",
            });

            $.ajax({
               url:'/get_imaginary_customer_details',
               type:'get',
               success:function(response) {
                  $('#add_customer').modal('hide');
                  console.log(response);
                  $('#add_cart').modal('show');
                  var address_customer = response[0]['customer_address'];
                  var id_customer = response[0]['customer_id'];
                  var province_customer = response[0]['customer_location'];
                
                  $('#place_customer').text(address_customer);
                  $('#hidden_customer_id').val(id_customer);
                  $('#hidden_province').val(province_customer);
               },
               error:function(response) {
                  console.log(response);
               }
            })

          
            


          }
        },
        error: function (response) {
          console.log(response);
        }
      });

    }
  });

  $('#closeRegistration').click(function () {
    location.reload();
  })
  //get user


$(document).ready(function(){

  $.ajax({
    url:'/logic_get_customer_data',
    type: 'GET',
    dataType: 'json',
    success:function(response) {
 
      var details = response.data;

      $.each(details, function (index, el) {

          var stringify = jQuery.parseJSON(JSON.stringify(el));
         
          var customer_name_each = stringify['customer_name'];
          var customer_address_each = stringify['customer_address'];
          var customer_email_each = stringify['customer_email'];
          var customer_number_each = stringify['customer_number'];
          var store_location_each = stringify['customer_location'];
          var customer_order_note_each = stringify['customer_order_note'];
          var customer_registered_each = stringify['customer_registered'];
          var customer_id_each = stringify['customer_id'];
          var action_each = '<button id="show_cart_button" class="btn btn-primary" type="button" value='+customer_id_each+' data-toggle="modal" data-target="#add_cart" ><i class="fas fa-cart-arrow-down"></i></button>';
      
          var t = $( "#tables" ).DataTable();
          t.row.add([customer_name_each,
            customer_address_each,
            customer_email_each,
            customer_number_each,
            store_location_each,
            customer_order_note_each,
            customer_registered_each,
            action_each]).draw();

        })
    }

  });

});


$("body").on("click", "#show_cart_button",function () {

  var fired_button = $(this).val();

  $('#customer_details').val(fired_button);
  var details_id = $('#customer_details').val();



  $.ajax({
    url: '/customer_data_append',
    type: 'GET',
    dataType: 'JSON',
    data: { customer_id: details_id },
    success: function (response) {

    

      var address_customer = response[0]['customer_address'];
      var id_customer = response[0]['customer_id'];
      var province_customer = response[0]['customer_location'];
      var customer_name = response[0]['customer_name'];
    
      $('#place_customer').text(address_customer);
      $('#hidden_customer_id').val(id_customer);
      $('#hidden_province').val(province_customer);
      $('#append_customer_name').text(customer_name);


    

    },
    error: function (response) {
      console.log(response);
    }
  });

});



 $(document).ready(function () {
    $('#add_to_cart').click(function () {

      var customer_id = $('#hidden_customer_id').val();
      var append_customer_noun_order = $('.append_customer_noun_order').text();
      var append_customer_noun_order_price = $('.append_customer_noun_order_price').text();

      swal({
        title: "Are you sure to submit this?",
        text: "Once inserted, you will not be able to edit the transaction!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willInsert) => {
          if (willInsert) {

            //insert order properties
            // insert_wish_list_menu_order
            $.ajax({
              // url: '/insert_customer_order_properties',
              url: '/insert_wish_list_menu_order',
              type: 'post',
              data: {
                customer_id: customer_id,
                append_customer_noun_order: append_customer_noun_order,
                append_customer_noun_order_price: append_customer_noun_order_price,
              },

              success: function (response) {

                  $('#noun_chaining_order').find('tr.editCondiments').each(function (i) {

                    var rowCount = $('#noun_chaining_order tr.editCondiments').length;

                    if(rowCount == 0) {

                    }
                    else
                    {
                          var $tds = $(this).find('td'),

                          Qty = $tds.eq(0).text(),
                          Item = $tds.eq(1).text(),
                          Cost = $tds.eq(2).text();

                          $.ajax({
                            // url: '/insert_customer_order_details_properties',
                            url: '/insert_wish_list_menu_belong_condiments',
                            type: 'post',
                            data: {
                              Qty: Qty,
                              Item: Item,
                              Cost: Cost
                            },

                            success: function (response) {

                            },

                            error: function (response) {
                              console.log(response);
                            }


                          });
                    }


                  });
              },

              error: function (response) {
                console.log(response);
              }

            });


            swal("Add to cart success", {
              icon: "success",
            });
          } else {
            swal("Cancelled");
          }
        });

      

  });

});


 $(document).ready(function(){

    
      var total_wish_order = $('.total_wish_order').length;

      $('.total_order_count').text(total_wish_order);
      
      var sum_sub_total_price = 0;

      $('label.compute_order_prices').each(function () {
        sum_sub_total_price += parseFloat($(this).text().replace('$',''));
        
      });
        
      var sum_sub_total_price_converted_fixed = parseFloat(sum_sub_total_price).toFixed(2);
       $('.total_wish_sub_total').text(sum_sub_total_price_converted_fixed);

      //get the tax rate computation

      var province_tax_rate = $('.tax_rate').val();
      var total_wish_subtotal = $('.total_wish_sub_total').text();

      var convert_to_float_tax = parseFloat(province_tax_rate).toFixed(2);
      var covert_total_wish_subtotal = parseFloat(total_wish_subtotal).toFixed(2);
     
      var computation_subtotal_with_tax = parseFloat(covert_total_wish_subtotal) * parseFloat(convert_to_float_tax);
      $('.total_tax_rate_computation').text(parseFloat(computation_subtotal_with_tax).toFixed(2));

      var get_delivery_rate = $('.delivery_rate').text().replace('$','');
      var delivery_rate = parseFloat(get_delivery_rate).toFixed(2);

      var grand_price = parseFloat(covert_total_wish_subtotal) + parseFloat(computation_subtotal_with_tax) + parseFloat(delivery_rate);
      $('.total_price_label').text(parseFloat(grand_price).toFixed(2));

 });


 $(document).ready(function(){
    $('.remove_wish_order').on('click',function(){
        
        var order_item_id = $(this).attr('data-attribute-delete-wish-order');

        swal({
          title: "Do you want to delete your order?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
          .then((willInsert) => {
            if (willInsert) {

               $.ajax({
                url:'/remove_order_in_the_list',
                type:'POST',
                data:{order_item_id: order_item_id},
                success:function(response){
                  console.log(response);

                  location.reload();
                },  
                error:function(response){
                  console.log(response);
                }

              })

              swal("Order remove", {
                icon: "success",
              });

         
            } else {
              swal("Cancelled");
            }
        });

       
    })
 });


 $(document).ready(function(){
    $('#btn_order_peroperties').on('click',function(){
      
    });
 })