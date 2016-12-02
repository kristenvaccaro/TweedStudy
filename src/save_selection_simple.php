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
  $page = $_POST['value'];

  echo $page;

    $_SESSION['dataString'] = $dataString;
    $_SESSION['value'] = $value;

//    echo $_POST['dataString'];
//    echo $dataString;

	// printTweets_SQL_short();
?>
