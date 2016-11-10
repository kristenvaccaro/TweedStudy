
    // Keeping Control Panel on screen
      jQuery(window).scroll(function() {
          jQuery('.totop').stop().animate({ right: '0px' });
      });


window.onload = function () {
    $(".slider").on('change', function( event ) {

         //This is for Internet Explorer
         var target = (event.target) ? event.target : event.srcElement;
         var elem = $( this );
         var dataString = elem.attr("id");
                             if(dataString == "toggle" || dataString == "survey" || dataString == "logout"){
                                 return;
                             }

        var value = $("#"+dataString).val();

//        console.log("test");
//        console.log(dataString);
//        console.log(value);
//        console.log(thispage);

        var middle = 0.501;

//        if(dataString == 'distanceSlider'){
//          var button = document.getElementById("close_friends");
//          var button2 = document.getElementById("distant_friends");
//          var middle = 0.501;
//        }
//        if(dataString == 'frequencySlider'){
//          var button = document.getElementById("poster_frequent");
//          var button2 = document.getElementById("poster_infrequent");
//          var middle = document.getElementById(dataString).max / 2;
//        }
//        if(dataString == 'popularitySlider'){
//          var button = document.getElementById("tweet_popular");
//          var button2 = document.getElementById("tweet_unpopular");
//          var middle = document.getElementById(dataString).max / 2;
//          console.log(middle);
//        }
//        if(value == middle){
//          button.style.fontWeight = "normal";
//          button2.style.fontWeight = "normal";
//        }
//        if(value < middle){
//          button.style.fontWeight = "normal";
//          button2.style.fontWeight = "bold";
//        }
//        if(value > middle){
//          button.style.fontWeight = "bold";
//          button2.style.fontWeight = "normal";
//        }


                    $.ajax({

                           type: "POST",
                           url: "../TweedStudy/src/set_value.php",
                           data: { dataString: dataString, value:value, middle: middle, thispage: thispage},
                           dataType: 'json',
                           cache: false,
                           success: function(data) {



                               $.ajax({

                                      type: "POST",
                                      url: "../TweedStudy/src/pass_value_short.php",
                                      data: data,
                                      dataType: 'text',
                                      cache: false,
                                      success: function(response) {

                                      console.log("real: getting into inner ajax");
                                      console.log(data);
//                                      console.log("<?php echo $_SESSION['button']; ?>");
                                      console.log(response);
//                                      console.log(thispage);
//                                      console.log(response);

//                                      alert(response);

                                      $("#feed-" +thispage).html(response);


                                      }
                                      });


                               $.ajax({

                                      type: "POST",
                                      url: "../TweedStudy/src/pass_value_rand_short.php",
                                      data:  data,
                                      dataType: 'text',
                                      cache: false,
                                      success: function(response) {

                                      console.log("rand: getting into inner ajax");
//                                      console.log(thispage);
                                       console.log(response);

                                      //alert(response);
                                      $("#feed2-"+thispage).html(response);

                                      }
                                      });

                           }


                           });





//        $.ajax({
//
//               type: "POST",
//               url: "../TweedStudy/src/pass_value.php",
//               data: { dataString: dataString },
//               dataType: 'text',
//               cache: false,
//               success: function(response) {
//
//               //alert(response);
//               $("#feed").html(response);
//
//               }
//               });


//        $.ajax({
//
//               type: "POST",
//               url: "../TweedStudy/src/pass_value.php",
//               data: { dataString: dataString },
//               dataType: 'text',
//               cache: false,
//               success: function(response) {
//
//               //alert(response);
//               $("#feed2").html(response);
//
//               }
//               });

//         $.ajax({
//
//                type: "POST",
//                url: "../TweedStudy/src/pass_value.php",
//                data: { dataString: dataString, value:value, middle: middle},
//                dataType: 'text',
//                cache: false,
//                success: function(response) {
//                console.log("Ajax call success");
//                //alert(response);
//                $("#feed").html(response);
//                //document.getElementById("feed").innerHTML=xmlhttlp.response;
//
//                }
//                });


    return false;
    });


  $("button").on('click', function( event ) {

                 //This is for Internet Explorer
                 var target = (event.target) ? event.target : event.srcElement;
                 var elem = $( this );
                 var dataString = elem.attr("id");
                                     if(dataString == "toggle" || dataString == "survey" || dataString == "logout"){
                                         return;
                                     }
                  console.log(dataString);


                 $.ajax({

                        type: "POST",
                        url: "../TweedStudy/src/set_value.php",
                        data: { dataString: dataString},
                        dataType: 'text',
                        cache: false,
                        success: function(data) {


                        $.ajax({

                               type: "POST",
                               url: "../TweedStudy/src/save_selection.php",
                               data: data,
                               dataType: 'text',
                               cache: false,
                               success: function(response) {

                               //alert(response);
                               // $("#feed").html(response);

                               }
                               });


                        //alert(response);
                        //                           $("#feed").html("Set value");

                        $.ajax({

                               type: "POST",
                               url: "../TweedStudy/src/pass_value_short.php",
                               data: data,
                               dataType: 'text',
                               cache: false,
                               success: function(response) {

                               //alert(response);
                               $("#feed").html(response);

                               }
                               });


                        $.ajax({

                               type: "POST",
                               url: "../TweedStudy/src/pass_value_rand_short.php",
                               data: { data},
                               dataType: 'text',
                               cache: false,
                               success: function(response) {

                               //alert(response);
                               $("#feed2").html(response);

                               }
                               });

                        }


                        });


//                 $.ajax({
//
//                        type: "POST",
//                        url: "../TweedStudy/src/pass_value.php",
//                        data: { dataString: dataString},
//                        dataType: 'text',
//                        cache: false,
//                        success: function(response) {
//
//                        //alert(response);
//                        $("#feed").html(response);
//
//                        }
//                        });
//
//
//                 $.ajax({
//
//                        type: "POST",
//                        url: "../TweedStudy/src/pass_value_rand.php",
//                        data: { dataString: dataString},
//                        dataType: 'text',
//                        cache: false,
//                        success: function(response) {
//
//                        //alert(response);
//                        $("#feed2").html(response);
//
//                        }
//                        });

                 //                 $.ajax({
//
//                        type: "POST",
//                        url: "../TweedStudy/src/pass_value.php",
//                        data: { dataString: dataString },
//                        dataType: 'text',
//                        cache: false,
//                        success: function(response) {
//
//                        //alert(response);
//                        $("#feed").html(response);
//
//                        }
//                        });
//
//
//                 $.ajax({
//
//                        type: "POST",
//                        url: "../TweedStudy/src/pass_value.php",
//                        data: { dataString: dataString },
//                        dataType: 'text',
//                        cache: false,
//                        success: function(response) {
//
//                        //alert(response);
//                        $("#feed2").html(response);
//
//                        }
//                        });


//                $.ajax({
//
//                        type: "POST",
//                        url: "../TweedStudy/src/pass_value.php",
//                        data: { dataString: dataString },
//                        dataType: 'text',
//                        cache: false,
//                        success: function(response) {
//                        console.log("Ajax call success");
//                        //alert(response);
//                        $("#feed").html(response);
//                        //document.getElementById("feed").innerHTML=xmlhttlp.response;
//
//                        }
//                        });




//
                return false;
            });


};

//need to create pass_value.php
    //should update session variables
    // dataStrng here should be in json format
    // just update the one element ID
    // maybe within or maybe in update_tweets.php (below)
    // should create long string of SQL query and
    // update the tweet list div
    // to update the div you want this line::
    // document.getElementById("txtHint").innerHTML=xmlhttp.responseText;  Pretty sure this is the AJAX
    // this will update whatever is inside of the the div with ID equal to "txtHint"
    // and will replace it with (hopefully correctly formatted html) from responseText
    // so ideally responseText will already be formatted right (ie.
    // the output of printTweet)

//                  # PUT THE AJAX SESSION VARIABLE UPDATE HERE!
//                               if ( elem.attr( "id" ).match("sentiment_positive")) {
//                               #testString = "$test = ($_SESSION['" + elem.attr("id") + "'].value) ? 'true' : 'false'; echo $test;";
//                               #alert(testString);
//                               } else {
//                                       alert("something not working");
//                               }

                 // alert("<?php $test = ($_SESSION['sentiment_positive'].value) ? 'true' : 'false'; echo $test ?>");



//                $("div#changeButton").on('click', 'button.astext', function( eventObject ) {
////                                             <?php
////                                             if($_SESSION['sentiment_positive'].value==false){
////                                                 $_SESSION['sentiment_positive'].value=true;}
////
////                                             else {
////                                             $_SESSION['sentiment_positive'].value=false;} ?>
//                                         var elem = $( this );
//                                         if ( elem.attr( "id" ).match("pos_sen")) {
//                                             alert("pos_sen");
//                                         }
////                                         alert("<?php $test = ($_SESSION['sentiment_positive'].value) ? 'true' : 'false'; echo $test ?>");
//                                         });
//             $("#toggle").click(function() {
//                 $("#newpost").toggle();
//             });
