# OC-P4-MVC-Blog
Jean Forteroche "Billet simple pour l'Alaska" blog project with MVC architecture and admin interface.
A school project based on the last exercice of the "Adoptez une architecture MVC" course.

Installation
1. fisrt, you have to hash admin password with hashPass.php file (install directory).
2. import sql database, then add in logins table, your login and the hash password
3. update PDO in Manager with your host, dbname, port, login, password
4. update constantes in _config file
5. update comment RewriteRule in .htaccess file with your own website url, change port if server use another one
6. install composer https://getcomposer.org/
7. install digital nature package (var_dump shortcut) with composer, if you use it, else delete digitalnature require in index.php
9. install phpmailer, update ContactManager $mail with your own mail address, host, port... 
9. get your reCAPTCHA key on https://www.google.com/recaptcha/intro/android.html, then add your website key into data-sitekey="" in contactView.php file. 
then uncomment reCaptcha verifications in Frontend controller backend method.