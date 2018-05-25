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
    
    $_SESSION['button']['tweet_popular'] = false;
    $_SESSION['button']['close_friends'] = false;

    
    if ((!isset($_SESSION['data_in_db'])) || ($_SESSION['data_in_db']) == '') {
        $_SESSION['data_in_db'] = false;
    }

function controlPanel()
{
}

// Authorization

include 'src/authorization.php';
    
    
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
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Twitter News Feed Study
</h1>
</div>
</div>


<?php
    
    
    $outerArray = array("closeness", "closeness", "closeness", "popularity","popularity","popularity");
    $innerArray = array("real","random","none");
    
    shuffle ( $outerArray );
    
    $page_id = 0;
    
    $initial_msg=0;
    foreach($outerArray as $value)
    {
//        $project_id=$value['ProjectID'];
        
//        if($initial_msg==0)
//        {
//            echo "<h1 id='message'>Please select the project id</h1>";
//            $initial_msg=1;
//        }
        
        shuffle ( $innerArray );
        
        foreach($innerArray as $value2) {
            
            $page_id = $page_id + 1;
            
            $pages[]=$page_id;
        
        echo '<!-- /.row -->
        <!-- News Feed + Instructions -->
       
        <div class="row" id="p'.$page_id.'" style="display:none;">
        ';
            
                echo $page_id;
                echo $value;
                echo $value2;
        
                include ('index-00-feed.php');
                    
                include('index-00-survey.php');
        
            echo '
            </div>';
        }

    }
    ?>

</div>

<nav>
<ul class="pagination">
<li>
<a href="#" aria-label="Previous">
<span aria-hidden="true">&laquo;</span>
</a>
</li>

<?php
    $index=1;
    foreach($pages as $value)
    {
        echo " <li class='indicator' id='li".$value."' name='li".$value."'><a onclick='showUI(".$value.",".count($pages).")';>".$index."</a></li>";
        $index++;
    }
    ?>

<li>
<a href="#" aria-label="Next">
<span aria-hidden="true">&raquo;</span>
</a>
</li>
</ul>
</nav>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">

function showUI(_id,_size){
//    alert(_size);
    
    <?php     unset($_SESSION['dataString']);
              unset($_SESSION['value']);
              $_SESSION['button']['tweet_popular'] = false;
              $_SESSION['button']['close_friends'] = false;
?>
    
    $('.indicator').removeClass('active');
    $('#li'+_id).addClass('active');
    for (i = 1; i < _size; i++) {
        $('#p'+i).css('display','none');
    }
    $('#p'+_id).css('display','inline');
    
    alert([$('input[name=likert-'+_id+'-1]:checked').val(), $('input[name=likert-'+_id+'-2]:checked').val(), $('input[name=likert-'+_id+'-3]:checked').val(), $('input[name=likert-'+_id+'-4]:checked').val()]);
    
    thispage = _id;
    
//    $.post("src/clear_all.php",_id);
    
    $.ajax({
           type: "POST",
           url:"../TweedStudy/src/save_survey.php",
           data: {projectid: thispage, selected: [$('input[name=likert-'+_id+'-1]:checked').val(), $('input[name=likert-'+_id+'-2]:checked').val(), $('input[name=likert-'+_id+'-3]:checked').val(), $('input[name=likert-'+_id+'-4]:checked').val()] },
           dataType: 'json',
           success: function (data) {
           alert('something happened');
           $('#li'+_idx).css('background-color','#EE178C');
           },
           error: function () {
           alert('something wrong');
           }
           });
    
    $.ajax({
           type: "POST",
           url:'src/clear_all.php',
           data: {projectid: _id },
           success: function (data) {
                //nothing
           },
           error: function () {
           }
           });


    
//    $('.pagecontent').hide();
//    $('#p'+_id).show();
    
}

function save(_idx){
    $.ajax({
           type: "POST",
           url:'get_project.php',
           data: {projectid: _idx ,action:'update_record',  selected: $('input[name=project'+_idx+']:checked').val() },
           success: function (data) {
           $('#li'+_idx).css('background-color','#EE178C');
           },
           error: function () {
           }
           });
}



</script>



//// END GRACES



//    <!-- Navigation
//    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
//        <div class="container">
//            <!-- Brand and toggle get grouped for better mobile display -->
//            <div class="navbar-header">
//                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
//                    <span class="sr-only">Toggle navigation</span>
//                    <span class="icon-bar"></span>
//                    <span class="icon-bar"></span>
//                    <span class="icon-bar"></span>
//                </button>
//                <a class="navbar-brand" href="#">Study Progress</a>
//            </div>
//            <!-- Collect the nav links, forms, and other content for toggling -->
//            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
//                <ul class="nav navbar-nav" id="navbar">
//                    <script>
//                        text = ""
//                        for (i = 1; i< 19; i++){
//                            text +=  '<li><a href="#">' + i + '</a></li>';
//                        }
//                    document.getElementById("navbar").innerHTML = text;
//                    </script>
//                </ul>
//            </div>
//            <!-- /.navbar-collapse -->
//        </div>
//        <!-- /.container -->
//    </nav> -->

    <!-- Page Content -->



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
<!--   <script src="js/jquery.js"></script>
        <script src="js/myjs.js"></script> -->

    <script src="js/script_amt.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>



