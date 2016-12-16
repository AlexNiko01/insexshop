<?php
define('WP_CACHE', true); // Added by WP Rocket
//define('WP_CACHE', true); // Added by WP Rocket


/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
 //Added by WP-Cache Manager
//define( 'WPCACHEHOME', '/home/raskrutk/public_html/insexshop.com.ua/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define( 'WPLANG', 'ru_RU' );
define('DB_NAME', 'insexshoprez');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

define('DISALLOW_FILE_EDIT', TRUE); // Sucuri Security: Wed, 21 Oct 2015 17:30:39 +0000


/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
//define('AUTH_KEY',         '@S;F{Uo)BLn#lCv r+6!`3FPL[y=^X0d#I^v^_k- )0@:{$#j@TC iT|O,a-W{@J');
//define('SECURE_AUTH_KEY',  '<W1pi?R)fqujo]Y)kfg(xZTiP}GjBPEi#-1X@Q(Xi8a.#-S1|+Oi.}h[S!X:1[8%');
//define('LOGGED_IN_KEY',    'OH!j:ddb:JG+=DR>me^8.b4x0 sv4QA+=*SJa~g);p_o)<F6O~s=86zyBK)rWJI&');
//define('NONCE_KEY',        '!Og!}qIDprLa!J|:urkY%UQ+zx|a))2s+4bv KaTOTD+k;:ct#byG7zg+fI6UOy*');
//define('AUTH_SALT',        'zCnj.n^Q|_S)}Jv7bB2^&%N7m!oD1yq/.v]f&SywE1P;P-$L6W+Dx{b%R,O)yzc@');
//define('SECURE_AUTH_SALT', 's+(|ffD: )PV5AntGO+X)32(mmcg|FuzwZbv776V-)M,jt=B./.|_#G.-Q2k+x0L');
//define('LOGGED_IN_SALT',   '0+-i5JOQ,xUXPDz+|3:Lg~jC*+5KR+P:j)*GbY@8|glsi4t$;qg|]>1B^y[A@4+|');
//define('NONCE_SALT',       'ZiE1A2$%?V2WcjW#*L5;|RI|%eUO9Xw*v#{m;%SxjSklX_(!q->Wg$kI9q1].a>?');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);
//define('WP_POST_REVISIONS', 3);
//define('AUTOSAVE_INTERVAL', 300);
/* Это всё, дальше не редактируем. Успехов! */
//define( 'WP_MEMORY_LIMIT', '4000M' );
/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
define('WP_HOME','http://wp.abedor-rez.loc');
define('WP_SITEURL','http://wp.abedor-rez.loc');
/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
