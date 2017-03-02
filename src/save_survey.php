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

    $page = $_POST['page'];

    $controltype = $_POST['controltype'];

    $rrn = $_POST['realrandnone'];

	$dataArray = $_POST['selected'];

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

    $user_id = $_SESSION["user_id"];

    // $stmt = $db->prepare("INSERT INTO survey_responses (user_id, page, controltype, realrandnone, question1, question2, question3, question4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt = $db->prepare("INSERT INTO survey_responses (user_id, page, controltype, realrandnone, question1, question2, question3, question4, question5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE controltype = ?, realrandnone = ?, question1 = ?, question2 = ?, question3 = ?, question4 = ?, question5 = ? ");

    if ( false===$stmt ) {
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("sssssssssssssss", $user_id, $page, $controltype, $rrn, $q1,$q2,$q3,$q4,$q5,$controltype, $rrn, $q1,$q2,$q3,$q4,$q5);

    $rc2 = $stmt->bind_param("sssssssssssssss",  $user_id, $page, $controltype, $rrn, $q1,$q2,$q3,$q4,$q5,$controltype, $rrn, $q1,$q2,$q3,$q4,$q5);

    if ( false===$rc2 ) {
        // again execute() is useless if you can't bind the parameters. Bail out somehow.
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

    $q1 = (string)$dataArray[0];
    $q2 = (string)$dataArray[1];
    $q3= (string)$dataArray[2];
    $q4 = (string)$dataArray[3];
    $q5 = (string)$dataArray[4];

    $stmt->execute();
    $stmt->close();

    $db->close();

    header('Content-type: application/json');
    echo json_encode($dataArray);

    ?>
