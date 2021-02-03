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
define('DB_NAME', 'wsc19_cms_module');

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
define('AUTH_KEY',         'WX*iXq[d5PZvD}Fqo~9I:JcMUv|u()@}>3x^x2Vxg=f(+sz^y&B3gqMX,*RoxDNX');
define('SECURE_AUTH_KEY',  '_@s}]*$2ZY[rSwo(J+Z:ZshVKBjKIA+xqrP(hES0+lx&6bQ*UX/l]U]8eQS9b- D');
define('LOGGED_IN_KEY',    ';<!h4Vp{bPoP6~E;g4D);`qa!Qb89}0m_E[0d2o`Lm[k%o35ydKl7pX|U4LCz_#p');
define('NONCE_KEY',        'IFWfK%M1@ d8EsC4K,c+T9Gr5D[ZwbXrziI)<k!$m:um|#U2tvT[1rDs#j /BP%f');
define('AUTH_SALT',        'xs4zYINxN#B@67^Dq#Zm,o,bY%ZZ,~DC{U;R43!%8^<_@Y@uzH&#AP&{4tS,92zI');
define('SECURE_AUTH_SALT', 'po4N<r?a[h(ZD9!bLe0d|7jXr1v>9d_tG%}U={JK:|KrBh&}LBH5c%lpK_Z|[:3Z');
define('LOGGED_IN_SALT',   '}~L$zj643U33Rr <#Xa|n/XL~W.[#59PO|<T15qvt(H? @tCGk;y3.0-G-h7wkjd');
define('NONCE_SALT',       '>RK.fPbw_vY_z(JG9FhMDm[i8BN,7b~~pHNFB&%}Owb0(i@pHAk*KVbJ|D{ Ba].');

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
