<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'tvelium_db' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/* Настройка SMTP */
// Имя пользователя для SMTP авторизации
define( 'SMTP_USER', 'info@alex-lkt.ru' );  
  
// Пароль пользователя для SMTP авторизации
define( 'SMTP_PASS', 'U9t$x7C@' );
  
// Хост почтового сервера
define( 'SMTP_HOST', 'smtp.beget.ru' );
  
// Обратный Email
define( 'SMTP_FROM', 'info@alex-lkt.ru' );
  
// Имя для обратного мыла
define( 'SMTP_NAME', 'tvelium.ru' );
  
// Номер порта (25, 465, 587)
define( 'SMTP_PORT', '465' );
  
// Тип шифиования (ssl или tls)
define( 'SMTP_SECURE', 'ssl' );
  
// Включение/отключение шифрования
define( 'SMTP_AUTH', true );
  
// Режим отладки (0, 1, 2)
define( 'SMTP_DEBUG', 0 );

/* 
* Настройки депозита 
*/
// Сумма взноса полная
define( 'DEPOSIT_SUMM', 180000 );
// Сумма взноса полная
define( 'DEPOSIT_MONTH', 3000 );
//Сумма ежемесячной выплаты
define( 'REFPAY_0', 0 );
define( 'REFPAY_1', 10000 );
define( 'REFPAY_2', 15000 );
define( 'REFPAY_3', 30000 );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '_Oe(QNQwiS$[5&Q2/xIpv9z=JpnKf]m$II4P>zP|%!)qXqxB7#]u_LpY7fn<F5a@' );
define( 'SECURE_AUTH_KEY',  '9TkU3aBG !e?z__F7R!paZ|e^E~57~61,i00Y1*i9(D&[sF5!]we&:#)M/x-8]w}' );
define( 'LOGGED_IN_KEY',    'G]C,&t wQQT?5`d+v=$sN[>nhp-t/io0mCxM2(J8 u] jVlpHp>js6)}$L`}Z$sb' );
define( 'NONCE_KEY',        ' 7)Ag4(B0pRmmc@Ed}=]4%|nQe^SQi18[I|09v?Eixm]pazUWJME~zto<K1S&6QR' );
define( 'AUTH_SALT',        'x^I#F_5|9P|d/<JV[[yo@o*FOn2;_D=k+6uYehH$ICcm7y_wk6cmfF;?krWfMo+P' );
define( 'SECURE_AUTH_SALT', '^jb%psGW{JM#^sT`5 M`hL^@7~N<ude/nUYOg3XWq&hJ!9[Dex8f`1cT~h=s/-:s' );
define( 'LOGGED_IN_SALT',   'K$#O9s8DA<Fh)nXgx?xJ~of86b(|Lv,`22a0bV?cB0F!{W{l(-98HT}+/<A@2)/s' );
define( 'NONCE_SALT',       'X9gOl:4FMLTk{Vlyl;`,g]pUgf/XQgg*ysNa`V#s}da32[F^`67O</4Mfi}5+&V.' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'tv_';

define('ALLOW_UNFILTERED_UPLOADS', true);

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
