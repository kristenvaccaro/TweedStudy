<?php
	session_start();
    
    
    $keepkeys = ["real_ranks","user_id","real_popularity",'user','oauth_access_token','oauth_access_token_secret'];
    foreach($_SESSION as $key => $val)
    {
        
        if (!in_array($key, $keepkeys))
        {
            
            unset($_SESSION[$key]);
            
        }
        
    }

    $_SESSION['current_page'] = _id;

?>
