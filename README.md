on aws ubuntu 18.04 with the default username of ubuntu run the following with root priv

<h3>option 1</h3>

**first**

apt update

**install bla bla**
apt install -y git apache2 mysql-server php libapache2-mod-php php-mysql php-gd php-zip php-cli


**replace default apache file**
echo 1 > /var/www/html/index.html

**download the code into web root**
git clone https://github.com/seruling/kedaigambar.git /var/www/html/kedaigambar

**so that not root**
chown -R ubuntu:ubuntu /var/www/html/kedaigambar/

**so that can upload**
chmod 777 /var/www/html/kedaigambar/images/

**create a db**
mysql -uroot -e "create database kedaigambar"

**create a db user**
mysql -uroot -e "CREATE USER 'kedaigambar'@'%' IDENTIFIED BY 'MySQL@332'"

**give user the priv to access db**
mysql -uroot -e "GRANT ALL PRIVILEGES ON kedaigambar.* TO 'kedaigambar'@'%'"

**load sql**
mysql -uroot kedaigambar < /var/www/html/kedaigambar/kedaigambar.sql

**remove sql file within the web root**
rm -rf /var/www/html/kedaigambar/kedaigambar.sql

<h3>option 2</h3>
put the following kedaigambar.sh file

```bash
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
```

chmod +x kedaigambar.sh
./kedaigambar.sh
