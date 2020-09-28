on aws ubuntu 18.04 with the default username of ubuntu run the following with root priv

<h4>option 1</h4>

<h5>first</h5>
```bash
apt update
```

<h5>install bla bla</h5>
```bash
apt install -y git apache2 mysql-server php libapache2-mod-php php-mysql php-gd php-zip php-cli
```
<h5>replace default apache file</h5>
```bash
echo 1 > /var/www/html/index.html
```
<h5>download the code into web root</h5>
```bash
git clone https://github.com/seruling/kedaigambar.git /var/www/html/kedaigambar
```
<h5>so that not root</h5>
```bash
chown -R ubuntu:ubuntu /var/www/html/kedaigambar/
```
<h5>so that can upload</h5>
```bash
chmod 777 /var/www/html/kedaigambar/images/
```
<h5>create a db</h5>
```bash
mysql -uroot -e "create database kedaigambar"
```
<h5>create a db user</h5>
```bash
mysql -uroot -e "CREATE USER 'kedaigambar'@'%' IDENTIFIED BY 'MySQL@332'"
```
<h5>give user the priv to access db</h5>
```bash
mysql -uroot -e "GRANT ALL PRIVILEGES ON kedaigambar.* TO 'kedaigambar'@'%'"
```
<h5>load sql</h5>
```bash
mysql -uroot kedaigambar < /var/www/html/kedaigambar/kedaigambar.sql
```
<h5>remove sql file within the web root</h5>
```bash
rm -rf /var/www/html/kedaigambar/kedaigambar.sql
```


<h4>option 2</h4>
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
