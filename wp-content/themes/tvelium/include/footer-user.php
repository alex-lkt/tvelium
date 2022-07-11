<div class="footer-mobile">

    <div class="footer-mobile__submenu">
        <ul class="main-asside__list">
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/resume/' ? 'current' : ''?>">
                <a href="/resume" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-resume.svg" alt="">
                    </span>
                    <span class="menu-li__title">Резюме</span>    
                </a>
            </li>
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/news/' ? 'current' : ''?>">
                <a href="/news" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-news.svg" alt="">
                    </span>
                    <span class="menu-li__title">Новости</span>    
                </a>
            </li>
            <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/project/' ? 'current' : ''?>">
                <a href="/project" class="menu__link">
                    <span class="menu-li__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-progekt.svg" alt="">
                    </span>
                    <span class="menu-li__title">Подать свой проект</span>    
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
            <a href="/purse" class="footer-mobile__link <?echo $_SERVER['REQUEST_URI'] == '/purse/' ? 'active' : ''?>">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-koschelek.svg" alt="">
                </span>
                <span class="menu-li__title">Кошелек</span>    
            </a>
        </li>
        <li>
            <a href="/vacancy" class="footer-mobile__link <?echo $_SERVER['REQUEST_URI'] == '/vacancy/' ? 'active' : ''?>">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-vacance.svg" alt="">
                </span>
                <span class="menu-li__title">Вакансии</span>    
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