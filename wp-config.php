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
define('DB_NAME', 'ntkdesign');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'Wk]xRX ({p/[m1ZIp#zKn8ad}%If&G2[*c6.0NSEjgri86DNhD0wSGo-5Hg{iQLm');
define('SECURE_AUTH_KEY',  'UK3 tyb$3.q|c~x~|*q[w&VXsTcjG`h,!d@~ITX&2gqQqD^1jv]#J:(eLYZGx$FQ');
define('LOGGED_IN_KEY',    'lsiE/Ig<)x8~?%8mq.2sKuhI2bI+E:wgol{HW*Uyxj*xP(C2E< vh6SWA*T`R85b');
define('NONCE_KEY',        '5H^B8~!(_$psd{[qKKa]R_@AEOVTZ7GVz]s91x&`=R`^_pa&4[j%9;AA_,~Vd0+R');
define('AUTH_SALT',        '^fJgX)SX8q|Q8|?1dY>)CCX(*7EuO5?ywdx9I]w8dko)UDrr|J_PTx7Rd :c>ZZ9');
define('SECURE_AUTH_SALT', '7]VTD%v;VaysuZk,`7jGj3(e7F[_%^.|<v(kk.eWYG%1r=)}WVC-Xe2WrX|e{9uG');
define('LOGGED_IN_SALT',   '#qs0-]X}%{6Zi} oT~m<iVzuvpX~&N{+72m`eky.eI/W[W+okfNVCe25E3>8m~O)');
define('NONCE_SALT',       'H;jyb<=A2{_Zi)1JO4<8np;4`vJOB<Z&rY?gvYL.2de&TJl>U5O7AJ*}1d&J(?1!');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ntk_';

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
//Disable File Edits
define('DISALLOW_FILE_EDIT', true);