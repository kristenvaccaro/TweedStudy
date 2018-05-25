<?php

function printEachTweetInitial($tweet,$count)
{

	$now = new DateTime();
	$now->format('D M d H:i:s O Y');
	$now->getTimestamp();
	$create_date = DateTime::createFromFormat('D M d H:i:s O Y', $tweet['tweet_create_date']);
	$amt_time = $now->diff($create_date);
	if ($amt_time->d > 0) {
		$print_time = $create_date->format('M d');
	}
	elseif ($amt_time->h > 0) {
		$print_time = $amt_time->h . "h";
	}
	elseif ($amt_time->i > 0) {
		$print_time = $amt_time->i . "m";
	}
	else {
		$print_time = $amt_time->s . 's';
	}

	//			$now2 = $now->format('Y-m-d H:i:s');
	//			$create_date2 = $create_date->format('Y-m-d H:i:s');
	//			$difference = strtotime($create_date2)-strtotime($now2);
	//			echo "difference";
	//			var_dump($difference);
	//			$amt_time_sec = $difference;
	// $create_date = $new_date->format('Y-m-d H:i:s');
	// 	    $amt_time = $now->diff($create_date);
	// 			// var_dump($amt_time);
	// 			// $amt_time_sec = $amt_time->format('%U');
	//			var_dump($amt_time_sec);
	//			if($amt_time_sec < 60){
	//				$print_time = $amt_time->format('s') . 's';
	//			}
	//	    elseif ($amt_time_sec < 3600) {
	//	        $print_time = $amt_time->format('i') . "m";
	//	    } elseif ($amt_time_sec < 86400) {
	//	        $print_time = $amt_time->format('H') . "h";
	//	    } else {
	//	        $print_time = $amt_time->format('M d');
	//	    }
	// echo $tweet['tweet_text'];
	// Regex to replace urls with hyperlinks

	$url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
	$hashtag = '/([#])\w+/';
	$tweet['tweet_text'] = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $tweet['tweet_text']);
	$tweet['tweet_text'] = preg_replace("/([#])\w+/", "<span class='hashtag'>$0</span>", $tweet['tweet_text']);

	// echo $tweet['tweet_text'];

    echo '<div class="big-group">';
	echo '<div class="col-xs-9">';
    echo '<div class="tweet">';
    echo "<br />";
    echo '<div class="container-fluid">';
    if ($tweet['retweet'] == 1) {
        echo '<div class="row-fluid">';
        echo '<div class="col-xs-1">';
        echo '</div>';
        echo '<div class="col-xs-10">';
        echo "<a href={$tweet['user_url']}><b>{$tweet['user_name']}</b></a> Retweeted";
        echo '</div> </div> <br />';
    }
    echo '<div class="row-fluid">';
    echo '<div class="col-xs-1 nopadding">';
    if ($tweet['retweet'] == 0) {
        echo "<a href={$tweet['user_url']}><img class='profileimg' src={$tweet['user_profile_img_url']} ></a>";
    }
    else {
        echo "<a href={$tweet['retweet_user_url']}><img class='profileimg' src={$tweet['retweet_user_profile_img']} ></a>";
    }
    echo '</div>';
    echo '<div class="col-xs-10">';
    if ($tweet['retweet'] == 0) {
        echo "<a href={$tweet['user_url']}><b>{$tweet['user_name']}</b></a> <span style='color: #808080;'> @{$tweet['user_screen_name']}</span> • {$print_time}<br />{$tweet['tweet_text']}<br />";
    }
    else {
        echo "<a href={$tweet['retweet_user_url']}><b>{$tweet['retweet_user_name']}</b></a> <span style='color: #808080;'> @{$tweet['retweet_user_screen_name']}</span> • {$print_time}<br />{$tweet['tweet_text']}<br />";
    }
    if ($tweet['video'] == 1) {
        echo "<video width='100%' controls autoplay muted loop>";
        echo "<source src={$tweet['video_url']} type='video/mp4'>";
        echo "</video>";
    }
    else {
        $images = unserialize($tweet['tweet_images']);
        if (!is_null($images)) {
            //                            foreach ($images as $img) {
            //                                echo $img;
            echo "<img src={$images} style='max-width:100%;' >";
            echo "<br />";
        } //}
    }
    //                        echo $tweet_urls;
    //                        if (!empty($tweet_urls)){
    //                            foreach ($tweet_urls as $url) {
    //                                echo "<a href={$url['url']}>{$url['display_url']}</a>";
    //                            }}
    //                        if (!empty($hashtags)){
    //                            foreach ($hashtags as $hash) {
    //                                echo "<a href='https://twitter.com/hashtag/{$hash['text']}\?src=hash'>#{$hash['text']}</a>";
    //                            }}
    //                        echo "|| Value = <b><i>".$thisValueArray[$key]."</b></i><br />";
    echo '<div id="meta">';
    echo '<svg width="20.8333" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 75 72">
    <path style="fill-opacity:0.5" d="M70.676 36.644C70.166 35.636 69.13 35 68 35h-7V19c0-2.21-1.79-4-4-4H34c-2.21 0-4 1.79-4 4s1.79 4 4 4h18c.552 0 .998.446 1 .998V35h-7c-1.13 0-2.165.636-2.676 1.644-.51 1.01-.412 2.22.257 3.13l11 15C55.148 55.545 56.046 56 57 56s1.855-.455 2.42-1.226l11-15c.668-.912.767-2.122.256-3.13zM40 48H22c-.54 0-.97-.427-.992-.96L21 36h7c1.13 0 2.166-.636 2.677-1.644.51-1.01.412-2.22-.257-3.13l-11-15C18.854 15.455 17.956 15 17 15s-1.854.455-2.42 1.226l-11 15c-.667.912-.767 2.122-.255 3.13C3.835 35.365 4.87 36 6 36h7l.012 16.003c.002 2.208 1.792 3.997 4 3.997h22.99c2.208 0 4-1.79 4-4s-1.792-4-4-4z"/>
    </svg>';
    // echo " {$tweet['retweet_count']}";
    echo "{$tweet['retweet_count']} ";
    echo "   ";
    echo '<svg width="15" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 72">
    <path style="fill-opacity: 0.5" d="M38.723,12c-7.187,0-11.16,7.306-11.723,8.131C26.437,19.306,22.504,12,15.277,12C8.791,12,3.533,18.163,3.533,24.647 C3.533,39.964,21.891,55.907,27,56c5.109-0.093,23.467-16.036,23.467-31.353C50.467,18.163,45.209,12,38.723,12z"/>
    </svg>';
    echo "{$tweet['favorite_count']}";
    echo '</div>';
    echo '</div> </div> </div>';
    echo '</div></div>';
    
    echo '<div class="col-xs-3">';
    echo '<p>Would you like to see this tweet?</p>';
    
//    echo '<form class="yesno">';
//    echo '<input type="radio" name="see" value="yes"> Yes ||| <input type="radio" name="see" value="no"> No<br>';
//    echo '</form>';

    echo '<button style="padding-right: 10px" onclick="boldButton2(this.id)" class="astext yesno" id="yesno'.$count.'" value="yes" data-count="0"> Yes </button> <button style="padding-right: 10px" onclick="boldButton2(this.id)" class="astext yesno" id="yesno'.$count.'" value="unsure" data-count="0"> Not sure </button> <button onclick="boldButton2(this.id)" id="yesno'.$count.'" class="astext yesno" value="no" data-count="0"> No </button> <br>';
    
    echo '<div id="yes-'.$count.'" style="display: none;"> <p><br> alerWhy?</p><br></div>';

    echo '<div id="no-'.$count.'" style="display: none;"> <p><br>Why not?</p><br></div>';
    
    
    echo '</div>';
    echo '<div class="col-xs-12">';
    
    echo "<br />";
    echo "<hr>";
    echo '</div>';
    echo '</div>';
}

?>


