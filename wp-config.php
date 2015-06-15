<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp-vaci');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '77PDr-(.awNpI-EH|VD<xTXYNaQ8K8z21OAZK7/W[&WCd;[@L~e)?05WYg~G-!(-');
define('SECURE_AUTH_KEY',  'Tmn/,hPQ++sXJ!%YuEaT&6,nmVA[eXkcS-n2xVdGZMpPj9Pm`3&+F]7An&,G =#O');
define('LOGGED_IN_KEY',    'g-Ob4.;K52apz~yWNAm =*[FVI~oqT4@c!Vu^11=Y[/0|bR+##$zk1!Ucz`fXG-m');
define('NONCE_KEY',        '-*9CGywir%uF8%%&uYKJ263*m:7MKHX{t$)[+kVuoc&U<OGI$J.)C7CtJ]wb+sY*');
define('AUTH_SALT',        '@FfldI0jME|l|Q2agOIt3![Lxvi-IA,{m,:l)2gD]I7G/C{}csOK:!VrAN $<aQ<');
define('SECURE_AUTH_SALT', '[E|XG2B~A}mB0)=oDQxh_8O/DW^[:ONvmqtq@J*Z&Ykif9sn{Ff(P4$SNSg]ZbSc');
define('LOGGED_IN_SALT',   '~C+nidA!RaN=|iqhpt+|+)~uhw$HnRy.9FY DJtC||[j<^uw,o|9<[z:J9$uDwOT');
define('NONCE_SALT',       'PI+2_K;i>J8CcbH82):_<*>()|tPYfO(pi-Z=1~48A{VR`+/KlWOun+?(@).A3>-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'vaci_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
