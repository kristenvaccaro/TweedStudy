<?php

    function updateDataSQL() {

        // echo "getting inside the function update Data<br>";
        $servername = "engr-cpanel-mysql.engr.illinois.edu";
        $username = "twitterf_user";
        $password = "IIA@kT$7maLt";
        $dbname = "twitterf_tweet_store";

        // Initalize userid variable with session "user_id"
        $userid = $_SESSION["user_id"];

                // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }



//sentiment, popularity, poster_frequency

//        $init_sql = "SELECT max(tweet_popularity) FROM `data` WHERE user_id = {$userid}";
//
//        if(!$result = $conn->query($init_sql)){
//            die('There was an error running the query [' . $conn->error . ']');
//        }
//
//        $init_row = $result->fetch_assoc();
//
//        $max_popular = $init_row['max(tweet_popularity)'];
//
//        $_SESSION["max_real_popular"]=$max_popular;
//
//        $init_sql = "SELECT min(tweet_popularity) FROM `data` WHERE user_id = {$userid}";
//
//        if(!$result = $conn->query($init_sql)){
//            die('There was an error running the query [' . $conn->error . ']');
//        }
//
//        $init_row = $result->fetch_assoc();
//
//        $min_popular = $init_row['min(tweet_popularity)'];
//
//        $_SESSION["min_real_popular"]=$min_popular;

        $init_sql = "SELECT max(sentiment) FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        $init_row = $result->fetch_assoc();

        $max_sentiment = $init_row['max(sentiment)'];

        $_SESSION["max_real_sent"]=$max_sentiment;

        $init_sql = "SELECT min(sentiment) FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        $init_row = $result->fetch_assoc();

        $min_sentiment = $init_row['min(sentiment)'];

        $_SESSION["min_real_sent"]=$min_sentiment;


        /// get full set of popularity values

        $init_sql2 = "SELECT tweet_popularity FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql2)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        while($row = $result->fetch_assoc()){

            $fakePopularity[] = $row['tweet_popularity'];

        }

        asort($fakePopularity);

        $_SESSION["real_popularity"] = $fakePopularity;


        $sql = "SELECT data.user_id,data.tweet_id FROM `data` WHERE `data`.user_id = {$userid}";


        //        260761339
        //        SELECT * FROM `friends` LEFT JOIN `directMessages`
        //        ON `friends`.`friend_id`=`directMessages`.`sender_id` WHERE `friends`.user_id = 260761339

        //        echo $sql;

        if(!$result = $conn->query($sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        //        mysqli_report(MYSQLI_REPORT_ALL);

        // Set up insert
        $stmt_friends = $conn->prepare("UPDATE data SET fake_sentiment = ?, fake_popularity = ? WHERE user_id = {$userid} AND tweet_id = ?");

        // Check for false statement
        if ( false===$stmt_friends ) {
            die('prepare() failed: ' . htmlspecialchars($mysqli->error));
        }

        // Define Parameters
        $stmt_friends->bind_param("iii", $fakesentiment,$fakepopularity,$friendid);

        // Check if you can't bind Parameters
        $rc = $stmt_friends->bind_param("iii", $fakesentiment,$fakepopularity,$friendid);

        //test : 2475800184, user_id = 260761339

        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($stmt_friends->error));
        }

        $tempFakePopularity = $fakePopularity;

        while($row = $result->fetch_assoc()){
            //            echo "getting here again? <br>";
            //            var_dump($row);
            //            echo "<br>";
            //            processAndInsert($row,$max_rank,$conn, $userid, $stmt_friends);
            //            printEachTweet($row);

            $friendInfo = $row;

            $friendid = (float)$friendInfo['tweet_id'];

            $fakesentiment = rand ( $min_sentiment,  $max_sentiment );

            $k = array_rand($tempFakePopularity);

            $fakepopularity = $tempFakePopularity[$k];

            unset($tempFakePopularity[$k]);

//            $fakepopularity = rand( $min_popular,  $max_popular );




            //            var_dump($friendid);
            //            echo "<br>";

            if ($stmt_friends->execute() === false) {
                die('execute() failed: ' . htmlspecialchars($stmt_friends->error));
            }

//            echo "finished one more tweet";


        }



        $stmt_friends->close();

        $init_sql = "SELECT max(fake_popularity) FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        $init_row = $result->fetch_assoc();

        $max_popular = $init_row['max(fake_popularity)'];

        $_SESSION["max_fake_popular"]=$max_popular;

        $init_sql = "SELECT min(fake_popularity) FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        $init_row = $result->fetch_assoc();

        $min_popular = $init_row['min(fake_popularity)'];

        $_SESSION["min_fake_popular"]=$min_popular;


        //        $conn->close();


        /// FINALLY DO THE POSTER FREQUENCY -- WHY DID WE STORE THIS IN THE DATA ARGH


        $init_sql = "SELECT max(poster_frequency) FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        $init_row = $result->fetch_assoc();

        $max_freq = $init_row['max(poster_frequency)'];

        $_SESSION["max_real_freq"]=$max_freq;

        $init_sql = "SELECT min(poster_frequency) FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        $init_row = $result->fetch_assoc();

        $min_freq = $init_row['min(poster_frequency)'];

        $_SESSION["min_real_freq"]=$min_freq;


        // now get all the posters, their tweets tweets, assign them a frequency at random, update the fake_poster_frequency for each tweet



        $sql = "SELECT distinct(user_screen_name) FROM `data` WHERE `data`.user_id = {$userid}";


        //        260761339
        //        SELECT * FROM `friends` LEFT JOIN `directMessages`
        //        ON `friends`.`friend_id`=`directMessages`.`sender_id` WHERE `friends`.user_id = 260761339

        //        echo $sql;

        if(!$result = $conn->query($sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        //        mysqli_report(MYSQLI_REPORT_ALL);

        // Set up insert
        $stmt_friends = $conn->prepare("UPDATE data SET fake_poster_frequency = ? WHERE user_id = {$userid} AND user_screen_name = ?");

        // Check for false statement
        if ( false===$stmt_friends ) {
            die('prepare() failed: ' . htmlspecialchars($mysqli->error));
        }

        // Define Parameters
        $stmt_friends->bind_param("is", $fakefreq,$fakescreenname);

        // Check if you can't bind Parameters
        $rc = $stmt_friends->bind_param("is", $fakefreq,$fakescreenname);

        //test : 2475800184, user_id = 260761339

        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($stmt_friends->error));
        }


        while($row = $result->fetch_assoc()){
            //            echo "getting here again? <br>";
            //            var_dump($row);
            //            echo "<br>";
            //            processAndInsert($row,$max_rank,$conn, $userid, $stmt_friends);
            //            printEachTweet($row);

            $friendInfo = $row;

            $fakescreenname = $friendInfo['user_screen_name'];

            $fakefreq = rand ( $min_freq,  $max_freq );


            if ($stmt_friends->execute() === false) {
                die('execute() failed: ' . htmlspecialchars($stmt_friends->error));
            }

            // echo "finished one more person";


        }

        $stmt_friends->close();


        $init_sql = "SELECT max(fake_poster_frequency) FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        $init_row = $result->fetch_assoc();

        $max_freq = $init_row['max(fake_poster_frequency)'];

        // echo $max_freq;

        $_SESSION["max_fake_freq"]=$max_freq;

        $init_sql = "SELECT min(fake_poster_frequency) FROM `data` WHERE user_id = {$userid}";

        if(!$result = $conn->query($init_sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }

        $init_row = $result->fetch_assoc();

        $min_freq = $init_row['min(fake_poster_frequency)'];

        // echo $min_freq;

        $_SESSION["min_fake_freq"]=$min_freq;


        $conn->close();


    }
    ?>


