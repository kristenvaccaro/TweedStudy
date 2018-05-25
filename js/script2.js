
    // Keeping Control Panel on screen
      jQuery(window).scroll(function() {
          jQuery('.totop').stop().animate({ right: '0px' });
      });


window.onload = function () {
  $("button").on('click', function( event ) {

                 //This is for Internet Explorer
                 var target = (event.target) ? event.target : event.srcElement;
                 var elem = $( this );
                 var dataString = elem.attr("id");
                 if(dataString == "yes" ){
                    $(this).parent().append('<a href="#">I\'m a new link</a>');
                                         return;
                                     }
                 else if (dataString == "unsure") {
                    
                    }
                    else if (dataString == "no") {
                    
                    }

                    
                    console.log(dataString);




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
             $("#toggle").click(function() {
                 $("#newpost").toggle();
             });
