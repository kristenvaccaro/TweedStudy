
<?php
echo '<!-- instructions -->
<div class="instructions" id="header-footer">

    <div class="row">
        <!-- <div class="col-md-2">
        <h3 style="margin-left: 14px;">Instructions</h3>
        </div> -->

        <div class="col-md-7">
            <h3>Imagine you are browsing this feed on a Sunday morning, while drinking coffee (or a similar leisurely browsing time). Please browse for 30-60 seconds as you would in that situation.</h3>
        </div>';


        if ($value2 === "real" or $value2 === "random") {

        echo '<!-- controls constantly show atm-->
        <div class="col-md-5">
            <h3 style="margin-left: 15px; margin-right: 15px;">Controls are available for this news feed. Please use them for 10-20 seconds to make your ideal feed for a leisurely browsing time (e.g. a Sunday morning drinking coffee).</h3>
        </div>';
        }else{ echo '<!-- no controls -->
        <div class="col-md-5">
        </div>';
        }

echo '<!--end of the row-->
    </div>

</div>
<!-- /instructions -->


<!-- feed+controls -->
<div class="feed+controls">
    <div class="row">';

    if ($value2 === "real" or $value2 === "random") {
        echo '<!-- controls constantly show atm-->
        <div class="col-sm-12 col-md-5 col-md-push-7">
            <div class="controls">
                <h3>Controls</h3>
                <h4 class="controltype"></h4>
                <div id="controlcontent">';

                    include('index-00-controls.php');

                echo '<!-- end of controls -->
                </div>
            </div>
        </div>';
        }
        else {

        echo ' <!-- empty div for spacing on med and larger screens--><div class="col-sm-0 col-md-5 col-md-push-7">

        <h3 style="margin-left: 15px;"><small>This area intentionally left blank.</small></h3>

        </div>';

        }

    echo' <div class="col-sm-12 col-md-7 col-md-pull-5">
            <a href="#"> </a>';

                if ($value2 === "real" or $value2 === "none") {
                    echo '<div id="feed-'.$page_id.'">';
                    printTweets_SQL_short();
                    echo '</div>';
                }

                if ($value2 === "random") {
                    echo '<div id="feed2-'.$page_id.'">';
                    printTweets_SQL_rand_short();
                    echo '</div>';
                }

            echo '<!-- end of col-md-6 div-->
        </div>';


    echo '<!--end of row-->
    </div>

</div>
<!-- /feed+controls -->

<hr>';
?>
