
<?php
echo '<!-- instructions -->
<div class="instructions">

    <div class="row">
        <div class="col-md-2">
            <h3>Instructions</h3>
        </div>

        <div class="col-md-4">
            <h3><small>Imagine you are browsing this feed on a Sunday morning, while drinking coffee (or a similar leisurely browsing time). If controls are available, please use them while browsing your feed to make your ideal feed for leisurely browsing. Please browse for 30-60 seconds as you would in that situation.</small></h3>
        </div>';


        if ($value2 === "real" or $value2 === "random") {

        echo '<!-- controls constantly show atm-->
        <div class="col-md-6">
            <h3><small>Controls are available for this news feed. Please use them for 10-20 seconds to make your ideal feed for a Sunday morning drinking coffee (or other leisurely browsing time).</small></h3>
        </div>';
        }else{ echo '<!-- no controls -->
        <div class="col-md-6">
            <h3><small>No controls are available for this news feed. This area intentionally left blank.</small></h3>
        </div>';
        }

echo '<!--end of the row-->
    </div>

</div>
<!-- /instructions -->


<!-- feed+controls -->
<div class="feed+controls">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-sm-push-6">
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


        if ($value2 === "real" or $value2 === "random") {
        echo '<!-- controls constantly show atm-->
        <div class="col-md-6 col-sm-6 col-sm-pull-6">
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

    echo '<!--end of row-->
    </div>

</div>
<!-- /feed+controls -->

<hr>';
?>
