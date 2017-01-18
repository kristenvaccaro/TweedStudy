<?php


		session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title> Tweed Twitter Feed Research </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/stylesheet.css">

</head>

<body>

<?php

		require_once 'src/TwitterOAuth/autoload.php';
		use Abraham\TwitterOAuth\TwitterOAuth;

		define('CONSUMER_KEY', 'HDhjz43hHgbl6B7fEVy3wHApk');
        define('CONSUMER_SECRET', '9xaTyEdOWSs8O9JCdHUjnYpZCoTj1pn75y7FmAS4o8EzH83LPu');
		define('OAUTH_CALLBACK', 'http://twitterfeed.web.engr.illinois.edu/TweedStudy/');

		session_start();

        unset($_SESSION['oauth_access_token']);
        unset($_SESSION['oauth_access_token_secret']);
        unset($_SESSION['data_in_db']);

		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

		$_SESSION['oauth_request_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_request_token_secret'] = $request_token['oauth_token_secret'];

		$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token'])); ?>

    <div class="well" id="instructions" style="width:100%; font-size:16px; margin:0px auto;text-align:justify;padding-left:50px;padding-right:50px;background:#F2F2F2">
    <h3 style="color:black;">
        <strong>
            Task Instructions
        </strong>
    </h3>
    <p >
        In this HIT, you will need to review several interfaces showing you versions of your Twitter news feed. It will take 20-30 minutes. You may participate only once.</p>


<div id="turker-div" name="turker-div"><strong> Enter your MTurk ID to start :</strong> <input type="text" id="turkerID" name="turkerID"><em style="color:red;"> (required)*</em>
<p><em style="color:grey">This is for the purpose of payment. </em></p>
</div>

<div id="info" name="info" style="display:none"><span style='color:red'>You already started this task. If you need to restart, contact the researchers to delete your existing data.</span></div>

</div>




<div id='survey-part' style="display:none">

<div class="row" > <div class="classWithPad" style="margin:20px; padding:20px;"> <div class="col-xs-12" >

<img src="img/imark_bold.gif">

<p>Welcome to the Tweed Twitter News Feed Evaluation Study!</p>

<p><b>DESCRIPTION</b>: We are researchers at the University of Illinois doing a research study about what people want to see in their Twitter news feed and whether it is possible to build systems that help people see more of what they want.  All data collected in this study are for research purposes only. We will show you three different systems we have built and ask you to answer questions about your preferences and/or experience of your own news feed. Participation should take approximately 45 minutes.</p>

<p><b>RISKS and BENFITS</b>: The risks to your participation in this online study are those associated with basic computer tasks, including boredom, fatigue, or mild stress. The only benefit to you is the learning experience from participating in a research study.  The benefit to society is the contribution to scientific knowledge.</p>

<p><b>COMPENSATION</b>: We will pay participants $10/hour for the duration of their interview. The interview process should take approximately 45 minutes.</p>

<p><b>CONFIDENTIALITY</b>: Your study-related information will be kept confidential, however there are some exceptions. In general, we will not tell anyone any information about you. However, laws and university rules might require us to disclose information about you.  For example, if required by laws or University Policy, study information which identifies you may be seen or copied by the following people or groups:</p>

<p style='text-indent:50px'>The university committee and office that reviews and approves research studies, the Institutional Review Board (IRB) and Office for Protection of Research Subjects;</p>

<p style='text-indent:50px'>University and state auditors, and Departments of the university responsible for oversight of research;</p>

<p>Your interview will be recorded, but to the extent allowed by law the original data will not be shared with anyone outside of our group at the University of Illinois. We will also maintain a single key linking your interview number with your email address (which will be stored in a locked safe in the PI’s office). We may contact you after the initial interview with follow up questions, but you are not obligated to participate and will be similarly compensated for any follow up contributions.</p>

<p>Any reports and presentations about the findings from this study will not include your name or any other information that could identify you.</p>

<p><b>SUBJECT'S RIGHTS</b>: Your participation is voluntary.  You may stop participating at any time by withdrawing from the study. Partial data will not be analyzed but you will still be compensated for the time that you spent in the interview.</p>

<p>For additional questions about this research, you may contact:</p>

<p>Kristen Vaccaro: kvaccaro@illinois.edu</p>
<p>Prof. Karrie Karahalios: kkarahal@cs.uiuc.edu</p>

<p>For questions about your rights as a research participant, you may contact the University of Illinois Urbana-Champaign Institutional Review Board at 217-333-2670.</p>

<p><b>TWITTER ACCESS</b>: On the next page we will begin the study, by having you log onto your Twitter account. This will allow you to look at your own Twitter feed when considering the tools. We will not retain any account information after the study is complete and will destroy our access credentials after your interview has finished.</p>

<p>Please indicate below that you are at least 18 years old, have read and understand this consent form, and you agree to participate in this online research study.</p>

<a href="<?php echo $url;?>">I consent </a>

</div>

</div>
</div>
</div>
</body>

<script>

console.log('getting into the script at all?');
//Check TurkID
// document.getElementById('turkerID').focusout = function(e){
//     console.log('getting to the check turker?');
//     // if ($('#turkerID').val() != "") {
//     //     turkID();
//     // }

// };

$('#turkerID').focusout(function(e){
    console.log('getting to the check turker?');
    if ($('#turkerID').val() != "") {
            turkID();
        }

    }
);


function turkID() {

    $.post( "src/check_turker.php", { turker: $.trim($('#turkerID').val()) })
    .done(function( data ) {

        switch(data)
                {
                  case "exists":

                    $('#survey-part').hide();
                    $('#info').show();
                    isOkay = false;
                    provider_ok=0;
                    //window.location.href ='already_exist.php';
                    break;
                   case "success":

                    provider_ok=1;
                    $('#instructions').hide();
                    $('#info').hide();
                    $('#survey-part').show();
                    break;
                  default:
                    console.log(data);


                }
  });

}


</script>



</html>
