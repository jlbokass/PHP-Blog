<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 04/01/2019
 * Time: 14:25
 */

// --------------------------- //
//       ERRORS DISPLAY        //
// --------------------------- //

//!\\ A enlever lors du déploiement
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', true);


// --------------------------- //
//          SESSIONS           //
// --------------------------- //

ini_set('session.cookie_lifetime', false);
session_start();


// --------------------------- //
//         CONSTANTS           //
// --------------------------- //

// Paths
define('PATH_REQUIRE', substr($_SERVER['SCRIPT_FILENAME'], 0, -9)); // Pour fonctions d'inclusion php
define('PATH', substr($_SERVER['PHP_SELF'], 0, -9)); // Pour images, fichiers etc (html)

// Website informations
define('WEBSITE_TITLE', 'Projet blog PHP');
define('WEBSITE_NAME', 'Blog de Bokassa J.');
define('WEBSITE_URL', 'https://www.jlgb.fr/blog');
define('WEBSITE_DESCRIPTION', 'Site web réalisé dans le cadre de ma formation développeur Web PHP/SYMFONY avec l\'organisme OpenClassroom');
define('WEBSITE_KEYWORDS', 'blog, php, blog professionnel');
define('WEBSITE_LANGUAGE', 'fr');
define('WEBSITE_AUTHOR', 'Bokassa Jean le Grand');
define('WEBSITE_AUTHOR_MAIL', 'jean.le.grand.bokassa@gmail.com');

// Facebook Open Graph tags
define('WEBSITE_FACEBOOK_NAME', 'BLOG de Bokassa J.');
define('WEBSITE_FACEBOOK_DESCRIPTION', 'Blog PHP réalisé dans le cadre de ma formation développeur web PHP/SYMFONY');
define('WEBSITE_FACEBOOK_URL', 'http://wwww.jlgb.fr/blog');
define('WEBSITE_FACEBOOK_IMAGE', '');

// Language
define('DEFAULT_LANGUAGE', 'fr');