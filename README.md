# Welcome to my PHP MVC framework

This is a simple MVC framework for building my blog in PHP. I did this work thanks to Dave 
Hollingworth's tutorials and the advice of my mentor Gauthier Burgeat.

This work is done as part of my PHP web developer training with Openclassroom - project 5.

**Attention, this blog is my reflection: I used the knowledge of different courses that I learned and put them 
into practice. In no way the errors that if found are the fact of the people cited.**

## Installation

1. First, download the framework, either directly or by cloning the repo.
1. Run **composer update** to install the project dependencies.
1. Configure your web server to have the **public** folder as the web root.
1. Open [config/Config.php.dist](config/Config.php.dist) and enter your database configuration data.

See below for more details.

## Errors

If the `SHOW_ERRORS` configuration setting is set to `true`, full error detail will be shown in the browser if an error or exception occurs. If it's set to `false`, a generic message will be shown using the [app/view/404.html.twig](app/view/404.html.twig) or [app/view/500.html.twig](app/view/500.html.twig) views, depending on the error.

## Web server configuration

Pretty URLs are enabled using web server rewrite rules. An [.htaccess](public/.htaccess) file is included in the `public` folder. Equivalent nginx configuration is in the [nginx.txt](ressource/nginx.txt) file.

---

You can see the project online at this address [my professional Blog](http://www.jlgb.fr/blog) .