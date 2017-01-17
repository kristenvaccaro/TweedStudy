<?php

//This is to check whether the submitted TurkerID already existed in database
include_once('webpage-utility/db_utility.php');
$conn = connect_to_db();

if($stmt = $conn->prepare('SELECT FeedbackID FROM Feedback WHERE turkerID = ?')){

	$stmt->bind_param('s', $_POST['turker']);
}

$stmt->execute();
$res = $stmt->get_result();

if(mysqli_num_rows($res) > 0){
	echo "exists";
	// $result = "exists";
}
else{
	echo "success";
	// $result = "success";
}


mysqli_close($conn);

?>
