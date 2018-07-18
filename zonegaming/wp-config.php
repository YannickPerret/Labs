<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'yannickpgt1');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'yannickpgt1');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'Suplivent27');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'yannickpgt1.mysql.db');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Q9/ 9)W(,jBO]0!}>[.|y9(KJ[U5Hpa/B#W>kF|=#YRieaCmgN(7Xf[v}a&~QcWb');
define('SECURE_AUTH_KEY',  'D4SB0_v[)3ogFTR|Xn:28D#@}Hn6u+$1~GMIKkGrn/%@,HtsR6y*o<cgl=|S/.5o');
define('LOGGED_IN_KEY',    'PnM Oy`cFLsuqx-|rXo,|C@.5in*|-A+o!~+G3%o[x{r(MXI.|Fm+3&gC>T;afV|');
define('NONCE_KEY',        '{X+6LsiHS9xomuv~)/I(?/s$(&K9Qm4w`oet*ZZt^^78j=rlP=0@he0g)+3*.nuv');
define('AUTH_SALT',        'FpK0X&$K<SR^k@f>ISB*H25ecVO& QtmW.2wyS<< <T8(s@zlJ7mHTOPsy%K:9ti');
define('SECURE_AUTH_SALT', '[> ` Q_= :t{QM#@PVJFs+%&9V^Ng`wjSL|6Mjlg5usf]hQBNf+.+*o$W@v(A|^/');
define('LOGGED_IN_SALT',   '_h~)&KPR<1L-n:aU3{=*E:sNg.FL4NzpfpN^hF,#iZi<vNs$M3i :J1AxJ@z*x?x');
define('NONCE_SALT',       'mnizu a2X//2[b{%S1/y8gp^9t|np7owR:aP(Wr(& PNI_T5J?!uH%L*Lvv #,yB');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'zg_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');