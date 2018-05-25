
<?php
echo '<!-- instructions -->
<div class="instructions">

    <div class="row">
        <div class="col-md-2">
            <h3>Instructions</h3>
        </div>

        <div class="col-md-4">
            <h3><small>If you have completed all the sections, please press the Submit button. You will be shown a code, which you should copy into the Amazon Mechanical Turk HIT interface to be paid.</small></h3>
        </div>';


        echo '<!-- controls constantly show atm-->
        <div class="col-md-6">
        <h3>
        <small>
            <button type="submit" id="completion_check" value="Submit">Submit</button>

            <p id="completion_code"></p>
            </small></h3>
        </div>';


echo '<!--end of the row-->
    </div>

</div>
<!-- /instructions -->


<hr>';
?>
