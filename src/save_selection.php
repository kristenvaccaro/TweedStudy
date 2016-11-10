<?php
	session_start();


// Import all functions
 // include 'echoStatement.php';
	// include 'printEachTweet.php';
	// include 'printTweets_SQL.php';


//    var_dump($_SESSION['button']);

//    echo "\n";

//    echo $_POST['dataString'];



	$dataString = $_POST['dataString'];
	$value = $_POST['value'];
	$middle = $_POST['middle'];


  //SQL Authorization
      $servername = "engr-cpanel-mysql.engr.illinois.edu";
      $username = "twitterf_user";
      $password = "IIA@kT$7maLt";
      $dbname = "twitterf_tweet_store";

      $db = new mysqli($servername, $username, $password, $dbname);

      if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
      }

      $user_id = $_SESSION["user_id"];


      $sql = "UPDATE survey_responses SET " . $value . " = " . $value . " + 1";

      if(!$result = $db->query($sql)){
          die('There was an error running the query [' . $db->error . ']');
      }

        if($result->num_rows === 0)
        {
            echo 'There are no tweets in your feed for this selection';
        }
        else
        {
            while($row = $result->fetch_assoc()){
                printEachTweet($row);
            }
        }

      $db->close();

//     $_SESSION['dataString'] = $dataString;
//     $_SESSION['value'] = $value;

// //    echo $_POST['dataString'];
// //    echo $dataString;

// 	printTweets_SQL_short();
?>
