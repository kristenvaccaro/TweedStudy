<?php
    session_start();
    
    
    // Import all functions
     include 'echoStatement.php';
    include 'printEachTweet.php';
    include 'printTweets_SQL.php';
    
    
    $dataString = $_POST['dataString'];
    $value = $_POST['value'];
    $middle = $_POST['middle'];
    
    $_SESSION['dataString'] = $dataString;
    $_SESSION['value'] = $value;
    
    printTweets_SQL_rand_short();
    ?>