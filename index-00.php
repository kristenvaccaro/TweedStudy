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
<h1 class="page-header" style="display:inline;">Twitter News Feed Study
</h1> <nav>
<ul class="pagination" style ="display:inline; padding: 3px 6px;">

<?php
    $pages=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19];
    $index=1;
    foreach($pages as $value)
    {
        echo " <li class='indicator' id='li".$value."' name='li".$value."'><a onclick='showUI(".$value.",".count($pages).")';>".$index."</a></li>";
        $index++;
    }
    $pages=[];
    ?>

</ul>
</nav>
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

//                echo $page_id;
//                echo $value;
//                echo $value2;
                echo '<div style="display:none" class="controltype">'.$value.'</div>';
                echo '<div style="display:none" class="rrn">'.$value2.'</div>';

                include ('index-00-feed.php');

                include('index-00-survey.php');


            echo '
            </div>';
        }

    }

    $page_id = $page_id + 1;
    $pages[]=$page_id;

     echo '<!-- /.row -->
        <!-- News Feed + Instructions -->
        <div class="row" id="p'.$page_id.'" style="display:none;">
        ';
    include ('index-00-submit.php');
    //echo '<button type="submit" form="nameform" value="Submit">Submit</button>';
    echo '</div>';
    ?>

</div>

<div class="container">

Please use the following controls to complete each survey page, clicking the next page number to proceed.

<nav>
<ul class="pagination">

<?php
    $index=1;
    foreach($pages as $value)
    {
        echo " <li class='indicator' id='li".$value."' name='li".$value."'><a onclick='showUI(".$value.",".count($pages).")';>".$index."</a></li>";
        $index++;
    }
    ?>

</ul>
</nav>
</div> <!--  end container for indentation -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
      $("#completion_check").click(function(){

        $.ajax({type: "POST",
                url: "src/completion_check.php",
                data: { },
                success:function(response){
                    console.log(response);
                    numCompleted = parseInt(response['numCompleted']);
                    numIncomplete = 18 - numCompleted;
                    console.log(numCompleted);
                    if (numCompleted < 18) {
                        $("#completion_code").html('<h3><small>Your response is ' + response['completionCode'] + '. You have ' + numIncomplete.toString() + ' incomplete pages. <br> Completed pages are indicated with green buttons on the menu below. Incomplete pages have white buttons.</small></h3>');
                    } else {
                        $("#completion_code").html('<h3><small>Thank you for participating in our study! Copy this code into the Amazon Mechanic Turk HIT textbox to be paid: <b>' + response['completionCode']+'</b></small></h3>');
                    }
                }});
            });
    });


function showUI(_id,_size){

    $.fn.xpathEvaluate = function (xpathExpression) {
        // NOTE: vars not declared local for debug purposes
        $this = this.first(); // Don't make me deal with multiples before coffee

        // Evaluate xpath and retrieve matching nodes
        xpathResult = this[0].evaluate(xpathExpression, this[0], null, XPathResult.ORDERED_NODE_ITERATOR_TYPE, null);

        result = [];
        while (elem = xpathResult.iterateNext()) {
            result.push(elem);
        }

        $result = jQuery([]).pushStack( result );
        return $result;
    }
//    alert(_size);



    try {
        // PAGE THAT WE'RE LEAVING
        $pageleaving = $(document).xpathEvaluate('//div[contains(@style,"display: inline")]/@id').val().slice(1);

        // CONTROL TYPE
        $controltype = $(document).xpathEvaluate('//div[contains(@style,"display: inline")]/div[contains(@class,"controltype")]/text()').text();

        // REAL RANDOM OR NONE
        $rrn = $(document).xpathEvaluate('//div[contains(@style,"display: inline")]/div[contains(@class,"rrn")]/text()').text();
    }
    catch(err) {
        $pageleaving = '0';
        $controltype = 'fail';
        $rrn = 'fail';
    }



    <?php     unset($_SESSION['dataString']);
              unset($_SESSION['value']);
              $_SESSION['button']['tweet_popular'] = false;
              $_SESSION['button']['close_friends'] = false;
?>

    $('.indicator').removeClass('active');
    $('#li'+_id).addClass('active');
    for (i = 1; i < _size + 1; i++) {
        $('#p'+i).css('display','none');
    }
    $('#p'+_id).css('display','inline');
//
//    alert([$('input[name=likert-'+$pageleaving+'-1]:checked').val(), $('input[name=likert-'+$pageleaving+'-2]:checked').val(), $('input[name=likert-'+$pageleaving+'-3]:checked').val(), $('input[name=likert-'+$pageleaving+'-4]:checked').val()]);

    thispage = _id;

    $("html, body").animate({ scrollTop: 0 }, "slow");

//    $.post("src/clear_all.php",_id);

//    $test = $('input[name=likert-'+_id+'-1]:checked');
//    alert($test);

//    $pageleaving = $('//div[contains(@style,"display: inline")]/@id');

//    $pageleaving = $('div:contains(@style,"display: inline") > id');

    if ($pageleaving > 0) {

    $.ajax({
           type: "POST",
           url:"src/save_survey.php",
           data: {page: $pageleaving, controltype: $controltype, realrandnone: $rrn, selected: [$('input[name=likert-'+$pageleaving+'-1]:checked').val(), $('input[name=likert-'+$pageleaving+'-2]:checked').val(), $('input[name=likert-'+$pageleaving+'-3]:checked').val(), $('input[name=likert-'+$pageleaving+'-4]:checked').val()] },
           dataType: 'JSON',
           async: true,
           cache: false,
           success: function(response) {
                console.log(response);
                if ( response !== null && response.length !== 0 ){
                    tlen = 0;
                    $.each(response, function( index, value ) {
                        if (value.length != 0) {
                            tlen += 1;
                        }
                    });
                    console.log(tlen);
                    if (tlen === 4) {
                        console.log('successfully saved survey response');
                        $('#li'+$pageleaving+' a').css('background-color','#08BF67');
                    }
                }

           },
           error:function(exception){console.log(exception);}

           });

    }


    <?php $_SESSION['current_page'] = _id; ?>


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



