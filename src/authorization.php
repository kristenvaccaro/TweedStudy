<?php
    // Authorization
    ini_set('display_errors', 1);
    //					require_once('TwitterAPIExchange.php');

    $path_parts = pathinfo('authorization.php');
    echo $path_parts['dirname']."<br>";
    require $path_parts['dirname']."/TwitterOAuth/autoload.php";
    //
    //
    // echo dirname("authorization.php");

    // define('__ROOT__', dirname(dirname("authorization.php")));
    // require_once(__ROOT__.'/TwitterOAuth/autoload.php');
    //
    // require("../../TwitterOAuth/autoload.php");
    // require "/TwitterOAuth/autoload.php";
    // require "vendor/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    //echo "Require successful with directory: ".$path_parts['dirname']."/TwitterOAuth/autoload.php <br>";

    define('CONSUMER_KEY', 'jcWtxniXFDXc1JzUcDphKcM50');
    define('CONSUMER_SECRET', 'oQTh80UzN2NHDI6HRN9FvgIjnlnuHwEQOvWAxtWSi0H6Dau576');
    define('OAUTH_CALLBACK', 'http://twitterfeed.web.engr.illinois.edu/TweedStudy/index.php');

    if ((!isset($_SESSION['oauth_access_token'])) || ($_SESSION['oauth_access_token'])=='') {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
        echo "testing testing testing ";
                               echo CONSUMER_KEY;
                               echo CONSUMER_SECRET;
                               echo "<br>testing testing testing 2<br>";
                               var_dump($request_token);
                               echo "<br> end of request token printing <br>";
        $_SESSION['oauth_access_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_access_token_secret'] = $request_token['oauth_token_secret'];
    } else {
        //                        echo $_SESSION['oauth_access_token'];
        //                        echo "<br>";
    }


    //                    $request_token = [];
    //                    $request_token['oauth_token'] = $_SESSION['oauth_token'];
    //                    $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];


    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_access_token'], $_SESSION['oauth_access_token_secret']);
// Create $user variable from connection and store $user["id"] as session variable
    $user = $connection->get("account/verify_credentials");
    $user = json_decode(json_encode($user),true);
    $user_id = $user["id"];
    $_SESSION["user_id"] = $user_id; // Session variable that hold $user_id
    $_SESSION["user"] = $user; // Session variable that holds the user array.

    //                    echo $_SESSION['oauth_access_token'];
    //                    echo "<br>";
    //                    echo $_SESSION['oauth_token'];
    //                    echo "<br>";
    //                    echo CONSUMER_KEY;
    //                    echo "<br>";
    //                    var_dump($connection);
    //                    echo "<br>";
    //                    var_dump($user);

    //					/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    //					$settings = array(
    //									  'oauth_access_token' => $_SESSION['oauth_access_token'],
    //									  'oauth_access_token_secret' => $_SESSION['oauth_access_token_secret'],
    //									  'consumer_key' => CONSUMER_KEY,
    //									  'consumer_secret' => CONSUMER_SECRET
    //									  );
    //
    //					/** Perform a GET request and echo the response **/
    //					$url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
    //					$requestMethod = 'GET';
    //					$twitter = new TwitterAPIExchange($settings);
    //					$jsonTweets = $twitter->buildOauth($url, $requestMethod)
    //								->performRequest();

    //$jsonTweets = $connection->get("statuses/home_timeline", array("count" => 200, "include_entities" => true));


    //                    $jsonTweets = getData($connection);

    /** Process the response (JSON format) using json_decode: http://docs.php.net/json_decode **/
    $response = json_decode($jsonTweets,true);

    /** Go through every tweet and print out line by line -- will ideally need some pleasant wrapping with bootstrap -- maybe add IDs to process instead
     Example of the kind of information that can be returned here: https://dev.twitter.com/rest/reference/get/statuses/home_timeline **/
?>
