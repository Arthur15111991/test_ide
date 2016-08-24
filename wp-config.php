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
define('DB_NAME', 'test_ide_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '369970');

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
define('AUTH_KEY',         ',T3@zx<wW;)x8c^;Y-WG#`^6rh{s} `(FGTLm:sf.qJ7n<I9H_U8>v4}5gMk4O3-');
define('SECURE_AUTH_KEY',  ' GYf/#ow1B!5tMe?Q+<K.{_$6]x~oNF4xd*`V?M>7H8T3p2WQp8S9t MEZS 8j1f');
define('LOGGED_IN_KEY',    'k!lC/Y,QL[5#FFFnC`RVcr3db0jKwugrs*cFrt;[%v=|jh9zQ[^wWU8FY5RBplWp');
define('NONCE_KEY',        '{UB%tvzWcEM4z#$CY;0o28d=bjHEH[!VgoE`vAaH{&e!A]vcILoUD06Fx*eCIo,u');
define('AUTH_SALT',        'feK28Np`eG>m 0-,Y2`O<.kLBT4NJx7ier+{hI=w ;eai_fTPAud-SU2#%ug=PB,');
define('SECURE_AUTH_SALT', 'q%1A^+OvD,0#$EAmF;OJpSyWG!3B%)>w<95b{PT=H_},Rb`{6N<gBKpbb<zO2wtu');
define('LOGGED_IN_SALT',   'g<U!A-*>vqesp{$O42t^7Ao37gby`=Cy6w]S_Y,2[^LP?Sk,fK7/(r;5a02Z0?vv');
define('NONCE_SALT',       'X;L)>d,K<0Y_[T5Q@a8|<_?m9s[<3_CKX{Y47qx%319$MTD|w0L~w^RFvlt/4)u$');

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
