<?php

session_start();

$tid = $_POST['turker'];

// echo $tid;

$_SESSION['turker_id'] =  $tid;

$servername = "engr-cpanel-mysql.engr.illinois.edu";
$username = "twitterf_user";
$password = "IIA@kT$7maLt";
$dbname = "twitterf_tweet_store";

$db = new mysqli($servername, $username, $password, $dbname);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$uid = $_SESSION["user_id"];

// $sql = "SELECT user_id FROM `survey_responses_userinfo`";

$sql = "SELECT user_id FROM survey_responses_userinfo WHERE turkerID={$tid}";


// $sql = "SELECT user_id FROM `survey_responses_userinfo` WHERE turkerID = {$tid}";

if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
}

if($result->num_rows === 0)
    {
        echo "success";
    }
    else
    {
        echo "exists";
    }

// echo "success";

?>
