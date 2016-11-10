<?php
    session_start();
    //print_r($_SESSION);
    ?>


<?php

echo '<!-- Survey -->
<div id="surveysection" class="row">
    <div class="col-md-5">
        <h3>Instructions</h3>

        <h3><small>Please answer the following questions based on your experience with this news feed.</small></h3>
    </div>

    <div class="col-md-7">
        <h3>Survey</h3>

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
                <input type="radio" name="likert-'; echo $page_id; echo '-1" value="some_disagree">
                <label>Somewhat disagree</label>
                </li>

                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-1" value="neutral">
                <label>Neutral</label>
                </li>

                                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-1" value="some_agree">
                <label>Somewhat agree</label>
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
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="strong_agree">
                <label>Strongly agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="agree">
                <label>Agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="some_agree">
                <label>Somewhat agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="neutral">
                <label>Neutral</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="some_disagree">
                <label>Somewhat disagree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="disagree">
                <label>Disagree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-2" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>
                </ul>


            <label class="statement">3. I feel in control of my news feed</label>
                <ul class="likert">
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="strong_agree">
                <label>Strongly agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="agree">
                <label>Agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="some_agree">
                <label>Somewhat agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="neutral">
                <label>Neutral</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="some_disagree">
                <label>Somewhat disagree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="disagree">
                <label>Disagree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-3" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>
                </ul>



            <label class="statement">4. I would like to use a control like this in my day-to-day browsing of Twitter</label>
                <ul class="likert">
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="strong_agree">
                <label>Strongly agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="agree">
                <label>Agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="some_agree">
                <label>Somewhat agree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="neutral">
                <label>Neutral</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="some_disagree">
                <label>Somewhat disagree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="disagree">
                <label>Disagree</label>
                </li>
                <li>
                <input type="radio" name="likert-'; echo $page_id; echo '-4" value="strong_disagree">
                <label>Strongly disagree</label>
                </li>
                </ul>
                </form>

        </div>
    </div>
</div>';

?>
