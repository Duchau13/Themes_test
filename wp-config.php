<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'testgo' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'dwYd3s<>Q6N+f3pNm3J^|5Vpk(z^{Uu,U;?Moft5B>4/OIk@. OY<BgQ9qn^A:@:' );
define( 'SECURE_AUTH_KEY',  'RRmdH|A}nq>x zhbR[]`]p;K*7+0[EQiY1${K]ii*k,T(6=19gUztn] }&KS1c#p' );
define( 'LOGGED_IN_KEY',    '$)1<EBGp[&*C >gDWG>$x?uh+/W:|iiU}bG9T>W1C<^jX+RqG]N1nZ?zd.bQ{E@I' );
define( 'NONCE_KEY',        '>v0[4HncMm2M,UO3HsukFd<,W.[:i1:dA>:TF?WiHax%HF#0p1E<8J#;njkJR^re' );
define( 'AUTH_SALT',        'wP)-=`3#e:[?Gv-t23647rf>8xeAOLZ&m?f$!LDyI>B@O;yIFHZ5+[QPe%F9H3B.' );
define( 'SECURE_AUTH_SALT', 'za6uH`&HD6^#)}7(~iE:]LasA_EU?nA)F#2Naj%l.-Fsm1hqG5Cvg6S`cld3I>IA' );
define( 'LOGGED_IN_SALT',   'FmsM+LMr6y7}!*4xO+9~@WM>GS:~+v.t<?R8Aqo}$9F*;@~2/p?H9;R4^Z3XDhhM' );
define( 'NONCE_SALT',       'sJ742@lX=b[r)2ZArtUx7|ru5?E|^>R?1ZH|Z2WD-aah0I^ACQSNWgR 8[SqQ^5L' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
