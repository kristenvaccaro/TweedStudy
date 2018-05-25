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

//                      include 'src/printEachTweetInitial.php'; // Formatting for each tweet
                      include 'src/printTweets_SQL_min.php'; // Printing all tweets

                    
                  // Print tweets
                      printTweets_SQL_min();


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
                                <button class="btn" id="logout">Logout</button>
					</div>
								<hr>


								<br>
								<button id="nextstep" class="btn"> Next </button>


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
					var indexLocation = "/TweedStudy/index-01.php";
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

    };


    </script>
  </body>
</html>
