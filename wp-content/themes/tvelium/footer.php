<?php
global $current_user;
?>

<?php 
    if ( is_front_page() ) {
        $footer_home = "footer-home";
    } else {
        $footer_home = "";
    }
?>

    <footer class="footer <?php echo $footer_home ?>">
        <div class="container">
            <div class="footer__wrapper">
                <div class="footer__logo">
                    <a href="/">
                        <img class="footer-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/logo-footer-monochrom.svg" alt="Tvelium.ru">
                    </a>
                </div>
				<div class="pay-cart">

                    <div class="pay-cart__img">
                        <img class="footer-pay-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/pay-cart/pay-keeper.png">
                    </div>              
                    <div class="pay-cart__img">
                        <img class="footer-pay-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/pay-cart/visa.png">
                    </div>
					<div class="pay-cart__img">
                        <img class="footer-pay-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/pay-cart/mastercard.png">
                    </div>
					<div class="pay-cart__img">
                        <img class="footer-pay-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/pay-cart/mir.png">
                    </div>
					<div class="pay-cart__img">
                        <img class="footer-pay-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/pay-cart/spb.png">
                    </div>
                    
				</div>
                <div class="footer__copy-box">
                    <div class="footer__politic">
                        <a class="politic__link" href="/privacy-policy" target="_blank">Политика конфиденциальности</a>
                        <a class="politic__link" href="/dogovor-oferty" target="_blank">Договор-оферта</a>
                    </div>
                    <div class="footer__copy">
                        &copy; <?php echo date ( 'Y' ) ; ?> Все права защищены<br>
                        E-mail: <a href="mailto:admin@tvelium.ru">admin@tvelium.ru</a>
                    </div>

                </div>
            </div>
        </div>
    </footer>

<?
if ( !is_home() ) {
    echo "</div><!-- .wrapper -->"; // .wrapper
}
?>

    <?php
    if ( is_user_logged_in() ) {
        foreach( $current_user->roles as $role ) {
            switch ($role) {
                case 'administrator':
                    include "include/footer-admin.php";
                    break;
                case 'author':
                    include "include/footer-copyriter.php";
                    break;
                case 'subscriber':
                    include "include/footer-user.php";
                    break;
            }
        }
    } 
    ?>

    <!-- <button class="modal-show" >Show</button> -->

    <div class="modal-wrap hide" id="error-in">
        <div class="modal">
            <a href="#close" title="Закрыть" class="modal-close">X</a> 
            <div class="modal-content"></div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>

