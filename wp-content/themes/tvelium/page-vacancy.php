<?php
/* 
Template Name: Страница вакансии
*/
global $current_user;
?>
<?php
    if ( !is_user_logged_in() ) {
        echo "<script>document.location.href='/';</script>";
    } 
?>

<?php get_header();?>

<section class="main">
    <div class="main-wrapper">

    <?php
    foreach( $current_user->roles as $role ) {
        switch ($role) {
            case 'administrator':
                include "include/main-asside-admin.php";
                include "include/main-content-adminvacancy.php";
                break;
            case 'subscriber':
                include "include/main-asside-user.php";
                include "include/main-content-uservacancy.php";
                break;
        }
    }
    ?>

    </div>
</section>

<?php get_footer(); ?>