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
        echo "<script>document.location.href='/kabinet';</script>";  
        //header( 'Location: /kabinet' );  
    ?>
<?php else: ?>


        <section class="main homepage-content-wrapper">
            <div class="homepage-home__wrapper">
                <h2 class="homepage-home__name">Твелиум</h2>
                <h1 class="homepage-home__title">клуб развития бизнес-проектов</h1>
                <ul class="homepage-home__list-text">
                    <li class="list-text">проекты</li>
                    <li class="list-text">вакансии</li>
                    <!--<li class="list-text">инвестиции</li>-->
                </ul>
                <div class="homepage-home__btn">
                    <div class="btn-content home-btn">Подробнее</div>
                </div>
            </div>

            <!-- <a name=""> -->
            <div class="homepage-home__info-wrapper" id="project">
            
                <div class="homepage-home__info-box">
                    <div class="info-box__inner">
                        <div class="info-box__title">Необходима помощь по <span>стартапу</span>?</div>
                        <div class="info-box__desc">
                            У вас есть интересный проект?<br>
                            Вы хотите помощи в его реализации?
                        </div>
                        <div class="info-box__text">
                          
                        «Твелиум» – это портал, который помогает начинающим и опытным предпринимателям найти финансирование для проектов и существующих бизнесов
              
                        </div>
                    </div>
                    <div class="info-box__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/bg-info-investor.svg" alt="">
                    </div>
                </div>

                <div class="homepage-home__info-box">
                    <div class="info-box__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/bg-info-menedgment.svg" alt="">
                    </div>
                    <div class="info-box__inner">
                        <div class="info-box__title">Хотите <span>работать</span> на руководящей<br>должности?</div>
                        <div class="info-box__desc">
                            Мы публикуем вакансии на руководящие должности в будущих проектах — это наша визитная карточка
                        </div>
                     <div class="info-box__text">
                            Попасть на работу в интересный проект вы можете двумя способами:
                            <ul class="content-style-ul">
                                <li>разместить резюме;</li>
                                <li>откликнуться на вакансию.</li>
                            </ul>
                        </div>
                    </div>
                </div>
				
				
				        <div class="homepage-home__info-box">
                <div class="info-box__inner">
                    <div class="info-box__title"><span>Думайте</span> о будущем</div>
                    <div class="info-box__desc">
                        <span>Получите дополнительный доход!</span><br>
                      <!--  Для этого достаточно инвестировать в проект-->
                    </div>
                    <div class="info-box__text">
                        Все сделки по финансированию имеют юридическую силу<br>и подтверждаются договором. Вы сможете реализовать проекты вместе с нами и получать гарантированный доход.
                    </div>
                </div>
                <div class="info-box__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/bg-info-history.svg" alt="">
                </div>
            </div>

              <!--   <div class="homepage-home__info-box">
                    <div class="info-box__inner">
                        <div class="info-box__title"><span>Бизнес</span> клуб</div>
                        <div class="info-box__desc">
                            <span>Получите дополнительный доход!</span><br>
                            Для этого достаточно стать абонентом клуба.
							
                        </div>
                        <div class="info-box__text"> 
                           «Твелиум» – это портал, который помогает начинающим и опытным предпринимателям найти финансирование для реализации  Все сделки по финансированию имеют юридическую силу<br>и подтверждаются договором. Вы сможете инвестировать в проекты вместе с нами и получать гарантированный доход.
                        </div>
                    </div>
                    <div class="info-box__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/bg-info-history.svg" alt="">
                    </div>
                </div>-->

                <!-- <a name=""> -->
                <div class="homepage-home__info-box-full" id="work">
                    
                    <div class="info-box-full__title">Чем <span>полезен</span> наш клуб?</div>
                    <div class="info-box-full__wrapper">
                        <div class="info-box__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/bg-info-polesen.svg" alt="">
                        </div>
                        <div class="info-box__inner">
                            <div class="info-box__inner-box">
                                <div class="box__inner-box__1">
                                    <span class="inner-box__num">01.</span>
                                    <div class="inner-box__text"><!--Инструмент поддержки начинающих предпринимателей-->Удобный поиск актуальных проектов</div>
                                </div>
                                <div class="box__inner-box__1">
                                    <span class="inner-box__num">02.</span>
                                    <div class="inner-box__text">Резюме высших руководителей и директоров</div>
                                </div>
                                <div class="box__inner-box__2">
                                    <span class="inner-box__num">03.</span>
                                    <div class="inner-box__text">Удобный инструмент для партнеров, с помощью которого, не отрываясь от бизнес-процессов, можно рассматривать перспективные проекты и узнавать о трендах рынка</div>
                                </div>
                            </div>
                           <!-- <div class="info-box__inner-text">Собственники, учредители и топ-менеджеры, прошедшие все этапы предпринимательского пути <span>основная ценность нашего клуба!</span></div>-->
						   
						    <div class="info-box__inner-text">Благодаря авторитету, качественному сервису и эффективности клуба –<span>нам доверяют!</span></div>
						   </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="main homepage-content-wrapper-auth">
            <div class="main-homepage">
                <div class="homepage-form__title">Готовы <span>стать</span> частью нашего клуба?</div>
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
                    
                    <!-- <a name="auth"> -->
                    <div class="homepage-form__content" id="auth">
                        
                        <div class="form__content form-content__in content-active">
                            <form id="get_auth" class="homepage-form__in" action="#">
                                <input type="text" class="homepage-form__input" name="userlogin" id="login" placeholder="Логин">
                                <input type="password" class="homepage-form__input" name="userpass" id="userpass" placeholder="Пароль">
                                <input type="hidden" name="action" value="truepostauth">

                                <div class="homepage-form__btn">
                                    <button class="btn homepage-form__btn-btn">Войти</button>
                                </div>
                                
                            </form>
                            
                            <div class="tabs-btn__item">
                                <button class="btn-new-pass">Восстановить пароль</button>
                            </div>
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
                                    <input type="text" name="city_prof" class="homepage-form__input input-city" id="city" placeholder="Город">
                                </div>
                                
                                <!-- <input type="text" class="homepage-form__input" id="login" placeholder="Логин"> -->
                                <input type="password" name="userpassword" class="homepage-form__input" id="pass" placeholder="Пароль">
                                <input type="password" name="repeat_password" class="homepage-form__input" id="pass" placeholder="Повторите пароль">
                                <input type="text" name="refcode" class="homepage-form__input" id="codenum" placeholder="Код">
                                <input type="hidden" name="action" value="truepostreg">

                                <div class="homepage-form__text-box" id="form__checkbox">
                                    <label class="soglasie-label" for="soglasie">
                                        <input type="checkbox" name="soglasie" id="soglasie" class="custom-checkbox" value="1" checked>
                                        <span></span>
                                    </label>   
                                    <a href="/privacy-policy" target="_blank" class="homepage-form__text">Я даю согласие на обработку моих<br>персональных данных</a>
                                </div>

                                <div class="homepage-form__btn">
                                    <button class="btn homepage-form__btn-btn">Зарегистрироваться</button>
                                </div>
                            </form>
                        </div>

                        <div class="form__content form-content__pass">
                            <?php 
                                echo do_shortcode( '[custom_passreset]' ); 

                                if (isset($_SESSION['pass_error']) AND !empty($_SESSION['pass_error'])):
                            ?>
                                <script>
                                    $(function () {
                                        
                                        let contentBtn = document.querySelectorAll('.tabs-btn__item');
                                        let contentBox = document.querySelectorAll('.form__content');
                                        let contPassBox = document.querySelector('.form-content__pass');
                                        
                                        if (contentBox) {
                                            contentBox.forEach((item, key) => {
                                                for(let i = 0; i < contentBox.length; i++) {
                                                    contentBtn[i].classList.remove('btn-active');
                                                    contentBox[i].classList.remove('content-active');
                                                };
                                            });
                                            contPassBox.classList.add('content-active');
                                        }

                                    });
                                </script>
                            <?php
                                    $_SESSION['pass_error'] = '';
                                endif;

                                if (isset($_SESSION['new_pass_ok']) AND !empty($_SESSION['new_pass_ok'])):
                            ?>
                                <script>
                                    $(function () {
                                        let mess = "<?php echo $_SESSION['new_pass_ok']?>";
                                        chips(mess);
                                        return false;

                                        function chips(message, timeremove = 3000) {
                                            let chips = document.createElement('div');
                                            chips.classList.add('chips-message');
                                            chips.innerHTML = message;
                                            //console.log(chips);return;
                                            showModal(chips);
                                            setTimeout(function() {
                                                closeModal()
                                            }, timeremove);
                                        }

                                        function showModal(chips) {
                                            let modalBox = document.querySelector('#error-in');
                                            let modalContent = modalBox.querySelector('.modal-content');
                                            //console.log(modalBox, modalContent, chips);return;
                                            modalContent.appendChild(chips);
                                            modalBox.classList.remove('hide');
                                            document.onkeydown = function(event) {
                                                if (event.keyCode == 27) {
                                                    closeModal();
                                                }
                                            }
                                        }
                                        function closeModal() {
                                            //console.log( this );
                                            document.querySelectorAll('.modal-wrap').forEach(function(element) {
                                                element.classList.add('hide');
                                                element.querySelector('.modal-content').innerHTML = '';
                                            });
                                            document.onkeydown = null;
                                        }
                                    });
                                </script>
                            <?
                                $_SESSION['new_pass_ok'] = '';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>  
            </div>
        </section>
    </div>
</div> 
<?php endif ?>

<script>
    jQuery( function ($) {

        // $('#get_auth').submit( function() {

        //     var form = $(this);
        //     //alert(form);
        //     $.ajax({
        //         type: 'POST',
        //         url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
        //         data: form.serialize(),
        //         beforeSend: function(xhr) {
        //             form.find('button').text('Отправляем запрос...');
        //         },
        //         success: function( data ) {
        //             let login = data;
        //             document.location.href = '/kabinet';
        //             //document.body.insertAdjacentHTML('afterbegin', `<h1>Привет ${login}</h1>`);
        //         }
        //     });

        //     return false;
        // } );

    });
</script>

<?php get_footer(); ?>