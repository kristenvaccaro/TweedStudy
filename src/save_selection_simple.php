<?php
	session_start();


// Import all functions
 include 'echoStatement.php';
	include 'printEachTweet.php';
	include 'printTweets_SQL.php';


//    var_dump($_SESSION['button']);

//    echo "\n";

//    echo $_POST['dataString'];



	$dataString = $_POST['dataString'];
	$value = $_POST['value'];
	$middle = $_POST['middle'];
  $page = $_POST['pageleaving'];

  echo $page;

    $_SESSION['dataString'] = $dataString;
    $_SESSION['value'] = $value;

    $user_id = $_SESSION["user_id"];

//    echo $_POST['dataString'];
//    echo $dataString;

	// printTweets_SQL_short();

      $servername = "engr-cpanel-mysql.engr.illinois.edu";
      $username = "twitterf_user";
      $password = "IIA@kT$7maLt";
      $dbname = "twitterf_tweet_store";

      $db = new mysqli($servername, $username, $password, $dbname);

      if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
      }

      $user_id = $_SESSION["user_id"];


      // $sql = "INSERT INTO survey_responses (user_id, page, test) VALUES (?,?,1)";

      // if(!$result = $db->query($sql)){
      //     die('There was an error running the query [' . $db->error . ']');
      // }

    $stmt = $db->prepare("INSERT INTO survey_responses (user_id, page, {$value}) VALUES (?,?,1) ON DUPLICATE KEY UPDATE {$value} = {$value} + 1");

    if ( false===$stmt ) {
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("ss", $user_id, $page);

    $rc2 = $stmt->bind_param("ss",  $user_id, $page);

    if ( false===$rc2 ) {
        // again execute() is useless if you can't bind the parameters. Bail out somehow.
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

      $stmt->execute();
      $stmt->close();

       $db->close();


?>
