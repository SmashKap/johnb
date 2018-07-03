<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'johnb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'B}S:2o?^D#B=f8m:.V)+Oq=Rx*u?F8gO/)o7.xDoeZp5IaC@7P<C ukMsbU^56J=');
define('SECURE_AUTH_KEY',  '_|%WsJ2gT+sQ|9(sGD_Z:A2Sun=S:/7%H(f+umi>dd$Tb5>ZTw>ENX;SITa+!~/S');
define('LOGGED_IN_KEY',    'o*uOCZ}u7cVc%<1vK#_f<-oT9yI6NoJ2jB<yrCNHND|lZoZ|KSuPPAQU2|Ayj2=U');
define('NONCE_KEY',        'g1T^z^nS9F]I~1}X0*DP QEN4;AkK^o7@ka##{,&Y<qsd)Y._Oo^30TlVsK!+;Y~');
define('AUTH_SALT',        'h8W%,ynt.(yLqe{.!w9a{exsJ&?`m<gjxfE/B[:0P,NQ<X0Ll~VUs[,(paJY!RnQ');
define('SECURE_AUTH_SALT', ';.Y]hJOgsv|mGIC+-Q$7o+z8+/W<FOF-QO/_xc87/sXVu~PWBn9x%:(<?;*5[L?v');
define('LOGGED_IN_SALT',   'atS!8Md1O5V1%9rt>@uiZFf<Y|mq)s?3HD|tA^WN{khWy{.Z9T@G<FdOM->ya2&K');
define('NONCE_SALT',       'sB>%^E:4>qXCxjpBX26dmLg?iWY%g:SmKOb:qOC[im,lw-=]NrU%k4k?-VbS_d=J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
