<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sgproperty');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '6*VdboMPSoz,w{ZL=OSqE|k&L?r%=U2m9,{4Z}Exzx+:~s3&vQam.d.Rdr)}$+>@');
define('SECURE_AUTH_KEY',  'Mv*)?KT.gQ qp`>OujDxx+I.<D_2k?hsf=eiIEtSXEX,U0~ZW+8 Cen!|<iye~im');
define('LOGGED_IN_KEY',    '45(+e^~h&$C|-k-uWUt(!PfggcD<85su8MB3(z=/iK+i~c:&GBm]2aIcJ`~+x)^^');
define('NONCE_KEY',        'Ps+nqPw=J#ul1$!Tuv&-EZUCrGTF[+a+Cm=Teh)ty1Uz-,ps<NGAh>6+S*+sn^>1');
define('AUTH_SALT',        'f(s`WC!%UHiT&`a=VeBu8F-5VW W$+aP[_=?24Y-YEiEc(J,COX|,-dX4OqYi6<}');
define('SECURE_AUTH_SALT', 'WE-k64~Q:C,7&VT,&@TNI9A l)$D+Tt,t__&<t:Zr#IPPKY/fGev%X==s]0z~lQV');
define('LOGGED_IN_SALT',   'prg]7A+n0kCa(~LS f?q~Cx~EbA,-`V?T^G,{}F(@b55}ip<$*2ux[T>2gg5pp8L');
define('NONCE_SALT',       '_=W^X!9!C58pN?2Y(p{+OJ Wx=<uB|e!/)R)ZQK>?fS,(h+a)-E+jR|F{+o3-?pj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
