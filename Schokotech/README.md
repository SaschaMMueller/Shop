# SchokoTech

Seting Up links/.htaccess:
https://www.digitalocean.com/community/tutorials/how-to-rewrite-urls-with-mod_rewrite-for-apache-on-ubuntu-18-04

Enabling mod_rewrite:

	1. sudo a2enmod rewrite
    	2. sudo systemctl restart apache2

Setting Up .htaccess:

	3. sudo nano /etc/apache2/sites-available/000-default.conf
	4. Inside the " <VirtualHost *:80> " tags put:

  	  <Directory /var/www/html>
  	      Options Indexes FollowSymLinks MultiViews
 	      AllowOverride All
  	      Require all granted
 	   </Directory>

	5.sudo systemctl restart apache2

Creating the .htaccess:

	6.create a new file in your phpstormproject and call it .htaccess
	7.inside the .htaccess write: RewriteEngine on
	
	
Xdebug Install Manual:
1. If you don't now which version you need, go to https://xdebug.org/wizard and copy paste your
   phpinfo() into the field. Download the correct package.
2. Unpack the tarball: tar -xzf xdebug-2.8.0.tgz. Note that you do not need to unpack the tarball inside the PHP source code tree. Xdebug is compiled separately, all by itself.
3. cd xdebug-X.X.X folder.(xdebug contains another xdebug folder you need to cd in)
4. Run phpize: phpize (or /path/to/phpize if phpize is not in your path). Make sure you use the phpize that belongs to the PHP version that you want to use Xdebug with. 
   If phpize is not recognized, run sudo apt-get install php7.x-dev and try again.
5. run ./configure --enable-xdebug
6. run make
7. run make install
8. run sudo nano /etc/php/7.4/apache2/php.ini && sudo nano /etc/php/7.4/apache2/php.ini and add to both files at the end:
    zend_extension = /usr/lib/php/20190902/xdebug.so
    xdebug.idekey = "PHPSTORM"
    xdebug.remote_enable = 1
    xdebug.remote_autostart = 1
    xdebug.remote_port = 9000
    xdebug.var_display_max_depth = 10
    xdebug.var_display_max_children = 256
    xdebug.var_display_max_data = 1024
9. run sudo service apache2 restart
10. In Phpstorm under file->settings->Languages & Framworks->php select php.7.4 cli interpreter.(should be in /usr/bin/php)
11. create localhost server under file->settings->Languages & Framworks->php->server and name both name and host as localhost(default port is 80, debugger is xdebug). add the absolute path for index.php (NO EMPTY 	SPACES IN FRONT)
12. Configure Phpstorm debug connection: at the top right, click edit/add configuration. Click the plus icon in top left, select the PhHP Remote debug template. Enable filter debug connection by IDE key. Set the IDE key to PHPSTORM
13. install browser extension
and now it works^^

Installing MySQOL:
https://wiki.ubuntuusers.de/MySQL/
https://stackoverflow.com/questions/36864206/sqlstatehy000-1698-access-denied-for-user-rootlocalhost
(first answer)

Warning, do not use "Sudo Su"!

1. sudo apt-get install mysql-server
-> Download and installation of MYSQL.
 
2. (optional) sudo apt-get install php-mysql
-> You may need this extra package for php.

For working with databases , don't use the 'root' user. instead create a new user:

3. In the terminal: sudo mysql -u root -p
	then enter the root password(set during installation)
-> That logs you in as MYSQL root user.

4.Enter the following after you changed the 'newuser' and 'password' to somthing more appropriate:

	CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
	GRANT ALL PRIVILEGES ON *.* TO 'newuser'@'localhost';
	FLUSH PRIVILEGES;

-> Creates a new user with all privileges.

5. exit
->closes MYSQL.

6. service mysql restart
-> Restart MYSQL so the changes take effect.

docker-compose exec php bash