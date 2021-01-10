#!/bin/bash
if [ "$EUID" -ne 0 ]
  then echo "Please run as root"
  exit
fi

apt update
apt install -y git apache2 mysql-server php libapache2-mod-php php-mysql php-gd php-zip php-cli
echo 1 > /var/www/html/index.html
git clone https://github.com/seruling/kedaigambar.git /var/www/html/kedaigambar
chown -R ubuntu:ubuntu /var/www/html/kedaigambar/
chmod 777 /var/www/html/kedaigambar/images/
mysql -uroot -e "create database kedaigambar"
mysql -uroot -e "CREATE USER 'kedaigambar'@'%' IDENTIFIED BY 'MySQL@332'"
mysql -uroot -e "GRANT ALL PRIVILEGES ON kedaigambar.* TO 'kedaigambar'@'%'"
mysql -uroot kedaigambar < /var/www/html/kedaigambar/kedaigambar.sql
rm -rf /var/www/html/kedaigambar/kedaigambar.sql
rm -rf /var/www/html/kedaigambar/init_kedaigambar.sh
rm -rf /var/www/html/kedaigambar/.git
