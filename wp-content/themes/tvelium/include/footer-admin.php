<div class="footer-mobile">

    <div class="footer-mobile__submenu">
        <ul class="main-asside__list">
            <li class="   <?echo $_SERVER['REQUEST_URI'] == '/resume/' ? 'current' : ''?>">
                <a href="/resume" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-resume.svg" alt="">
                    </span>
                    <span class="menu-li__title">Резюме</span>    
                </a>
            </li>
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/project/' ? 'current' : ''?>">
                <a href="/project" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-news.svg" alt="">
                    </span>
                    <span class="menu-li__title">Проекты</span>    
                </a>
            </li>
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/vacancy/' ? 'current' : ''?>">
                <a href="/vacancy" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-progekt.svg" alt="">
                    </span>
                    <span class="menu-li__title">Вакасии</span>    
                </a>
            </li>
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/news/' ? 'current' : ''?>">
                <a href="/news/?p=moderate" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-tehpoddergka.svg" alt="">
                    </span>
                    <span class="menu-li__title">Новости на модерацию</span>    
                </a>
            </li>
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/news/' ? 'current' : ''?>">
                <a href="/news/?p=delete" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-tehpoddergka.svg" alt="">
                    </span>
                    <span class="menu-li__title">Новости на удаление</span>    
                </a>
            </li>
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/addcopyriter/' ? 'current' : ''?>">
                <a href="/addcopyriter" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-tehpoddergka.svg" alt="">
                    </span>
                    <span class="menu-li__title">Копирайтеры</span>    
                </a>
            </li>
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/support/' ? 'current' : ''?>">
                <a href="/support" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-tehpoddergka.svg" alt="">
                    </span>
                    <span class="menu-li__title">Техподдержка</span>    
                </a>
            </li>
        </ul>
    </div>

    <ul class="footer-mobile__list">
        <li>
            <a href="/kabinet" class="footer-mobile__link <?echo $_SERVER['REQUEST_URI'] == '/kabinet/' ? 'active' : ''?>">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-lk.svg" alt="">
                </span>
                <span class="menu-li__title">Личный<br>кабинет</span>    
            </a>
        </li>
        <li>
            <a href="/clients" class="footer-mobile__link <?echo $_SERVER['REQUEST_URI'] == '/clients/' ? 'active' : ''?>">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-koschelek.svg" alt="">
                </span>
                <span class="menu-li__title">Пользователи</span>    
            </a>
        </li>
        <li>
            <a href="/news" class="footer-mobile__link <?echo $_SERVER['REQUEST_URI'] == '/news/' ? 'active' : ''?>">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-vacance.svg" alt="">
                </span>
                <span class="menu-li__title">Новости</span>    
            </a>
        </li>
        <li>
            <a href="#" class="footer-mobile__link" id="submenu-btn">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-menu.svg" alt="">
                </span>
                <span class="menu-li__title">Меню</span>    
            </a>
        </li>
    </ul>
</div>