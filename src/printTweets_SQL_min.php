<?php
    session_start();
    
	function printTweets_SQL_min(){
        
        include 'src/printEachTweetInitial.php';

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


        $sql_syntax = "SELECT * FROM `data` WHERE user_id = {$user_id} ";


	    $sql = $sql_syntax . $sql_filter . "ORDER BY RAND() DESC LIMIT 10";

//		echo $sql;
	//Print each tweet
	    if(!$result = $db->query($sql)){
	        die('There was an error running the query [' . $db->error . ']');
	    }
        
        $count = 1;

        echo "<form>";
        
	    while($row = $result->fetch_assoc()){
            printEachTweetInitial($row,$count);
            $count += 1;
	    }
        
        echo "</form>";

	    $db->close();
	}
    
    
?>
