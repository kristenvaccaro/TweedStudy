<?php
session_start();
// print_r($_SESSION);
    $userid = "123";
//    $source_website = $_SESSION['last_referrer_url'];
    
    $servername = "engr-cpanel-mysql.engr.illinois.edu";
    $username = "twitterf_user";
    $password = "IIA@kT$7maLt";
    $dbname = "twitterf_tweet_store";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
     $stmt = $conn->prepare("INSERT INTO responses_10tweets (userid) VALUES (?)");
    
    if ( false===$stmt ) {
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("s", $userid);


    # set the four variables (current version, somehow using get? or by passing data in the AJAX?)


    $stmt->execute();


    $stmt->close();

    //
    //
    //    $stmt = $conn->prepare("INSERT INTO responses_10tweets (user_id, tweet1_id, tweet1_yn, tweet1_why,tweet2_id, tweet2_yn, tweet2_why,tweet3_id, tweet3_yn, tweet3_why,tweet4_id, tweet4_yn, tweet4_why,tweet5_id, tweet5_yn, tweet5_why,tweet6_id, tweet6_yn, tweet6_why,tweet7_id, tweet7_yn, tweet7_why,tweet8_id, tweet8_yn, tweet8_why,tweet9_id, tweet9_yn, tweet9_why,tweet10_id, tweet10_yn, tweet10_why) VALUES (?, ?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?)");
    //
    //    if ( false===$stmt ) {
    //        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    //    }
    //
    //    $stmt->bind_param("sssssssssssssssssssssssssssssss", $userid, $t1, $tyn1, $twhy1,$t2, $tyn2, $twhy2,$t3, $tyn3, $twhy3,$t4, $tyn4, $twhy4,$t5, $tyn5, $twhy5,$t6, $tyn6, $twhy6,$t7, $tyn7, $twhy7,$t8, $tyn8, $twhy8,$t9, $tyn9, $twhy9,$t10, $tyn10, $twhy10);
    //
    //
    //    # set the four variables (current version, somehow using get? or by passing data in the AJAX?)
    //
    //
    //    $stmt->execute();
    //
    //
    //    $stmt->close();
    //
    //
    //    $conn->close();

    
    
    foreach($_POST as $key => $value)
    {
        preg_match('#(\d+)$#',$key,$matches);
        $count = $matches[1];
        $newstr = preg_replace("/\d+$/","",$key);
        if ($newstr == "why") {
            $yn = "yes";
        } else {
            $yn = "no";
        }
        
        
//        $why = $value;
        $why = "";
        
//        
//        foreach($value as $k => $v) {
//        foreach ($value as $v) {
//            $why += "," + $v;
//        }
        
        
        echo "keys are : ".$key;
//        echo "values are : ".$why;
        echo "values are : ".var_dump($value);
        
        $stmt = $conn->prepare("UPDATE responses_10tweets SET tweet".$count."_id = ?, tweet".$count."_yn = ?, tweet".$count."_why = ?  WHERE userid = ?");
        
        
        if ( false===$stmt ) {
            die('prepare() failed: ' . htmlspecialchars($mysqli->error));
        }
        
        $stmt->bind_param("ssss", $count, $yn, $why, $userid);
        
        
        # set the four variables (current version, somehow using get? or by passing data in the AJAX?)
        
        
        $stmt->execute();
        
        
        $stmt->close();
        
//        if (strstr($key, 'item'))
//        {
//            $x = str_replace('item','',$key);
//            inserttag($value, $x);
//        }
    }
    
    $conn->close();
    
//    $t1 = $_POST['q1'];
//    $t2 = $_POST['q2'];;
//

//
//
//    $conn = new mysqli($servername, $username, $password, $dbname);
//
//    // Check connection
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//
//
//    $stmt = $conn->prepare("INSERT INTO responses_10tweets (user_id, tweet1_id, tweet1_yn, tweet1_why,tweet2_id, tweet2_yn, tweet2_why,tweet3_id, tweet3_yn, tweet3_why,tweet4_id, tweet4_yn, tweet4_why,tweet5_id, tweet5_yn, tweet5_why,tweet6_id, tweet6_yn, tweet6_why,tweet7_id, tweet7_yn, tweet7_why,tweet8_id, tweet8_yn, tweet8_why,tweet9_id, tweet9_yn, tweet9_why,tweet10_id, tweet10_yn, tweet10_why) VALUES (?, ?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?)");
//
//    if ( false===$stmt ) {
//        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
//    }
//
//    $stmt->bind_param("sssssssssssssssssssssssssssssss", $userid, $t1, $tyn1, $twhy1,$t2, $tyn2, $twhy2,$t3, $tyn3, $twhy3,$t4, $tyn4, $twhy4,$t5, $tyn5, $twhy5,$t6, $tyn6, $twhy6,$t7, $tyn7, $twhy7,$t8, $tyn8, $twhy8,$t9, $tyn9, $twhy9,$t10, $tyn10, $twhy10);
//
//
//    # set the four variables (current version, somehow using get? or by passing data in the AJAX?)
//
//
//    $stmt->execute();
//
//
//    $stmt->close();
//
//
//    $conn->close();
//
//
//    // "success"
//
//    // print_r($_SESSION["index"]);
//
//    $feedsLeft = -1; $indexesLeft = array();
//    foreach($_SESSION["index"] as $number => $visited){
//      if(!$visited){
//        array_push($indexesLeft, $number);
//        $feedsLeft++;
//      }
//    }
//    // print_r($feedsLeft);
//    // print_r($indexesLeft);
//    $randomNumber = rand(0, $feedsLeft);
//    $indexNumber = $indexesLeft[$randomNumber];
//    echo "http://twitterfeed.web.engr.illinois.edu/TweedStudy/index-".$indexNumber.".php";
?>
