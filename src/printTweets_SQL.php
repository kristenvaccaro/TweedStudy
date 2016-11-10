<?php


	function printTweets_SQL(){

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

//			var_dump($_SESSION['button']);

	//Retrieve session booleans
			$only_links_bool = $_SESSION['button']['only_links'];
			$no_links_bool = $_SESSION['button']['no_links'];
			$only_text_bool = $_SESSION['button']['only_text'];
			$no_text_bool = $_SESSION['button']['no_text'];
			$only_pics_bool = $_SESSION['button']['only_pics'];
			$no_pics_bool = $_SESSION['button']['no_pics'];
			$only_videos_bool = $_SESSION['button']['only_videos'];
			$no_videos_bool = $_SESSION['button']['no_videos'];
			$only_retweets_bool = $_SESSION['button']['only_retweets'];
			$no_retweets_bool = $_SESSION['button']['no_retweets'];
			$popular_bool = $_SESSION['button']['tweet_popular'];
			$unpopular_bool = $_SESSION['button']['tweet_unpopular'];
			$frequent_bool = $_SESSION['button']['poster_frequent'];
			$infrequent_bool = $_SESSION['button']['poster_infrequent'];
			$verified_bool = $_SESSION['button']['verified'];
			$unverified_bool = $_SESSION['button']['unverified'];
			$sentimentPos_bool = $_SESSION['button']['sentiment_positive'];
			$sentimentNeg_bool = $_SESSION['button']['sentiment_negative'];
			$closeFriends_bool = $_SESSION['button']['close_friends'];
			$distantFriends_bool = $_SESSION['button']['distant_friends'];
			$distanceSlider = $_SESSION['button']['distanceSlider'];
			$distanceSliderValue = $_SESSION['button']['distanceSliderValue'];
			$frequencySlider = $_SESSION['button']['frequencySlider'];
			$frequencySliderValue = $_SESSION['button']['frequencySliderValue'];
			$popularitySlider = $_SESSION['button']['popularitySlider'];
			$popularitySliderValue = $_SESSION['button']['popularitySliderValue'];
			$sessionArray = ['only_links', 'no_links', 'only_text', 'no_text','only_pics','no_pics', 'popularitySlider', 'popularitySliderValue',  'frequencySlider', 'frequencySliderValue', 'distanceSlider', 'distanceSliderValue', 'only_retweets', 'no_retweets', 'only_videos', 'no_videos', 'tweet_popular','tweet_unpopular','poster_frequent','poster_infrequent','verified','unverified','sentiment_positive','sentiment_negative','close_friends','distant_friends'];
//			echo "<br>";
//        foreach ($_SESSION['button'] as $key=>$val) {
//            if (! in_array( $key, $sessionArray )) {
//                $trend_bool = $val;
//                $trend_name = $key;
//								var_dump($trend_bool); echo "{$trend_name} <br>";
//								if($trend_bool){
//									echo "break";
//									break;
//								}
//            }
//
//        }
//
//		echo $popularitySlider."<br>";
//		echo $popularitySliderValue."<br>";


        $fixdistance = $_SESSION["min_real_rank"] + $distanceSliderValue * ($_SESSION["max_real_rank"]- $_SESSION["min_real_rank"]);
        $fixfreq = $_SESSION["min_real_freq"] + $frequencySliderValue * ($_SESSION["max_real_freq"]- $_SESSION["min_real_freq"]);
        $fixpopular = $_SESSION["min_real_popular"] + $popularitySliderValue * ($_SESSION["max_real_popular"]- $_SESSION["min_real_popular"]);


//        echo $popularitySliderValue * ($_SESSION["max_real_popular"]- $_SESSION["min_real_popular"])."<br>";


	    // (user_id, tweet_text, tweet_popularity, poster_frequency, verified, sentiment, user_url, user_profile_img_url, user_screen_name, tweet_create_date, tweet_urls, tweet_images, tweet_hashtags)


			// Execute two different base SQL syntaxes depending on if where care about closeness.

	//Create array of booleans and their corresponding statement
       $sql_filter_statements = array(
									"closeFriends_bool" => array($closeFriends_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`rank` > (SELECT max(`rank`) FROM `friends` WHERE `user_id` = {$user_id})/2 "),
									"distantFriends_bool" => array($distantFriends_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`rank` < (SELECT max(`rank`) FROM `friends` WHERE `user_id` = {$user_id})/2 "),
									"closeFriends_bool" => array($closeFriends_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`computed_rank` > 0 "),
                  "distantFriends_bool" => array($distantFriends_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`computed_rank` < 0 "),
									"only_links" => array($only_links_bool, "AND link = 1 "),
									"no_links" => array($no_links_bool, "AND link = 0 "),
									"only_retweets" => array($only_retweets_bool, "AND retweet = 1 "),
									"no_retweets" => array($no_retweets_bool, "AND retweet = 0 "),
									"only_text" => array($only_text_bool, "AND video = 0 AND picture = 0 "),
									"no_text" => array($no_text_bool, "AND tweet_text = '' "),
									"only_pics" => array($only_pics_bool, "AND picture = 1 "),
									"no_pics" => array($no_pics_bool, "AND picture = 0 "),
									"only_videos" => array($only_videos_bool, "AND video = 1 "),
									"no_videos" => array($no_videos_bool, "AND video = 0 "),
									"popular_bool" => array($popular_bool, "AND tweet_popularity > 10 "),
									"unpopular_bool" => array($unpopular_bool, "AND tweet_popularity < 10 "),
									"frequent_bool" => array($frequent_bool, "AND poster_frequency > 1000 "),
									"infrequent_bool" => array($infrequent_bool, "AND poster_frequency < 1000 "),
									"verified_bool" => array($verified_bool, "AND `data`.`verified` = 1 "),
									"unverified_bool" => array($unverified_bool, "AND `data`.`verified` = 0 "),
									"sentimentPos_bool" => array($sentimentPos_bool, "AND sentiment > 0 "),
									"sentimentNeg_bool" => array($sentimentNeg_bool, "AND sentiment < 0 "),
                  					"trend_bool" => array($trend_bool, "AND tweet_text LIKE  '%{$trend_name}%' "),
           );
//         echo "distance slider value: ".$distanceSliderValue."<br>";
		if($distanceSliderValue !== 0.501){
			if($distanceSliderValue > .5){
                $fixdistance=$fixdistance-.006;
//                echo "are we getting here?";
				$sql_filter_statements["closeFriends_bool"][1] = "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`computed_rank` > ".$fixdistance." ";
			}
			elseif($distanceSliderValue < .5){
//                echo "are we getting here? 2";
                $fixdistance=$fixdistance+.006;
				$sql_filter_statements["closeFriends_bool"][1] = "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`computed_rank` < ".$fixdistance." ";
			}
		}

		if($frequencySliderValue !== .501){
			if($frequencySliderValue > .5){
				$sql_filter_statements["frequent_bool"][1] = "AND poster_frequency > ".$fixfreq." ";
			}elseif($frequencySliderValue < .5){
				$sql_filter_statements["frequent_bool"][1] = "AND poster_frequency < ".$fixfreq." ";
			}
		}

//        echo "popularity slider value: ".$popularitySliderValue."<br>";
		if($popularitySliderValue !== .501){
//			echo $popularitySliderValue.$_POST['middle']."<br>";
			if($popularitySliderValue > .5){
				$sql_filter_statements["popular_bool"][1] = "AND tweet_popularity > ".$fixpopular." ";
			}elseif($popularitySliderValue < .5){
//                echo "are we getting inside? where popularity slider value: ".$popularitySliderValue."<br>";
				$sql_filter_statements["popular_bool"][1] = "AND tweet_popularity < ".$fixpopular." ";
			}
		}

	// Initalize filter statement
       $sql_filter = "";

    // Check each boolean then add statement if true
       foreach($sql_filter_statements as $statement){
           if ($statement[0]){
               $sql_filter .= $statement[1];
           }
       }

//	    echo 'USERID IS ' . $user_id . "<br>";
	//Compose statement
		if($closeFriends_bool || $distantFriends_bool){
			$sql_syntax = "SELECT * FROM `data` ";
		}
		else{
			$sql_syntax = "SELECT * FROM `data` WHERE user_id = {$user_id} ";
		}

	    $sql = $sql_syntax . $sql_filter . "ORDER BY tweet_id DESC LIMIT 600";

		// echo $sql;
	//Print each tweet
	    if(!$result = $db->query($sql)){
	        die('There was an error running the query [' . $db->error . ']');
	    }

        if($result->num_rows === 0)
        {
            echo 'There are no tweets in your feed for this selection';
        }
        else
        {
            while($row = $result->fetch_assoc()){
                printEachTweet($row);
            }
        }

	    $db->close();
	}


    function printTweets_SQL_short(){

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

        //			var_dump($_SESSION['button']);

        // echo $_SESSION['dataString'];
        // echo $_SESSION['value'];

        $distanceSliderValue = 0.501;
        $popularitySliderValue = 0.501;

        //Retrieve session booleans

        $dataString = $_SESSION['dataString'];
        $value = $_SESSION['value'];

        if (strpos($dataString, 'distance') !== false) {
            $_SESSION['button']['distanceSlider'] = 'true';
            $distanceSlider = $_SESSION['button']['distanceSlider'];
            $distanceSliderValue = $value;
            $closeFriends_bool = "true";
        } elseif (strpos($dataString, 'popularity') !== false) {
          $_SESSION['button']['popularitySlider'] = 'true';
          $popularitySlider = $_SESSION['button']['popularitySlider'];
          $popularitySliderValue = $value;
          $popular_bool = "true";
        }

//        $distanceSlider = $_SESSION['button']['distanceSlider'];
//        $distanceSliderValue = $_SESSION['button']['distanceSliderValue'];
//
//        $popularitySlider = $_SESSION['button']['popularitySlider'];
//        $popularitySliderValue = $_SESSION['button']['popularitySliderValue'];

        $sessionArray = ['popularitySlider', 'popularitySliderValue', 'distanceSlider', 'distanceSliderValue'];

        /// first figure out what the 1/4, 1/2 and 3/4 pts are
        /// CLOSENESS

        $allranks = $_SESSION["real_ranks"];

        foreach ($allranks as $thisrank) {
            $values_close[] =  $thisrank;
        }
        $count_close = count($values_close);

        $firstind_close = round( .3 * ( $count_close + 1 ) ) - 1;
        $secondind_close = round( .5 * ( $count_close + 1 ) ) - 1;
        $thirdind_close = round( .7 * ( $count_close + 1 ) ) - 1;

        $first_close = (float)$values_close[$firstind_close];
        $second_close = (float)$values_close[$secondind_close];
        $third_close = (float)$values_close[$thirdind_close];

        /// POPULARITY

        $allpopularity = $_SESSION["real_popularity"];

        foreach ($allpopularity as $thisrank) {
            $values_popularity[] =  $thisrank;
        }
        $count_popularity = count($values_popularity);

        $firstind_popularity = round( .3 * ( $count_popularity + 1 ) ) - 1;
        $secondind_popularity = round( .5 * ( $count_popularity + 1 ) ) - 1;
        $thirdind_popularity = round( .7 * ( $count_popularity + 1 ) ) - 1;

        $first_popularity = (float)$values_popularity[$firstind_popularity];
        $second_popularity = (float)$values_popularity[$secondind_popularity];
        $third_popularity = (float)$values_popularity[$thirdind_popularity];

        // get current values from sliders

        $distanceSliderValue = (float)$distanceSliderValue;
        $popularitySliderValue = (float)$popularitySliderValue;

//        echo $distanceSliderValue;
//        echo $popularitySliderValue;

//        var_dump($distanceSliderValue);

        /// then assign each of those points to the fixdistance variable

        $fixdistance = 0;
        $fixpopular = 0;

        if ($distanceSliderValue < .2) {
            $fixdistance = $first_close;
        } elseif (($distanceSliderValue > .2) and ($distanceSliderValue < .8)) {
            $fixdistance = $second_close;
        }
        elseif ($distanceSliderValue > .8) {
            $fixdistance = $third_close;
            // echo $fixdistance;
        }

//        var_dump($popularitySliderValue);

        /// then assign each of those points to the fixdistance variable
        if ($popularitySliderValue < .2) {
            $fixpopular = $first_popularity;
        } elseif (($popularitySliderValue > .2) and ($popularitySliderValue < .8)) {
            $fixpopular = $second_popularity;
        }
        elseif ($popularitySliderValue > .8) {
            $fixpopular = $third_popularity;
        }

//        var_dump($first_popularity);
//        var_dump($second_popularity);
//        var_dump($third_popularity);

//        echo $first_close;
        // echo $popularitySliderValue;
        // echo "what is going on here";
        // echo $fixpopular;
//        echo $third_close;
//        echo $fixdistance;


        // Execute two different base SQL syntaxes depending on if where care about closeness.

        //Create array of booleans and their corresponding statement
        $sql_filter_statements = array(
                                       "closeFriends_bool" => array($closeFriends_bool, " "),
                                       "popular_bool" => array($popular_bool, " "),
                                       );

        if($distanceSliderValue !== 0.501){
            if($distanceSliderValue > .5){
                //                echo "are we getting here?";
                $sql_filter_statements["closeFriends_bool"][1] = "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`computed_rank` > ".$fixdistance." ";
            }
            elseif($distanceSliderValue < .5){
                //                echo "are we getting here? 2";
                $sql_filter_statements["closeFriends_bool"][1] = "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`computed_rank` < ".$fixdistance." ";
            }
        }

        //        echo "popularity slider value: ".$popularitySliderValue."<br>";
        if($popularitySliderValue !== .501){
            //			echo $popularitySliderValue.$_POST['middle']."<br>";
            if($popularitySliderValue > .5){
                $sql_filter_statements["popular_bool"][1] = "AND tweet_popularity > ".$fixpopular." ";
            }elseif($popularitySliderValue < .5){
                //                echo "are we getting inside? where popularity slider value: ".$popularitySliderValue."<br>";
                $sql_filter_statements["popular_bool"][1] = "AND tweet_popularity < ".$fixpopular." ";
            }
        }

        // Initalize filter statement
        $sql_filter = "";

        // Check each boolean then add statement if true
        foreach($sql_filter_statements as $statement){
            if ($statement[0]){
                $sql_filter .= $statement[1];
            }
        }

        //	    echo 'USERID IS ' . $user_id . "<br>";
        //Compose statement
        if($closeFriends_bool || $distantFriends_bool){
            $sql_syntax = "SELECT * FROM `data` ";
        }
        else{
            $sql_syntax = "SELECT * FROM `data` WHERE user_id = {$user_id} ";
        }

        $sql = $sql_syntax . $sql_filter . "ORDER BY tweet_id DESC LIMIT 10";

        // echo $sql;
        //Print each tweet
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }

        if($result->num_rows === 0)
        {
            echo 'There are no tweets in your feed for this selection';
        }
        else
        {
            while($row = $result->fetch_assoc()){
                printEachTweet($row);
            }
        }

        $db->close();
    }


    function printTweets_SQL_rand(){

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

//        var_dump($_SESSION['button']);

        //Retrieve session booleans
        $only_links_bool = $_SESSION['button']['only_links'];
        $no_links_bool = $_SESSION['button']['no_links'];
        $only_text_bool = $_SESSION['button']['only_text'];
        $no_text_bool = $_SESSION['button']['no_text'];
        $only_pics_bool = $_SESSION['button']['only_pics'];
        $no_pics_bool = $_SESSION['button']['no_pics'];
        $only_videos_bool = $_SESSION['button']['only_videos'];
        $no_videos_bool = $_SESSION['button']['no_videos'];
        $only_retweets_bool = $_SESSION['button']['only_retweets'];
        $no_retweets_bool = $_SESSION['button']['no_retweets'];
        $popular_bool = $_SESSION['button']['tweet_popular'];
        $unpopular_bool = $_SESSION['button']['tweet_unpopular'];
        $frequent_bool = $_SESSION['button']['poster_frequent'];
        $infrequent_bool = $_SESSION['button']['poster_infrequent'];
        $verified_bool = $_SESSION['button']['verified'];
        $unverified_bool = $_SESSION['button']['unverified'];
        $sentimentPos_bool = $_SESSION['button']['sentiment_positive'];
        $sentimentNeg_bool = $_SESSION['button']['sentiment_negative'];
        $closeFriends_bool = $_SESSION['button']['close_friends'];
        $distantFriends_bool = $_SESSION['button']['distant_friends'];
        $distanceSlider = $_SESSION['button']['distanceSlider'];
        $distanceSliderValue = $_SESSION['button']['distanceSliderValue'];
        $frequencySlider = $_SESSION['button']['frequencySlider'];
        $frequencySliderValue = $_SESSION['button']['frequencySliderValue'];
        $popularitySlider = $_SESSION['button']['popularitySlider'];
        $popularitySliderValue = $_SESSION['button']['popularitySliderValue'];
        $sessionArray = ['only_links', 'no_links', 'only_text', 'no_text','only_pics','no_pics', 'popularitySlider', 'popularitySliderValue',  'frequencySlider', 'frequencySliderValue', 'distanceSlider', 'distanceSliderValue', 'only_retweets', 'no_retweets', 'only_videos', 'no_videos', 'tweet_popular','tweet_unpopular','poster_frequent','poster_infrequent','verified','unverified','sentiment_positive','sentiment_negative','close_friends','distant_friends'];
//        echo "<br>";
//        foreach ($_SESSION['button'] as $key=>$val) {
//            if (! in_array( $key, $sessionArray )) {
//                $trend_bool = $val;
//                $trend_name = $key;
//                var_dump($trend_bool); echo "{$trend_name} <br>";
//                if($trend_bool){
//                    echo "break";
//                    break;
//                }
//            }
//
//        }
//
//        echo $frequencySlider."<br>";
//        echo $frequencySliderValue."<br>";
//        echo $_SESSION["min_fake_freq"]."<br>";
//        echo $_SESSION["max_fake_freq"]."<br>";


        $fixdistance = $_SESSION["min_fake_rank"] + $distanceSliderValue * ($_SESSION["max_fake_rank"]- $_SESSION["min_fake_rank"]);
        $fixfreq = $_SESSION["min_fake_freq"] + $frequencySliderValue * ($_SESSION["max_fake_freq"]- $_SESSION["min_fake_freq"]);
        $fixpopular = $_SESSION["min_fake_popular"] + $popularitySliderValue * ($_SESSION["max_fake_popular"]- $_SESSION["min_fake_popular"]);


//        echo $frequencySliderValue * ($_SESSION["max_fake_freq"]- $_SESSION["min_fake_freq"])."<br>";


        // (user_id, tweet_text, tweet_popularity, poster_frequency, verified, sentiment, user_url, user_profile_img_url, user_screen_name, tweet_create_date, tweet_urls, tweet_images, tweet_hashtags)


        // Execute two different base SQL syntaxes depending on if where care about closeness.

        //Create array of booleans and their corresponding statement
        $sql_filter_statements = array(
                                       //									"closeFriends_bool" => array($closeFriends_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`rank` > (SELECT max(`rank`) FROM `friends` WHERE `user_id` = {$user_id})/2 "),
                                       //									"distantFriends_bool" => array($distantFriends_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`rank` < (SELECT max(`rank`) FROM `friends` WHERE `user_id` = {$user_id})/2 "),
                                       "closeFriends_bool" => array($closeFriends_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`computed_rank` > 0 "),
                                       "distantFriends_bool" => array($distantFriends_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`computed_rank` < 0 "),
                                       "only_links" => array($only_links_bool, "AND link = 1 "),
                                       "no_links" => array($no_links_bool, "AND link = 0 "),
                                       "only_retweets" => array($only_retweets_bool, "AND retweet = 1 "),
                                       "no_retweets" => array($no_retweets_bool, "AND retweet = 0 "),
                                       "only_text" => array($only_text_bool, "AND video = 0 AND picture = 0 "),
                                       "no_text" => array($no_text_bool, "AND tweet_text = '' "),
                                       "only_pics" => array($only_pics_bool, "AND picture = 1 "),
                                       "no_pics" => array($no_pics_bool, "AND picture = 0 "),
                                       "only_videos" => array($only_videos_bool, "AND video = 1 "),
                                       "no_videos" => array($no_videos_bool, "AND video = 0 "),
                                       "popular_bool" => array($popular_bool, "AND tweet_popularity > 10 "),
                                       "unpopular_bool" => array($unpopular_bool, "AND tweet_popularity < 10 "),
                                       "frequent_bool" => array($frequent_bool, "AND poster_frequency > 1000 "),
                                       "infrequent_bool" => array($infrequent_bool, "AND poster_frequency < 1000 "),
                                       "verified_bool" => array($verified_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`fake_verified` = 1 "),
                                       "unverified_bool" => array($unverified_bool, "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`fake_verified` = 0 "),
                                       "sentimentPos_bool" => array($sentimentPos_bool, "AND fake_sentiment > 0 "),
                                       "sentimentNeg_bool" => array($sentimentNeg_bool, "AND fake_sentiment < 0 "),
                                       "trend_bool" => array($trend_bool, "AND tweet_text LIKE  '%{$trend_name}%' "),
                                       );
//        echo $fixdistance."<br>";
        if($distanceSliderValue !== 0.501){
            if($distanceSliderValue > .5){
                $fixdistance=$fixdistance-.01;
                $sql_filter_statements["closeFriends_bool"][1] = "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `data`.`user_id` = {$user_id} AND `friends`.`fake_comp_rank` > ".$fixdistance." ";
            }
            elseif($distanceSliderValue < .5){
                $fixdistance=$fixdistance+.01;
                $sql_filter_statements["closeFriends_bool"][1] = "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `data`.`user_id` = {$user_id} AND `friends`.`fake_comp_rank` < ".$fixdistance." ";
            }
        }

        if($frequencySliderValue !== .501){
            if($frequencySliderValue > .5){
                $sql_filter_statements["frequent_bool"][1] = "AND fake_poster_frequency > ".$fixfreq." ";
            }elseif($frequencySliderValue < .5){
                $sql_filter_statements["frequent_bool"][1] = "AND fake_poster_frequency < ".$fixfreq." ";
            }
        }

        if($popularitySliderValue !== .501){
//            echo $popularitySliderValue.$_POST['middle']."<br>";
            if($popularitySliderValue > .5){
                $sql_filter_statements["popular_bool"][1] = "AND fake_popularity > ".$fixpopular." ";
            }elseif($popularitySliderValue < .5){
                $sql_filter_statements["popular_bool"][1] = "AND fake_popularity < ".$fixpopular." ";
            }
        }

        // Initalize filter statement
        $sql_filter = "";

        // Check each boolean then add statement if true
        foreach($sql_filter_statements as $statement){
            if ($statement[0]){
                $sql_filter .= $statement[1];
            }
        }

//        echo 'USERID IS ' . $user_id . "<br>";
        //Compose statement
        if($closeFriends_bool || $distantFriends_bool || $verified_bool || $unverified_bool){
            $sql_syntax = "SELECT * FROM `data` ";
        }
        else{
            $sql_syntax = "SELECT * FROM `data` WHERE user_id = {$user_id} ";
        }

        $sql = $sql_syntax . $sql_filter . "ORDER BY tweet_id DESC LIMIT 600";

        // echo $sql;
        //Print each tweet
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }


        if($result->num_rows === 0)
            {
                echo 'There are no tweets in your feed for this selection';
            }
            else
            {
            while($row = $result->fetch_assoc()){
//                printEachTweet($row);
            }
            }

        $db->close();

//        echo "<script type='text/javascript'>alert('$sql');</script>";
    }


    function printTweets_SQL_rand_short(){


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

        //			var_dump($_SESSION['button']);

        // echo $_SESSION['dataString'];
        // echo $_SESSION['value'];

        $distanceSliderValue = 0.501;
        $popularitySliderValue = 0.501;

        //Retrieve session booleans

        $dataString = $_SESSION['dataString'];
        $value = $_SESSION['value'];

        if (strpos($dataString, 'distance') !== false) {
            $_SESSION['button']['distanceSlider'] = 'true';
            $distanceSlider = $_SESSION['button']['distanceSlider'];
            $distanceSliderValue = $value;
            $closeFriends_bool = "true";
        } elseif (strpos($dataString, 'popularity') !== false) {
            $_SESSION['button']['popularitySlider'] = 'true';
            $popularitySlider = $_SESSION['button']['popularitySlider'];
            $popularitySliderValue = $value;
            $popular_bool = "true";
        }

        //        $distanceSlider = $_SESSION['button']['distanceSlider'];
        //        $distanceSliderValue = $_SESSION['button']['distanceSliderValue'];
        //
        //        $popularitySlider = $_SESSION['button']['popularitySlider'];
        //        $popularitySliderValue = $_SESSION['button']['popularitySliderValue'];

        $sessionArray = ['popularitySlider', 'popularitySliderValue', 'distanceSlider', 'distanceSliderValue'];

        /// first figure out what the 1/4, 1/2 and 3/4 pts are
        /// CLOSENESS

        $allranks = $_SESSION["real_ranks"];

        foreach ($allranks as $thisrank) {
            $values_close[] =  $thisrank;
        }
        $count_close = count($values_close);

        $firstind_close = round( .3 * ( $count_close + 1 ) ) - 1;
        $secondind_close = round( .5 * ( $count_close + 1 ) ) - 1;
        $thirdind_close = round( .7 * ( $count_close + 1 ) ) - 1;

        $first_close = (float)$values_close[$firstind_close];
        $second_close = (float)$values_close[$secondind_close];
        $third_close = (float)$values_close[$thirdind_close];

        /// POPULARITY

        $allpopularity = $_SESSION["real_popularity"];

        foreach ($allpopularity as $thisrank) {
            $values_popularity[] =  $thisrank;
        }
        $count_popularity = count($values_popularity);

        $firstind_popularity = round( .3 * ( $count_popularity + 1 ) ) - 1;
        $secondind_popularity = round( .5 * ( $count_popularity + 1 ) ) - 1;
        $thirdind_popularity = round( .7 * ( $count_popularity + 1 ) ) - 1;

        $first_popularity = (float)$values_popularity[$firstind_popularity];
        $second_popularity = (float)$values_popularity[$secondind_popularity];
        $third_popularity = (float)$values_popularity[$thirdind_popularity];

        // get current values from sliders

        $distanceSliderValue = (float)$distanceSliderValue;
        $popularitySliderValue = (float)$popularitySliderValue;

        //        echo $distanceSliderValue;
        //        echo $popularitySliderValue;

        //        var_dump($distanceSliderValue);

        /// then assign each of those points to the fixdistance variable

        $fixdistance = 0;
        $fixpopular = 0;

        if ($distanceSliderValue < .2) {
            $fixdistance = $first_close;
        } elseif (($distanceSliderValue > .2) and ($distanceSliderValue < .8)) {
            $fixdistance = $second_close;
        }
        elseif ($distanceSliderValue > .8) {
            $fixdistance = $third_close;
        }

        //        var_dump($popularitySliderValue);

        /// then assign each of those points to the fixdistance variable
        if ($popularitySliderValue < .2) {
            $fixpopular = $first_popularity;
        } elseif (($popularitySliderValue > .2) and ($popularitySliderValue < .8)) {
            $fixpopular = $second_popularity;
        }
        elseif ($popularitySliderValue > .8) {
            $fixpopular = $third_popularity;
        }

        //        var_dump($first_popularity);
        //        var_dump($second_popularity);
        //        var_dump($third_popularity);

        //        echo $first_close;
        // echo $popularitySliderValue;
        // echo "what is going on here";
        // echo $fixpopular;
        //        echo $third_close;
        //        echo $fixdistance;


        // Execute two different base SQL syntaxes depending on if where care about closeness.

        //Create array of booleans and their corresponding statement
        $sql_filter_statements = array(
                                       "closeFriends_bool" => array($closeFriends_bool, " "),
                                       "popular_bool" => array($popular_bool, " "),
                                       );

        if($distanceSliderValue !== 0.501){
            if($distanceSliderValue > .5){
                //                echo "are we getting here?";
                $sql_filter_statements["closeFriends_bool"][1] = "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`fake_comp_rank` > ".$fixdistance." ";
            }
            elseif($distanceSliderValue < .5){
                //                echo "are we getting here? 2";
                $sql_filter_statements["closeFriends_bool"][1] = "LEFT JOIN `friends` ON `data`.`user_screen_name` = `friends`.`screen_name` WHERE `friends`.`user_id` = {$user_id} AND `friends`.`fake_comp_rank` < ".$fixdistance." ";
            }
        }

        //        echo "popularity slider value: ".$popularitySliderValue."<br>";
        if($popularitySliderValue !== .501){
            //			echo $popularitySliderValue.$_POST['middle']."<br>";
            if($popularitySliderValue > .5){
                $sql_filter_statements["popular_bool"][1] = "AND fake_popularity > ".$fixpopular." ";
            }elseif($popularitySliderValue < .5){
                //                echo "are we getting inside? where popularity slider value: ".$popularitySliderValue."<br>";
                $sql_filter_statements["popular_bool"][1] = "AND fake_popularity < ".$fixpopular." ";
            }
        }

        // Initalize filter statement
        $sql_filter = "";

        // Check each boolean then add statement if true
        foreach($sql_filter_statements as $statement){
            if ($statement[0]){
                $sql_filter .= $statement[1];
            }
        }

        //	    echo 'USERID IS ' . $user_id . "<br>";
        //Compose statement
        if($closeFriends_bool || $distantFriends_bool){
            $sql_syntax = "SELECT * FROM `data` ";
        }
        else{
            $sql_syntax = "SELECT * FROM `data` WHERE user_id = {$user_id} ";
        }

        $sql = $sql_syntax . $sql_filter . "ORDER BY tweet_id DESC LIMIT 10";

        // echo $sql;
        //Print each tweet
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }

        if($result->num_rows === 0)
        {
            echo 'There are no tweets in your feed for this selection';
        }
        else
        {
            while($row = $result->fetch_assoc()){
                                printEachTweet($row);
            }
        }

        $db->close();


    }

    ?>
