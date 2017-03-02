<?php
    session_start();
    //print_r($_SESSION);
    ?>


<?php

echo '<!-- Survey -->
<div id="header-footer">
<div id="surveysection" class="row">
    <div class="col-md-12">
       <!-- <h3 style="margin-left:15px;">Survey</h3> -->

        <h3 style="margin-left:15px; line-height: 1.5;">Based on your experience with this news feed interface, please answer the following questions.</h3>
    </div>

    <div class="col-md-1">
    </div>

    <div class="col-md-7">
        <!-- <h3 style="margin-left:15px;">Survey</h3> -->

        <div class="survey">
            <form action="">
            <label class="statement">1. I am satisfied with the final news feed I saw for leisurely browsing</label>
                <ul class="likert">


                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-1" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-1" value="disagree">
                <label>Disagree</label>
                </li>


                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-1" value="neutral">
                <label>Neutral</label>
                </li>

                 <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-1" value="agree">
                <label>Agree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-1" value="strong_agree">
                <label>Strongly agree</label>
                </li>



                </ul>

            <label class="statement">2. I enjoyed browsing this news feed</label>
                <ul class="likert">
                                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="disagree">
                <label>Disagree</label>
                </li>


                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="neutral">
                <label>Neutral</label>
                </li>


                 <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="agree">
                <label>Agree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="strong_agree">
                <label>Strongly agree</label>
                </li>

                </ul>

            <label class="statement">3. For verification purposes, please select '; echo $verificationTask[$page_id]; echo'</label>
                <ul class="likert">
                                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="disagree">
                <label>Disagree</label>
                </li>


                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="neutral">
                <label>Neutral</label>
                </li>


                 <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="agree">
                <label>Agree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="strong_agree">
                <label>Strongly agree</label>
                </li>

                </ul>


            <label class="statement">4. I feel in control of my news feed</label>
                <ul class="likert">
                                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="disagree">
                <label>Disagree</label>
                </li>


                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="neutral">
                <label>Neutral</label>
                </li>


                 <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="agree">
                <label>Agree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="strong_agree">
                <label>Strongly agree</label>
                </li>

                </ul>



            <label class="statement">5. I would like to use an interface like this for my day-to-day browsing of my Twitter news feed.</label>
                <ul class="likert">
                                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="disagree">
                <label>Disagree</label>
                </li>


                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="neutral">
                <label>Neutral</label>
                </li>

                 <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="agree">
                <label>Agree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="strong_agree">
                <label>Strongly agree</label>
                </li>

                </ul>
                </form>

        </div>
    </div>
</div>
</div>';

?>
