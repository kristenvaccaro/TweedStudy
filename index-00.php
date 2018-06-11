<?php
    session_start();
    //print_r($_SESSION);
    ?>

<!DOCTYPE html>
<html lang="en">

<?php

    // Importing all functions

    // include 'src/saveToSQL.php';

    // // also be able to update with our "fake" features

    // include 'src/toSQL/updateDataSQL.php';

    // // Save current user's tweets to SQL database

    // include 'src/saveTrendsToSQL.php';

    // Save trends for current user to DB

    // include 'src/getData.php';

    // Fetch data and put it into cache

    include 'src/printEachTweet.php';

    // Formatting for each tweet

    include 'src/printTweets_SQL.php';

    // Printing all tweets

    // include 'src/saveFriendsToSQL.php';

    // // Save friends

    // include 'src/computeFriendRank.php';

    // // As a second step, compute friend rank (need max friend num to do so)

    // include 'src/savedirectMessagesToSQL.php';



    // Save direct messages
    // Resetting all session booleans

    $_SESSION['button']['tweet_popular'] = false;
    $_SESSION['button']['close_friends'] = false;


    if ((!isset($_SESSION['data_in_db'])) || ($_SESSION['data_in_db']) == '') {
        $_SESSION['data_in_db'] = false;
    }

function controlPanel()
{
}

// Authorization

// include 'src/authorization.php';


?>

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>University of Illinois Twitter News Feed Study</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stylesheet.css" rel="stylesheet">
    <link href="css/survey.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="css/1-col-portfolio.css" rel="stylesheet"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<div class="container">

    <!-- Page Heading -->
    <div class="row" style="margin: 0 0; background-color:#efefef;">
    <div class="col-lg-12" id="header-footer">
        <span id="pagecounter"> </span>
        <h1 class="page-header">Short News Feed
        </h1>

    </div>
    </div>



<?php

    $page_id = 1;
    $value="popularity";
    $value2="real";

    echo '<!-- News Feed + Instructions -->

        <div class="row splitpage" id="p'.$page_id.'" style="display:inline; margin: 0 0;">
        ';
    echo '<div style="display:none" class="controltype">'.$value.'</div>';
    echo '<div style="display:none" class="rrn">'.$value2.'</div>';

    include ('index-00-feed.php');

    echo '</div>';
    echo '</div>';
?>

<div class="container">

<h4 style="line-height: 1.5;"> You will experience 18 different interfaces for browsing your Twitter news feed. Please use the buttons below to navigate between interfaces, clicking the next page number to proceed. Surveys will appear only when you have browsed/interacted as instructed. Please avoid refreshing until you've finished all the surveys.</h4>

</div> <!--  end container for indentation -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>





    <!-- Page Content -->



        <!-- Footer -->
        <footer>
            <div class = "container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Please contact kvaccaro@illinois.edu with any questions or concerns!</p>
                </div>
            </div>
            </div>
            <!-- /.row -->
        </footer>

</div>
    <!-- /.container -->

    <!-- jQuery -->
<!--   <script src="js/jquery.js"></script>
        <script src="js/myjs.js"></script> -->

    <script src="js/script_amt.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>



