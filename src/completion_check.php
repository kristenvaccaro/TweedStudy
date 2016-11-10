<?php
	session_start();


    $servername = "engr-cpanel-mysql.engr.illinois.edu";
    $username = "twitterf_user";
    $password = "IIA@kT$7maLt";
    $dbname = "twitterf_tweet_store";

    $db = new mysqli($servername, $username, $password, $dbname);

    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $user_id = $_SESSION["user_id"];

    $sql = "SELECT count(page) FROM `survey_responses` WHERE question1<>'' and question2<>'' and question3<>'' and question4<>'' and user_id = {$user_id}";

    if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
    }

    if($result->num_rows === 0)
        {
            die('Empty');
        }
        else
        {
            while($row = $result->fetch_assoc()){
                $num_responses = $row['count(page)'];
            }
        }

        $dataArray = array();
        $dataArray['numCompleted']=$num_responses;
        $dataArray['completionCode']='Incomplete';
        if ($num_responses === '18') {
            $dataArray['completionCode']=uniqid();
        }

    $stmt = $db->prepare("REPLACE INTO survey_responses_userinfo (user_id, completion_code) VALUES (?, ?)");

    if ( false===$stmt ) {
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("is", $user_id, $dataArray['completionCode']);

    $rc2 = $stmt->bind_param("is", $user_id, $dataArray['completionCode']);

    if ( false===$rc2 ) {
        // again execute() is useless if you can't bind the parameters. Bail out somehow.
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->execute();
    $stmt->close();


    header('Content-type: application/json');
    echo json_encode($dataArray);
    // echo (string)$num_responses;

    ?>
