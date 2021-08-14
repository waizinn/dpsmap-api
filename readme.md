
**Requirement**
 - Database 
           `Mysql: 5.7+`
 - Server Scripting
           `PHP: 7.0+`
 -  Web Server
           `Apache 2.2+ (or) Nginx 1.19+`

**Setup & Installation**
 - Run db_structure.sql
 - Default username & password is admin
 - Configure db password in api/config.php & includes/config.php

**Apache Config** 
 `RewriteEngine on
 DirectoryIndex index.php
 RewriteCond %{SCRIPT_FILENAME} !-d
 RewriteCond %{SCRIPT_FILENAME} !-f
 RewriteRule ^ index.php [L]
 RewriteRule !^(src/|modal/|) [NC,F]`

    
**Nginx Config**
    `location / {
        try_files $uri /index.php$is_args$args;
      }
    rewrite !^(src/|modal/) [NC,F];`

**API documentation**
https://docs.google.com/document/d/1C7q1cJdQ0PFUDLBOT0R9cLZtvzuSBQTPRwOUnNqinVE/edit?usp=sharing