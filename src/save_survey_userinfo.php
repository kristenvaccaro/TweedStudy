<?php
	session_start();

//    function console_log( $data ){
//        echo '<script>';
//        echo 'console.log('. json_encode( $data ) .')';
//        echo '</script>';
//    }

//    echo '<script language="javascript">';
//    echo 'alert("are we getting inside at all?")';
//    echo '</script>';

//    $uid = $_POST['userid'];

    $age = $_POST['age'];

    $gender = $_POST['gender'];

	$location = $_POST['location'];

//    echo '<script language="javascript">';
//    echo 'alert(' . (string)$dataArray[0] . ')';
//    echo '</script>';


    $servername = "engr-cpanel-mysql.engr.illinois.edu";
    $username = "twitterf_user";
    $password = "IIA@kT$7maLt";
    $dbname = "twitterf_tweet_store";

    $db = new mysqli($servername, $username, $password, $dbname);

    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $uid = $_SESSION["user_id"];
    $tid = $_SESSION["turker_id"];

    $stmt = $db->prepare("REPLACE INTO survey_responses_userinfo (user_id, turkerID, age, gender, location, code) VALUES (?, ?, ?, ?, ?, ?)");

    if ( false===$stmt ) {
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("isssss", $uid, $tid, $age, $gender, $location, $completion_code);

    $rc2 = $stmt->bind_param("isssss", $uid, $tid, $age, $gender, $location, $completion_code);
    $completion_code = uniqid();

    if ( false===$rc2 ) {
        // again execute() is useless if you can't bind the parameters. Bail out somehow.
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->execute();
    $stmt->close();

    $db->close();



    ?>
