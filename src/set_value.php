<?php
	session_start();
    
    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }


    $pairs = array(
				'only_links' =>'no_links',
				'no_links' =>'only_links',
				'only_text' =>'no_text',
				'no_text' =>'only_text',
				'only_pics' =>'no_pics',
				'no_pics' =>'only_pics',
				'only_retweets' =>'no_retweets',
				'no_retweets' =>'only_retweets',
				'tweet_popular' =>'tweet_unpopular',
				'tweet_unpopular' => 'tweet_popular',
				'poster_frequent' => 'poster_infrequent',
				'poster_infrequent' => 'poster_frequent',
				'verified' => 'unverified',
				'unverified' => 'verified',
				'sentiment_positive' => 'sentiment_negative',
				'sentiment_negative' => 'sentiment_positive',
				'close_friends' => 'distant_friends',
				'distant_friends' => 'close_friends'
    );

	$dataString = $_POST['dataString'];
	$value = $_POST['value'];
	$middle = $_POST['middle'];
    
//    echo "test inside setvalue.php";
    
//    $indstring = "we are in set_value.php";
//    console_log( $indstring );
//    console_log( $value );

//    echo $dataString;
    
    $myArray = array('dataString' => $dataString, 'value' => $value, 'middle' => $middle);
//    echo $myArray;
    $myJSONString = json_encode($myArray);
    echo $myJSONString;

	$sliderSets = array(
		'distanceSlider' => array('close_friends', 'distant_friends'),
		'frequencySlider' => array('poster_frequent', 'poster_infrequent'),
		'popularitySlider' => array('tweet_popular', 'tweet_unpopular')
	);

	if(!is_null($value)){ // checks if value is null to check if is a slider or not
//		echo $dataString."<br>";
//		echo $value."<br>";
		$_SESSION['button'][$dataString."Value"] = $value;
		if($value == $middle){
				$_SESSION['button'][$dataString] = false;
				$_SESSION['button'][$sliderSets[$dataString][0]] = false;
				$_SESSION['button'][$sliderSets[$dataString][1]] = false;
		} else {
			$_SESSION['button'][$dataString] = true;
            $_SESSION['button'][$sliderSets[$dataString][0]] = true;
            $_SESSION['button'][$sliderSets[$dataString][1]] = false;
//			if($value > $middle){
//					$_SESSION['button'][$sliderSets[$dataString][0]] = true;
//					$_SESSION['button'][$sliderSets[$dataString][1]] = false;
//			}elseif($value < $middle){
//					$_SESSION['button'][$sliderSets[$dataString][0]] = false;
//					$_SESSION['button'][$sliderSets[$dataString][1]] = true;
//			}
		}

	}
    elseif ($dataString == 'alloff'){
        foreach($_SESSION['button'] as $key => $value){
            $_SESSION['button'][$key] = false;
        }
        // $response = 'false';
    }
    elseif($dataString == 'refresh'){
				echo dirname("pass_value.php")."/pass_value.php";
        include 'authorization.php';
        include 'saveToSQL.php';
//        include 'tweetsToSQL.php';

        $next_max_id = null;
        $cursor = null;

        echo "The if statement is true, now paging through tweets to refresh. <br>";
        // While there are still tweets, run saveToSQL
        while(true){
            echo "The tweet while statement is true <br>";
            // Preserve previously recieved cursor
            $next_max_id_temp = $next_max_id;
            // Run saveToSQL and store return array into $return_array
            $next_max_id = saveToSQL($connection, $next_max_id_temp);

            $next_max_id_str = (string) $next_max_id;
            echo "The next_max_id is " . $next_max_id_str . "<br>";

            if($next_max_id == $next_max_id_temp || $next_max_id == null){
                break;
            }
        }
    }
    elseif($_SESSION['button'][$dataString]){
		$_SESSION['button'][$dataString] = false;
		// $response = 'false';
	}
	else{
		// $response = 'true';
        if ( array_key_exists($dataString,$pairs)) {
            $pair_name = $pairs[$dataString];
            if ($_SESSION['button'][$pair_name]) {
                $_SESSION['button'][$pair_name] = false;
            }
        } else {
					// run through all other things in sessiopn[]button
					foreach($_SESSION['button'] as $filterkey => $filter)	{
						if(!array_key_exists($filterkey,$pairs)){
					$_SESSION['button'][$filterkey] = false;
				}
				}
			}

			$_SESSION['button'][$dataString] = true;

	}


?>
