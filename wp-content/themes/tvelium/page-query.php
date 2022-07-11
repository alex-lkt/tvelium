<?php
    if ( !is_user_logged_in() ) {
    }
?>

<?php
//global $current_user;

$_SESSION['post_query'] = $_POST;

// print "WMI_RESULT=" . strtoupper("OK") . "&";
// print "WMI_DESCRIPTION=" .urlencode("ok_message. page query");

wp_vardump( $_SESSION );
wp_vardump( $_POST );
exit;   




?>
