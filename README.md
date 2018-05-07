# OC-P4-MVC-Blog
Jean Forteroche "Billet simple pour l'Alaska" blog project with MVC architecture and admin interface.
A school project based on the last exercice of the "Adoptez une architecture MVC" course.

Installation
1. fisrt, you have to hash admin password with hashPass.php file (install directory).
2. install database, then add in logins table, your login and the hash password
3. update comment RewriteRule in .htaccess file with your own website url, change port if server use another one
4. install composer https://getcomposer.org/
5. install digital nature package (var_dump shortcut) with composer, if you use it, else delete digitalnature require in index.php
6. install phpmailer, update ContactManager $mail with your own mail address, host, port... 
7. get your reCAPTCHA key on https://www.google.com/recaptcha/intro/android.html, then add your key into data-sitekey="" in contactView.php file
8.
9. (install twig package with composer)