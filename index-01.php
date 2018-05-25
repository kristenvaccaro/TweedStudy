<?php
session_start();
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tweed Twitter Feed Research </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
		<script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
  <body>
  	<div class="container-fluid">
  		<div class="row-fluid">
        <!-- Twitter Feed -->
        <div class="col-xs-8" id="feed">
  				<?php
                  // Importing all functions
                      include 'src/saveToSQL.php'; // Save current user's tweets to SQL database
                      include 'src/toSQL/updateDataSQL.php';
                      include 'src/saveTrendsToSQL.php'; // Save trends for current user to DB
                      include 'src/getData.php'; // Fetch data and put it into cache
                      include 'src/printEachTweetInitial.php'; // Formatting for each tweet
                      include 'src/printTweets_SQL_min.php'; // Printing all tweets
                      include 'src/saveFriendsToSQL.php'; // Save friends
                      include 'src/computeFriendRank.php'; // As a second step, compute friend rank (need max friend num to do so)
                      include 'src/savedirectMessagesToSQL.php'; //Save direct messages
                      include 'src/mentionsToSQL.php'; // Save current user's mentions
                    // Resetting all session booleans
                  // Resetting all session booleans
                    
                    
                    echo "<p><b>INSTRUCTIONS</b><p>We have collected approximately 800 tweets from your Twitter home timeline. We will be showing you some of those tweets using different algorithms that we have developed. We will now ask you to look at them, use them for some time and then evaluate your experience.</p> <p>In the first interface, you will be shown one news feed that we developed and thought you might like.</p><p>Please imagine you are waiting for an appointment and use the interface as you might if you were waiting, for up to 5 minutes. When you are ready, click `Next' and we will ask you to answer some questions.</p>";
                    
                    
    

  				?>

  			</div>
        <!-- Control Panel -->
  			<div class="col-xs-4 totop">
          <!-- <button>Hide/Show</button> -->
          <div id="newpost">

						<div id="loginWrap">
			                <?php
			echo "<b>" . $_SESSION["user"]["screen_name"];
			echo "</b> <img src=" . $_SESSION['user']['profile_image_url'] . " alt='error'>";
			?>
											<a href="logout.php"><button class="btn" id="logout">Logout</button></a>
					</div>
								<hr>


								<br>
								<button id="nextstep" class="btn"> Next </button>

              <?php
                    // $servername = "engr-cpanel-mysql.engr.illinois.edu";
                    // $username = "twitterf_user";
                    // $password = "IIA@kT$7maLt";
                    // $dbname = "twitterf_tweet_store";
										//
                    // $userid = $_SESSION["user_id"];
                    // // Create connection
                    // $db = new mysqli($servername, $username, $password, $dbname);
										//
                    // // Check connection
                    // if ($db->connect_error) {
                    //     die("Connection failed: " . $conn->connect_error);
                    // }
										//
                    // // prepare and bind
                    // $sql = "SELECT * FROM trends WHERE user_id={$userid}";
                    // if(!$result = $db->query($sql)){
                    //     die('There was an error running the query [' . $db->error . ']');
                    // }
										//
                    // $trendsArray = array();
                    // while($row = $result->fetch_assoc()){
                    //     $trendsArray[]=$row['hashtag'];
                    // }
										//
                    // $subArray = array_rand($trendsArray, min(7, count($trendsArray)));
                    // foreach ($subArray as $ind) {
                    //     $trend = $trendsArray[$ind];
                    //     echo "&nbsp&nbsp&nbsp&nbsp<button class='astext' id='{$trend}'>{$trend}</button> <br>";
                    // }
                    ?>

  			</div>
  		</div>
  	</div>
<script type="text/javascript" src="js/highlighting.js"></script>
<script type="text/javascript" src="js/script2.js"></script>
    <script>
        // Keeping Control Panel on screen
          jQuery(window).scroll(function() {
              jQuery('.totop').stop().animate({ right: '0px' });
          });

    window.onload = function () {
			$("#nextstep").click(function(){
					var randomNumber = Math.floor((Math.random() * 3) + 1);
					var indexLocation = "/TweedStudy/index-1.php";
					var hostname = window.location.hostname;
					var url = "http://"+hostname + indexLocation
					window.location.href=url;
			});
        
        
        $("button").on('click', function( event ) {
                       
                       //This is for Internet Explorer
                       var target = (event.target) ? event.target : event.srcElement;
                       var elem = $( this );
                       var dataString = elem.attr("value");
                       var count = elem.attr("id").match(/\d+/);
                       if(dataString == "yes" ){
                        $( "#yes-" + count ).toggle();
//                       $(this).parent().append('<p>Why?</p>');
//                       $(this).parent().append('<form action=""> <input type="checkbox" name="why1" value="media">I like the attached media (photo/video/etc) <br><input type="checkbox" name="why1" value="funny">It is funny<br> <input type="checkbox" name="why1" value="person">I want to know what this person is doing</form> ');
//                       return;
                       }
                       else if (dataString == "unsure") {
                       
                       }
                       else if (dataString == "no") {
                       $( "#no-" + count ).toggle();
//                       $(this).parent().append('<p>Why not?</p>');
//                       $(this).parent().append('<form action=""> <input type="checkbox" name="whynot1" value="uninterested">Not interested in the content<br> <input type="checkbox" name="whynot1" value="dontunderstand">I don\'t understand the content<br><input type="checkbox" name="whynot1" value="uninterested">Don\'t know the people involved<br></form> ');
                       }
                       
                       
                       console.log(dataString);
                       
                       
                       
                       
                       return false;
                       });
        
        $("button.kristen").on('click', function( event ) {
                               $.ajax({
                                      type:'POST',
                                      url: "saveResponses_index.php",
                                      cache: false,
                                      data : $('form').serializeArray(),
                                      success: function(response) {
                                      console.log("success");
                                       alert(response);
//                                      window.location.href = response;
                                      },
                                      error: function(response){
                                      alert("ajax failure");
                                      }
                                      }).fail(function ( jqXHR, textStatus, errorThrown ) {
                                              console.log(jqXHR);
                                              console.log(textStatus);
                                              console.log(errorThrown);
                                              });
                               
                               
                               });
        
        //      $("button").on('click', function( event ) {
//
//                     //This is for Internet Explorer
//                     var target = (event.target) ? event.target : event.srcElement;
//                     var elem = $( this );
//                     var dataString = elem.attr("id");
//										 if(dataString == "nextstep" || dataString == "toggle" || dataString == "survey" || dataString == "logout"){
//											 return;
//										 }
//                     count = +target.dataset.count;
//
//                     var pairs = {};
//                     pairs['tweet_popular']= "tweet_unpopular";
//                     pairs['tweet_unpopular']= "tweet_popular";
//                     pairs['poster_infrequent']= 'poster_frequent';
//                     pairs['poster_frequent']= 'poster_infrequent';
//                     pairs['verified']= 'unverified';
//                     pairs['unverified']= 'verified';
//                     pairs['sentiment_positive']= 'sentiment_negative';
//                     pairs['sentiment_negative']= 'sentiment_positive';
//                     pairs['close_friends']= 'distant_friends';
//                     pairs['distant_friends']= 'close_friends';
//
//
////                      target.style.color = count === 1 ? '#323232' : '#000000';
////                      target.dataset.count = count === 1 ? 0 : 1;
////
//// //                     document.write(dataString, pairs[dataString]);
////
////                      var target2 = document.getElementById(pairs[dataString]);
//// //                     document.write(target2);
////                      target2.style.color = count === 1 ? '#D3D3D3' : '#000000';
////                      target2.dataset.count = count === 1 ? 0 : 1;
//
////
////                     $.ajax({
////
////                            type: "POST",
////                            url: "src/pass_value.php",
////                            data: { dataString: dataString },
////                            dataType: 'text',
////                            cache: false,
////                            success: function(response) {
////
////                            //alert(response);
////                            $("#feed").html(response);
////                            //document.getElementById("feed").innerHTML=xmlhttlp.response;
////
////                            }
////                            });
//
//                     return false;
//                      });

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
                 // $("button").click(function() {
                 //     $("#newpost").toggle();
                 // });
    </script>
  </body>
</html>
