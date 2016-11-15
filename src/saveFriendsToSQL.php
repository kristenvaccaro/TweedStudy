<?php
    function saveFriendsToSQL($connection, $cursor) {
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

        // Friends List
          if($cursor == null){
            $json_friends = array();
            $json_friends_ids = $connection->get("friends/ids", array("user_id" => $userid, "count" => 5000));
            var_dump($json_friends_ids);
            $json_friends_ids=json_decode($json_friends_ids, true);
            foreach ($json_friends_ids['ids'] as $friend_id) {
                 $json_friends[] = $connection->get("users/lookup", array("user_id" => $friend_id));
            }
          }else{
            $json_friends = array();
            $json_friends_ids = $connection->get("friends/ids", array("user_id" => $userid, "count" => 5000));
            foreach ($json_friends_ids->{'ids'} as $friend_id) {
                 $json_friends[] = $connection->get("users/lookup", array("user_id" => $friend_id));
            }
          }

        // Prepare and bind_param
          $stmt_friends = $conn->prepare("INSERT INTO friends (rank, user_id, friend_id, screen_name, followers_count, verified, friends_count) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE user_id = user_id");

        // Check for false statement
          if ( false===$stmt_friends ) {
              die('prepare() failed: ' . htmlspecialchars($mysqli->error));
          }

        // Define Parameters
          $stmt_friends->bind_param("iiisiii", $rank, $user_id, $friend_id, $screen_name, $followers_count, $verified, $friends_count);

        // Check if you can't bind Parameters
          $rc = $stmt_friends->bind_param("iiisiii", $rank, $user_id, $friend_id, $screen_name, $followers_count, $verified, $friends_count);
          if ( false===$rc ) {
              // again execute() is useless if you can't bind the parameters. Bail out somehow.
              die('bind_param() failed: ' . htmlspecialchars($stmt_friends->error));
          }

        // Run attachments
          if($json_friends){
            $jsonfriends = json_encode($json_friends);
            $response = json_decode($jsonfriends,true);
            $cursor = $response['next_cursor'];
            foreach($response['users'] as $friend){
              $user_id = $userid;
              $rank = $_SESSION["rank_counter"];
              $_SESSION["rank_counter"]++;
              $friend_id = $friend['id'];
              $screen_name = $friend['screen_name'];
              $followers_count = $friend['followers_count'];
              if ($friend['verified']) {
                  $verified = 1;
              } else {
                  $verified = 0;
              }
              $friends_count = $friend['friends_count'];

              if ($stmt_friends->execute() === false) {
                  die('execute() failed: ' . htmlspecialchars($stmt_friends->error));
              }
            }
            $stmt_friends->close();
          }
          return $cursor;
          $conn->close();
        }

?>
