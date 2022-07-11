<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); echo " | "; bloginfo( 'description' ); ?></title>
	<link rel="icon" href="/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=PT+Sans&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body>

<?php
$user_role = 'author'; // Change user role here
$admins = get_role($user_role);
$admins->add_cap('upload_files');
$admins->add_cap('edit_published_pages');

$c_user = wp_get_current_user();

$user_adm = false;

foreach( $c_user->roles as $role ) {
    if ( $role == 'administrator' ) {
        $user_adm = true;
        ?>
        
        <?php
    }
    ?>
        <script>

        <?php
            echo "var user_adm ='$user_adm';";
        ?>
                
        </script>
    <?php
}
?>

<?php
    if( is_front_page() ) {
        include "include/header-home.php";
    } else {
        include "include/header-page.php";
    }
?>

