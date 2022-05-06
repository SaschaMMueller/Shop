#!/bin/bash
set -euxo pipefail

#apt update
#dpkg --configure -a
#apt install php7.4 php-cli php-fpm php-json php-pdo php-mysql php-zip php-gd  php-mbstring php-curl php-xml php-pear php-bcmath
#apt install apache2
#apt install mysql-server
#apt install git
#apt install composer

eval $(ssh-agent) && ssh-add ~/.ssh/schokotech-vm-git
ssh-keyscan -t rsa,dsa git.votum-media.net >> ~/.ssh/ssh_known_hosts

sudo -S chown -R $(whoami):$(whoami) /var/www/html
rm /var/www/html/index.html || true
rm -r /var/www/html/Shop || true  #move to separate cleanup script
cd /var/www/html/
#fingerprint
git clone git@git.votum-media.net:philippos.kardaras/azubis_2019.git
cd azubis_2019
git checkout ST-Automation
cd ..

mkdir -p Shop/
mv azubis_2019 Shop/Schokotech/
sudo cp Shop/Schokotech/automation/apache2/php.ini /etc/php/7.4/apache2
sudo cp Shop/Schokotech/automation/apache2/000-default.conf /etc/apache2/sites-available

sudo a2enmod rewrite
sudo systemctl restart apache2

cd Shop/Schokotech/
composer install
#
#echo '1234'>1 sudo -S mysql -uroot <<MYSQL_SCRIPT
#CREATE USER 'schokotech'@'localhost' IDENTIFIED BY '1234';
#GRANT ALL PRIVILEGES ON *.* TO 'schokotech'@'localhost';
#FLUSH PRIVILEGES;
#MYSQL_SCRIPT

cd SetUp/
./SetUp.sh
