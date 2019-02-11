
# My PHP Blog

## Web server configuration
If your server runs on nginx :  
- first, replace the .htaccess of the root with:  
RewriteEngine On
RewriteRule (. *) Public / $ 1 [L]  
This command redirect all url to public folder.  

- second, replace the .htaccess of the public file by:

RewriteEngine On
RewriteCond% {REQUEST_FILENAME}! -D
RewriteCond% {REQUEST_FILENAME}! -F
RewriteRule (. *) Index.php / $ 1 [L]  
to redirect to index unless you can reach a file.    
You can find all the scripts in resource folder.

- of corse, you can set your own configuration to redirect to public folder  

# Data base configuration
Remplace setting connection with your own by using the Config.php in core folder.

