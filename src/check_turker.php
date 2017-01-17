<?php

//This is to check whether the submitted TurkerID already existed in database
// include_once('webpage-utility/db_utility.php');
// $conn = connect_to_db();

// if($stmt = $conn->prepare('SELECT FeedbackID FROM Feedback WHERE turkerID = ?')){

// 	$stmt->bind_param('s', $_POST['turker']);
// }

// $stmt->execute();
// $res = $stmt->get_result();

// if(mysqli_num_rows($res) > 0){
// 	echo "exists";
// 	// $result = "exists";
// }
// else{
// 	echo "success";
// 	// $result = "success";
// }


// mysqli_close($conn);

// echo "success";

$tid = $_POST['turker'];

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

$sql = "SELECT user_id FROM `survey_responses_userinfo` WHERE turkerID = {$tid}";

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



// $stmt0 =

// $stmt = $db->prepare("INSERT INTO survey_responses_userinfo (user_id, age, gender, location) VALUES (?, ?, ?, ?)");

//     if ( false===$stmt ) {
//         die('prepare() failed: ' . htmlspecialchars($mysqli->error));
//     }

//     $stmt->bind_param("isss", $uid, $age, $gender, $location);

//     $rc2 = $stmt->bind_param("isss", $uid, $age, $gender, $location);

//     if ( false===$rc2 ) {
//         // again execute() is useless if you can't bind the parameters. Bail out somehow.
//         die('bind_param() failed: ' . htmlspecialchars($stmt->error));
//     }

//     $stmt->execute();
//     $stmt->close();

//     $db->close();


?>
