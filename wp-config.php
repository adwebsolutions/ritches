<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'dbrichestpro');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'vfMb.01| gLhNa1)lb$=My^mNWuEg9Kkw*Bi9rB!xO6=:Do=K2{<_8X1iG9K5w.}');
define('SECURE_AUTH_KEY', ':)x1!lSA<b4^vBs/=rjr)n949KYxc!)z]-#`.78d24Ka#EHf=l17o5jBDOHMG?%L');
define('LOGGED_IN_KEY', 't1f`fx*CdG*AWIcneh2N+2X!0dddyfW1^N%wB-OHLC+~6%xYK,%$(P?))u=5jn2}');
define('NONCE_KEY', '(&mu:(<.*Q2:Zsu9){CW1yE.TM>tLDTV[i^ni?#W<Jpw`IOw?cy5^N=nP1U&oMS`');
define('AUTH_SALT', '}y{o*GB^PZul,lQ9e$H0r<3?.)V[!$D#W+i{p|R_MX#`AQSkdrtk>-p49wSX!d/W');
define('SECURE_AUTH_SALT', 'p>,J{E01yV,PgFPr*H-a.N|,GuP.!i@(@+zhDmWN!yK&Wi3]0F S^z?Q.%e[A<N)');
define('LOGGED_IN_SALT', 'BQ!r8bfkW[9^-c4P0{w-$Md7%VL-EzkpZQ{I  PQF59`dt*I!oa*)m-*%YVO31#(');
define('NONCE_SALT', 'Vh1>NIupZH|w}b1}KKr(?Rh)AAt`8b&Ci]=jkL(YTx0FX.,)IfpeXaH5~0C%g8*A');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

