
    // Keeping Control Panel on screen
      jQuery(window).scroll(function() {
          jQuery('.totop').stop().animate({ right: '0px' });
      });


window.onload = function () {

  $(window).scroll(function(){
    if($(window).scrollTop() < 2440){
      $(".controls").stop().animate({"marginTop": ($(window).scrollTop()) + "px", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );
    }
  });
    $(".slider").on('change', function( event ) {

         //This is for Internet Explorer
         var target = (event.target) ? event.target : event.srcElement;
         var elem = $( this );
         var dataString = elem.attr("id");
                             if(dataString == "toggle" || dataString == "survey" || dataString == "logout"){
                                 return;
                             }

        var value = $("#"+dataString).val();

        numcontrols = numcontrols + 1;

        $('.numcontrols').html('You have tried ' + numcontrols + ' control settings.');

        try {
                    // PAGE THAT WE'RE LEAVING
                    var pageleaving = $(document).xpathEvaluate('//div[contains(@class,"currentPage")]/@id').val().slice(1);

                    }
                    catch(err) {
                    var pageleaving = '0';

                    }

        console.log("pageleaving is " + pageleaving);

        var middle = 0.501;

                    $.ajax({

                           type: "POST",
                           url: "../TweedStudy/src/set_value.php",
                           data: { pageleaving: pageleaving, dataString: dataString, value:value, middle: middle},
                           dataType: 'json',
                           cache: false,
                           success: function(response) {

                              // alert(value);
                              // alert(pageleaving);
                              // console.log(response);

                              $.ajax({

                               type: "POST",
                               // url: "../TweedStudy/src/save_selection.php",
                               url: "../TweedStudy/src/save_selection_simple.php",
                               data: response,
                               dataType: 'json',
                               cache: false,
                               success: function(response) {
                                  console.log("saving their choice");
                                  // console.log(response);
                               //alert(response);
                               // $("#feed").html(response);

                               }
                               // success: function(response) {
                               //    console.log("saving their choice");
                               //   console.log(response);
                               // //alert(response);
                               // // $("#feed").html(response);

                               // }
                               });



                               $.ajax({

                                      type: "POST",
                                      url: "../TweedStudy/src/pass_value_short.php",
                                      data: response,
                                      dataType: 'text',
                                      cache: false,
                                      success: function(response) {

                                      console.log("real: getting into inner ajax");
//                                      console.log(data);
//                                      console.log("<?php echo $_SESSION['button']; ?>");
//                                      console.log(response);
//                                      console.log(thispage);
//                                      console.log(response);

//                                      alert(response);

                                      $("#feed-" +thispage).html(response);


                                      }
                                      });


                               $.ajax({

                                      type: "POST",
                                      url: "../TweedStudy/src/pass_value_rand_short.php",
                                      data:  response,
                                      dataType: 'text',
                                      cache: false,
                                      success: function(response) {

                                      console.log("rand: getting into inner ajax");
//                                      console.log(thispage);
//                                       console.log(response);

                                      //alert(response);
                                      $("#feed2-"+thispage).html(response);

                                      }
                                      });

                           }


                           });


    return false;
    });


  // $("button").on('click', function( event ) {

  //                //This is for Internet Explorer
  //                var target = (event.target) ? event.target : event.srcElement;
  //                var elem = $( this );
  //                var dataString = elem.attr("id");
  //                                    if(dataString == "toggle" || dataString == "survey" || dataString == "logout"){
  //                                        return;
  //                                    }
  //                 console.log(dataString);


  //                $.ajax({

  //                       type: "POST",
  //                       url: "../TweedStudy/src/set_value.php",
  //                       data: { dataString: dataString},
  //                       dataType: 'text',
  //                       cache: false,
  //                       success: function(data) {



  //                       //alert(response);
  //                       //                           $("#feed").html("Set value");

  //                       $.ajax({

  //                              type: "POST",
  //                              url: "../TweedStudy/src/pass_value_short.php",
  //                              data: data,
  //                              dataType: 'text',
  //                              cache: false,
  //                              success: function(response) {

  //                              //alert(response);
  //                              $("#feed").html(response);

  //                              }
  //                              });


  //                       $.ajax({

  //                              type: "POST",
  //                              url: "../TweedStudy/src/pass_value_rand_short.php",
  //                              data: { data},
  //                              dataType: 'text',
  //                              cache: false,
  //                              success: function(response) {

  //                              //alert(response);
  //                              $("#feed2").html(response);

  //                              }
  //                              });

  //                       }


  //                       });


  //               return false;
  //           });


};
