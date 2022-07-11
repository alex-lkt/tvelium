<header class="header">
    <div class="container">
        <div class="header-wrapper">
            <div class="main-asside__header">
                <div class="main-asside__logo">
                    <a class="main-asside__link" href="/">
                        <img class="main-asside-logo__img" src="<?php echo get_template_directory_uri() ?>/assets/images/logo-2.svg" alt="Tvelium.ru">
                    </a>
                </div>
            </div>

            <div class="main-inner__header">
                <div class="main-inner__informer">
                    <?php if ( $user_adm ): ?>
                    <div class="balans__box">
                        <span class="btn-admin__text">Баланс: </span>
                        <span class="btn-admin__summ-out">900 000</span>
                        <span class="summ__box-ico">
                            <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 0V14H0V16H2V20H4V16H10V14H4V11H11.5C14.526 11 17 8.526 17 5.5C17 2.474 14.526 0 11.5 0H2ZM4 2H11.5C13.444 2 15 3.556 15 5.5C15 7.444 13.444 9 11.5 9H4V2Z" fill="#005300"/>
                            </svg>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="main-inner__icon--box">
                    <div class="main-inner__info">
                        <?php foreach( $c_user->roles as $role ): ?>
                            <div class="main-inner__info--user"><?php echo $c_user->display_name ?></div>
                            <div class="main-inner__info--role">
                                <?php 
                                switch ($role) {
                                    case 'administrator':
                                        echo "администратор";
                                        break;
                                    case 'author':
                                        echo "редактор";
                                        break;
                                    // case 'subscriber':
                                    //     echo "пользователь";
                                    //     break;
                                }
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="main-inner__info">
                        <button class="main-inner__info--btn btn-info"></button>
                    </div>
                    <div class="main-inner__info">
                        <a class="main-inner__info--btn btn-logout" href="<?php echo wp_logout_url( home_url() ); ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/logout.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>