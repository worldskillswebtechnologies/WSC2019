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
define('DB_NAME', 'wsc19_speed');

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
define('AUTH_KEY',         'f~$:uMy.ZX_^AizR3G,Wj9x3g|9JaFty%il{buaR=S(vcR0aNmU^~z@g4t$0mt%<');
define('SECURE_AUTH_KEY',  'ke?R@wr$5MpvaFn9uVw{;Lt8X*>6;kv+Pc!%!3f%Vp,Ne9zcRUBggn[+W=/q>CSy');
define('LOGGED_IN_KEY',    '8d|D;E2n.Ksq>%d}pRoNe(quE+p*:R/~UF-0idS4B=1DTUblRx3SD?dR*v nO,Cx');
define('NONCE_KEY',        'o*3y%l`Mun?@F6/8Cw6bs!ft)9m+R7b_uhwvkg#6g`GSBk`o@uz+m*&-I#;GvXiJ');
define('AUTH_SALT',        'p6[|i~]PT&RHwIb}Ioj(,{(Vc6:$EfKqJ>S=6`+ScD6kW*H~D$t,`4!JtayW{bT7');
define('SECURE_AUTH_SALT', '5Q9}(;LpE;JQF/%S&,zjeT!n8$pu,%k>+m:UP3C^@N)s?z4/B0cCBV3[j/cmhQa?');
define('LOGGED_IN_SALT',   'X}?6,#drX)_::7gB.p,z^7GCY(ZCsOtD(lX/]8u#*8Mz0D)eMR[Pwi_rhBcGmk5Y');
define('NONCE_SALT',       'r!KcOhjiI]-JS)ES2D&(1dNm2ZygwY?]s).x;oGow=4|ze3FYe(8C(U]Gst?A[ N');

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
