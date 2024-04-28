<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'sE5F?jpXa|92eJ~~YNk_q-s5Ml>=&^<W#w3+Bwn.=#8;>fhscnaK:UDT^dd1?/AP' );
define( 'SECURE_AUTH_KEY',   '-Id3%$WXzfyxKj67Oc`3/sG* qJ>a^5@6tq0X;nRr_X)3^ZJHI~8)a@kIpPZlLmS' );
define( 'LOGGED_IN_KEY',     'kniOi+b!Y`,ipXWvWu|{Swx./ww@1xWC7R[-!F#$Ev:B2U]YC5cUvJ~Z3J_O#1]_' );
define( 'NONCE_KEY',         'BNaa0EN{JT:rUx%;J]55iX*-Y_Wt62.6SCi(_g3Wn#Tp]@7|%&!g7=NSrh`lr=QW' );
define( 'AUTH_SALT',         '6DxvAj)|-nds7UnE{KD`P>g[9 bUwEA2iM+q5N|Pj5c=V@hG(LZ=uX@1Gc8-:[1S' );
define( 'SECURE_AUTH_SALT',  ':,{=/:vVHPEx#V.kjobu)9K+[xzxd6j8vc8_bDxj_dX&{xHU,fcLeff_ qcDeFcb' );
define( 'LOGGED_IN_SALT',    'YN(lNAWPw^bn}}7&1=V1<;j?^elzC(joZFUfGf:hMex5Vd=;:xLm}SB7+(poF*|*' );
define( 'NONCE_SALT',        '>~yf~QPbpQp7fO >VjGR7:u}Y|AHe#Cg=a1yu5aSqY{.c<(%Nj9wciUV-(s6o&Rr' );
define( 'WP_CACHE_KEY_SALT', 'K)4j&Ir}4*njS%.6W:!X6J07SN+daEH~Megt<:k[;/nW$!`*0% .GW0cSn$hf4d(' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}

define( 'WP_DEBUG_DISPLAY', true );

define( 'WP_DEBUG_LOG', true );

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
