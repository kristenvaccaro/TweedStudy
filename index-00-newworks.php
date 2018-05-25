<?php
    session_start();
    //print_r($_SESSION);
    ?>

<!DOCTYPE html>
<html lang="en">

<?php
    
    // Importing all functions
    
    include 'src/saveToSQL.php';
    
    // also be able to update with our "fake" features
    
    include 'src/toSQL/updateDataSQL.php';
    
    // Save current user's tweets to SQL database
    
    include 'src/saveTrendsToSQL.php';
    
    // Save trends for current user to DB
    
    include 'src/getData.php';
    
    // Fetch data and put it into cache
    
    include 'src/printEachTweet.php';
    
    // Formatting for each tweet
    
    include 'src/printTweets_SQL.php';
    
    // Printing all tweets
    
    include 'src/saveFriendsToSQL.php';
    
    // Save friends
    
    include 'src/computeFriendRank.php';
    
    // As a second step, compute friend rank (need max friend num to do so)
    
    include 'src/savedirectMessagesToSQL.php';
    
    
    
    // Save direct messages
    // Resetting all session booleans
    
    $_SESSION['button']['only_links'] = false;
    $_SESSION['button']['no_links'] = false;
    $_SESSION['button']['only_retweets'] = false;
    $_SESSION['button']['no_retweets'] = false;
    $_SESSION['button']['tweet_popular'] = false;
    $_SESSION['button']['tweet_unpopular'] = false;
    $_SESSION['button']['poster_frequent'] = false;
    $_SESSION['button']['poster_infrequent'] = false;
    $_SESSION['button']['verified'] = false;
    $_SESSION['button']['unverified'] = false;
    $_SESSION['button']['sentiment_positive'] = false;
    $_SESSION['button']['sentiment_negative'] = false;
    $_SESSION['button']['close_friends'] = false;
    $_SESSION['button']['distant_friends'] = false;
    $_SESSION['button']['only_videos'] = false;
    $_SESSION['button']['no_videos'] = false;
    $_SESSION['button']['only_text'] = false;
    $_SESSION['button']['no_text'] = false;
    $_SESSION['button']['only_pics'] = false;
    $_SESSION['button']['no_pics'] = false;
    
    if ((!isset($_SESSION['data_in_db'])) || ($_SESSION['data_in_db']) == '') {
        $_SESSION['data_in_db'] = false;
    }

function controlPanel()
{
}

// Authorization

include 'src/authorization.php';

echo "<br />"; ?>

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>University of Illinois Twitter News Feed Study</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/1-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Study Progress</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" id="navbar">
                    <script>
                        text = ""
                        for (i = 1; i< 19; i++){
                            text +=  '<li><a href="#">' + i + '</a></li>';
                        }
                    document.getElementById("navbar").innerHTML = text;
                    </script>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Twitter News Feed Study
                </h1>
            </div>
        </div>
        <!-- /.row -->
        
        <!-- Project One -->
        <div class="row">
            <div class="col-md-2">
                   <h3>Instructions</h3>
            </div>
            <div class="col-md-4">
           <h3><small>Imagine you are browsing this feed on a Sunday morning, while drinking coffee (or other leisurely browsing time). Please browse for 10-20 seconds as you would in that situation.</small></h3>
            </div>
            <div class="col-md-6">
                <h3><small>Controls are available for this news feed. Please use them for 10-20 seconds to make your ideal feed for a Sunday morning drinking coffee (or other leisurely browsing time)."</small></h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Project One -->
        <div class="row">
            <div class="col-md-6">
                <a href="#"> </a>
                    <?php
                    echo '<div class="feed">';
                    printTweets_SQL_short();
                    echo '</div>';
                    ?>

            </div>
            <div class="col-md-6">
                <div class="controls">
                <h3>Controls</h3>
                <h4 class="controltype"></h4>
                <div id="controlcontent"></div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Project Two -->
        <div id="surveysection" class="row">
            <div class="col-md-2">
                <h3>Instructions</h3>
            </div>
            <div class="col-md-4">
                <h3><small>Please answer the following questions based on your experience with this news feed.</small></h3>
            </div>

            <div class="col-md-6">
                <h3>Survey</h3>
            
                <div class="survey">
                    <form action="">
                        <label class="statement">1. I am satisfied with the final news feed I saw for leisurely browsing</label>
                        <ul class='likert'>
                            <li>
                                <input type="radio" name="likert" value="strong_agree">
                                    <label>Strongly agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="agree">
                                    <label>Agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="some_agree">
                                    <label>Somewhat agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="neutral">
                                    <label>Neutral</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="some_disagree">
                                    <label>Somewhat disagree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="disagree">
                                    <label>Disagree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="strong_disagree">
                                    <label>Strongly disagree</label>
                                    </li>
                        </ul>
                        
                        <label class="statement">2. I enjoyed browsing this news feed</label>
                        <ul class='likert'>
                            <li>
                                <input type="radio" name="likert" value="strong_agree">
                                    <label>Strongly agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="agree">
                                    <label>Agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="some_agree">
                                    <label>Somewhat agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="neutral">
                                    <label>Neutral</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="some_disagree">
                                    <label>Somewhat disagree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="disagree">
                                    <label>Disagree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="strong_disagree">
                                    <label>Strongly disagree</label>
                                    </li>
                        </ul>


                        <label class="statement">3. I feel in control of my news feed</label>
                        <ul class='likert'>
                            <li>
                                <input type="radio" name="likert" value="strong_agree">
                                    <label>Strongly agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="agree">
                                    <label>Agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="some_agree">
                                    <label>Somewhat agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="neutral">
                                    <label>Neutral</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="some_disagree">
                                    <label>Somewhat disagree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="disagree">
                                    <label>Disagree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="strong_disagree">
                                    <label>Strongly disagree</label>
                                    </li>
                        </ul>



                        <label class="statement">3. I would like to use a control like this in my day-to-day browsing of Twitter</label>
                        <ul class='likert'>
                            <li>
                                <input type="radio" name="likert" value="strong_agree">
                                    <label>Strongly agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="agree">
                                    <label>Agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="some_agree">
                                    <label>Somewhat agree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="neutral">
                                    <label>Neutral</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="some_disagree">
                                    <label>Somewhat disagree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="disagree">
                                    <label>Disagree</label>
                                    </li>
                            <li>
                                <input type="radio" name="likert" value="strong_disagree">
                                    <label>Strongly disagree</label>
                                    </li>
                        </ul>
                    </form>
                    
                </div>

            </div>
        </div>
        <!-- /.row -->

        <hr>
        
        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Please contact kvaccaro@illinois.edu with any questions or concerns!</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    
    <script src="js/myjs.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
