#My PHP Blog

##Web server configuration
If your server runs on nginx, replace the .htaccess of the root with:
RewriteEngine On
RewriteRule (. *) Public / $ 1 [L]
redirect all url to public

the .htaccess of the public file by:

RewriteEngine On
RewriteCond% {REQUEST_FILENAME}! -D
RewriteCond% {REQUEST_FILENAME}! -F
RewriteRule (. *) Index.php / $ 1 [L]
to redirect to index unless you can reach a file