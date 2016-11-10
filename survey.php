<?php
session_start();
//print_r($_SESSION);

$_SESSION['last_referrer_url'] = $_SERVER['HTTP_REFERER'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tweed Twitter Feed Research </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="css/survey.css">
	</head>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-xs-8">

            <div class="wrap">
            <h1 class="likert-header">Survey For Previous Interface</h1>
            <form action="">
            <label class="statement">This tool was easy to use.</label>
            <ul class='likert'>
                <li>
                <input type="radio" name="q1" value="strong_agree">
                <label>Strongly agree</label>
                </li>
                <li>
                <input type="radio" name="q1" value="agree">
                <label>Agree</label>
                </li>
                <li>
                <input type="radio" name="q1" value="neutral">
                <label>Neutral</label>
                </li>
                <li>
                <input type="radio" name="q1" value="disagree">
                <label>Disagree</label>
                </li>
                <li>
                <input type="radio" name="q1" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>
            </ul>

            <label class="statement">I saw what I wanted in the News Feed</label>
            <ul class='likert'>
                <li>
                <input type="radio" name="q2" value="strong_agree">
                <label>Strongly agree</label>
                </li>
                <li>
                <input type="radio" name="q2" value="agree">
                <label>Agree</label>
                </li>
                <li>
                <input type="radio" name="q2" value="neutral">
                <label>Neutral</label>
                </li>
                <li>
                <input type="radio" name="q2" value="disagree">
                <label>Disagree</label>
                </li>
                <li>
                <input type="radio" name="q2" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>
            </ul>


            <div class="buttons">
                <button class="clear">Clear</button>
                <button class="kristen">Submit and go to next step</button>
            </div>
            </form>
            </div>

			</div>

				<div class="col-xs-4 totop">

				</div>
    		</div>
    	</div>
			<script>
            $("button.kristen").on('click', function( event ) {
                           $.ajax({
                                type:'POST',
                                url: "saveResponses.php",
                                cache: false,
                                data : $('form').serialize(),
                                success: function(response) {
																	console.log("success");
																	// alert(response);
																	window.location.href = response;
																},
																error: function(response){
																	alert("ajax failure");
																}
                                  }).fail(function ( jqXHR, textStatus, errorThrown ) {
                                          console.log(jqXHR);
                                          console.log(textStatus);
                                          console.log(errorThrown);
                                          });


                              });
</script>
</html>
