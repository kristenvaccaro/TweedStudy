<?php
session_start();
header('Access-Control-Allow-Origin: *');
// print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tweed Twitter Feed Research </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
 <link rel="stylesheet" type="text/css" href="css/survey.css">
		<script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
  <body>

  	<div class="container-fluid">
  		<div class="row-fluid">
        <!-- Twitter Feed -->
        <div class="col-xs-8" id="feed">
  				<?php

                  include 'index-firstSurvey.php';

                  ?>

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
									$_SESSION['button']['only_links'] = false;
									$_SESSION['button']['no_links'] = false;
									$_SESSION['button']['only_retweets'] = false;
									$_SESSION['button']['no_retweets'] = false;
									$_SESSION['button']['tweet_popular'] = false;
									$_SESSION['button']['tweet_unpopular'] = false;
									$_SESSION['button']['poster_frequent'] = false;
									$_SESSION['button']['poster_infrequent'] = false;
									$_SESSION['button']['verified'] = false;
									$_SESSION['button']['unverified'] = false;
									$_SESSION['button']['sentiment_positive'] = false;
									$_SESSION['button']['sentiment_negative'] = false;
									$_SESSION['button']['close_friends'] = false;
									$_SESSION['button']['distant_friends'] = false;
									$_SESSION['button']['only_videos'] = false;
									$_SESSION['button']['no_videos'] = false;
									$_SESSION['button']['only_text'] = false;
									$_SESSION['button']['no_text'] = false;
									$_SESSION['button']['only_pics'] = false;
									$_SESSION['button']['no_pics'] = false;

                      if ((!isset($_SESSION['data_in_db'])) || ($_SESSION['data_in_db'])=='') {
                          $_SESSION['data_in_db'] = false;
                      }

                      function controlPanel() {
                      }

                  // Authorization
                      include 'src/authorization.php';

//                     echo "<p>While we collect information from Twitter, please complete the initial survey.</p>";
//
//                      echo "<br>";

                  //SaveToSQL if data_in_db is false
                      if ((!isset($_SESSION['data_in_db'])) || ($_SESSION['data_in_db'])== false) {
                          $_SESSION['data_in_db'] = true;


												// Initialize $next_max_id and $cursor variable
													$next_max_id = null;
													$cursor = null;

//													echo "The if statement is true, now paging through tweets. <br>";
												// While there are still tweets, run saveToSQL
													// saveToSQL($connection, $next_max_id_temp);
													while(true){
//														echo "The tweet while statement is true <br>";
													// Preserve previously recieved cursor
														$next_max_id_temp = $next_max_id;
													// Run saveToSQL and store return array into $return_array
														$next_max_id = saveToSQL($connection, $next_max_id_temp);

														$next_max_id_str = (string) $next_max_id;
//														echo "The next_max_id is " . $next_max_id_str . "<br>";

														if($next_max_id == $next_max_id_temp || $next_max_id == null){
															break;
														}
													}

//                          echo "Updating data in DB<br>";
                          updateDataSQL();

//                          echo "Saving trends now <br>";
                          // saveTrendsToSQL($connection);
//                          echo "Saving DMs now <br>";
                          // savedirectMessagesToSQL($connection);
//                          echo "Saving mentions now <br>";
                          // mentionsToSQL($connection);

//                          echo "Direct messages saved, now paging through friends. <br>";
                          $_SESSION["rank_counter"] = 0;
                          while(true){
//                              echo "The friends while statement is true <br>";
                              $cursor_temp = $cursor;
                              $cursor = saveFriendsToSQL($connection, $cursor_temp);
                              $cursor_str = (string) $cursor;
//                              echo "The cursor is " . $cursor_str . "<br>";
                              if($cursor == $cursor_temp || $cursor == null){
                                  $_SESSION["rank_counter"]--;
                                  break;
                              }
                          }
                          unset($_SESSION["rank_counter"]);

//                          echo "Computing and saving computed friend rank";
                          // computeFriendRank();


												// saveToSQL($connection, $user, $last_max_id);

                      }



                  // Print tweets


									// Set Session booleans for index-visited
									$_SESSION["index"][1] = false;
									$_SESSION["index"][2] = false;
									$_SESSION["index"][3] = false;

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

                <script type="text/javascript"> $("img").css('display', 'none'); </script>
  			  </div>
  		</div>
  	</div>
<script type="text/javascript" src="js/highlighting.js"></script>
<script type="text/javascript" src="js/script2.js"></script>
    <script>
        // // Keeping Control Panel on screen
        //   jQuery(window).scroll(function() {
        //       jQuery('.totop').stop().animate({ right: '0px' });
        //   });

    $(document).ready(function () {
			$("#nextstep").click(function(){


                    $userid = <?php echo $_SESSION["user_id"]; ?>;

                    $e = document.getElementById("dob-year");
                    $age = $e.options[$e.selectedIndex].value;

                    $e = document.getElementById("gender");
                    $gender = $e.options[$e.selectedIndex].value;

                    $e = document.getElementById("state");
                    $location = $e.options[$e.selectedIndex].value;

                    $e = document.getElementById("filtering");
                    $filtering = $e.options[$e.selectedIndex].value;

                    $.ajax({
                                        type: "POST",
                                        url:"src/save_survey_userinfo.php", //$('input[name=likert-'+$pageleaving+'-1]:checked').val()
                                        data: {userid: $userid, age: $age, gender: $gender, location: $location, filtering: $filtering},
                                        dataType: 'text',
                                        async: true,
                                        cache: false,
                                        success: function(response) {
                                          console.log('successfully saved demographic info');
                                          var randomNumber = Math.floor((Math.random() * 3) + 1);
                                          var indexLocation = "/TweedStudy/index-00.php";
                                          var hostname = window.location.hostname;
                                          var url = "http://"+hostname + indexLocation;
                                          window.location.href=url;

                                        },
                                        error:function(exception){
                                              console.log(exception);
                                              $(document.getElementById("surveysection")).html("<h2><a href='http://twitterfeed.web.engr.illinois.edu/TweedStudy/twitter.php'>There was an error while saving your data. Please return to the start page (by clicking on this text) to try again</a></h2>");

                                        }

                                        });





			});
    });




    </script>
  </body>
</html>
