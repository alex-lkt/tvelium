<?php
/* 
Template Name: Страница Вход
*/
?>
<?php 
    if ( is_page( 'auth' ) ) {
        get_header( 'home' );
    } else {
        get_header();
    }
?>

<?php if ( is_user_logged_in() ): ?>
    <?php
        // echo "<script>document.location.href='/kabinet';</script>";  
        echo "Авторизован!"  
    ?>
<?php else: ?>
<section class="main">
    <div class="container">
        <div class="main-homepage">
            <div class="homepage-form__wrapper">
                <div class="homepage-form__tabs tabs-btn">
                    <div class="tabs-btn__inner">
                        <div class="tabs-btn__item homepage-form__i btn-active">
                            <div class="tabs-btn__title tabs-btn--in">Вход</div>
                        </div>
                        <div class="tabs-btn__item homepage-form__r">
                            <div class="tabs-btn__title tabs-btn--reg">Регистрация</div>
                        </div>
                    </div>
                </div>

                <div class="homepage-form__content">
                    <div class="form__content form-content__in content-active">
                        <form id="get_auth" class="homepage-form__in" action="#">
                            <input type="text" class="homepage-form__input" name="userlogin" id="login" placeholder="Логин">
                            <input type="password" class="homepage-form__input" name="userpass" id="userpass" placeholder="Пароль">
                            <input type="hidden" name="action" value="truepostauth">

                            <div class="homepage-form__btn">
                                <button class="btn homepage-form__btn-btn">Войти</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="form__content form-content__reg">
                        <form id="get_reg" class="homepage-form__reg" action="#">
                            <div class="homepage-form__reg-inner">
                                <input type="text" name="firstname" class="homepage-form__input input-firstname" id="firstname" placeholder="Фамилия">
                                <input type="text" name="lastname" class="homepage-form__input input-lastname" id="lastname" placeholder="Имя">
                                <input type="text" name="surname" class="homepage-form__input input-surname" id="surname" placeholder="Отчество">
                            </div>
                            
                            <div class="homepage-form__reg-inner">
                                <input type="text" name="userphone" class="homepage-form__input input-phone" id="phone" placeholder="Телефон">
                                <input type="email" name="useremail" class="homepage-form__input input-email" id="email" placeholder="E-mail">
                            </div>
                            
                            <!-- <input type="text" class="homepage-form__input" id="login" placeholder="Логин"> -->
                            <input type="password" name="userpassword" class="homepage-form__input" id="pass" placeholder="Пароль">
                            <input type="text" name="refcode" class="homepage-form__input" id="codenum" placeholder="Код">
                            <input type="hidden" name="action" value="truepostreg">

                            <div class="homepage-form__text-box">
                                <label class="soglasie-label" for="soglasie">
                                    <input type="checkbox" name="soglasie" id="soglasie" class="custom-checkbox" checked>
                                </label>   
                                <span class="homepage-form__text">Я даю согласие на обработку моих<br>персональных данных</span>
                            </div>

                            <div class="homepage-form__btn">
                                <button class="btn homepage-form__btn-btn">Зарегистрироваться</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</section>
<?php endif ?>

<script>
    jQuery( function ($) {

        $('#get_auth').submit( function() {

            var form = $(this);
            //alert(form);
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
                data: form.serialize(),
                beforeSend: function(xhr) {
                    form.find('button').text('Отправляем запрос...');
                },
                success: function( data ) {
                    let login = data;
                    document.location.href = '/kabinet';
                    //document.body.insertAdjacentHTML('afterbegin', `<h1>Привет ${login}</h1>`);
                }
            });

            return false;
        } );

        $('#get_reg').submit( function(e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
                data: form.serialize(),
                beforeSend: function(xhr) {
                    form.find('button').text('Отправляем запрос...');
                },
                success: function( data ) {
                    console.log(data);
                    $('.homepage-form__r').hide();
                    $('.form-content__reg').removeClass('content-active');
                    $('.form-content__in').addClass('content-active');
                    //document.location.href = '/'; // kabinet
                }
            });
        });
        

    });
</script>

<?php get_footer(); ?>