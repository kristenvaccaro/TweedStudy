
<?php

$_SESSION[index][1] = true;

$servername = "engr-cpanel-mysql.engr.illinois.edu";
$username = "twitterf_user";
$password = "IIA@kT$7maLt";
$dbname = "twitterf_tweet_store";
$userid = $_SESSION["user_id"];

// Create connection

$db = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo '<!-- Control Panel -->
<div>
    <div id="newpost">
        <div id="loginWrap">';

        echo "<b>" . $_SESSION["user"]["screen_name"];
        echo "</b> <img src=" . $_SESSION['user']['profile_image_url'] . " alt='error'>";

        echo '<span style="float:right;"><a href="logout.php"><button class="btn" id="logout">Logout</button></a><span>
        </div>
    <!-- <h3> Control Panel </h3> -->
    <!-- <h4> See... </h4> --> ';


    if ($value === "closeness") {

        echo '<!-- closeness -->
        <div id="people">
            <div>
            <button class="astext alignleft" id="distant_friends" data-count="0">
            Distant friends</button>   <button class="astext alignright" id="close_friends" data-count="0">
            Close friends </button></div>
            <input id="distanceSlider-'.$page_id.'" class="slider narrow" type="range" min="0.001" max="1.001" value=".501" step=".25">
            <div class="flextainer tick">
                <span>|</span><span>|</span><span>|</span><span>|</span><span>|</span>
            </div>
        </div>';


    }



    if ($value === "popularity") {

        echo '<!-- popularity -->
        <div id="content">
            <div>
                <button class="astext alignleft" id="tweet_unpopular" data-count="0">
            Less popular tweets</button> <button class="astext alignright" id="tweet_popular" data-count="0">
            More popular tweets </button>
            </div>
            <input id="popularitySlider-'.$page_id.'" class="slider narrow" type="range" min="0" max="1" value=".501" step=".25">
            <div class="flextainer tick">
                <span>|</span><span>|</span><span>|</span><span>|</span>
                <span>|</span>
            </div>
        </div>';

    }

echo '<div id="loginWrap">

You have tried <span id="numcontrols">0</span> control settings.

</div>';


echo '<!-- end divs -->
</div>
</div>';



?>
