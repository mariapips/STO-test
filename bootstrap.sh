#! /usr/bin/env bash
sudo -s
apt-get update && apt-get upgrade -y

echo "Installing nginx"
apt-get  -y install nginx

echo "Installing php7.0"
apt-add-repository --yes ppa:ondrej/php
apt-get -y update
apt-get -y install php7.0-fpm

echo "additional soft"
apt-get -y install mc
apt-get -y install zsh htop

# Install MySQL Server in a Non-Interactive mode. Default root password will be "!qasw3eD"

debconf-set-selections <<< 'mysql-server-5.7 mysql-server/root_password password Passw0rd'

debconf-set-selections <<< 'mysql-server-5.7 mysql-server/root_password_again password Passw0rd'

apt-get -y install mysql-server php7.0-mysql

aptitude -y install expect

SECURE_MYSQL=$(expect -c "
set timeout 10
spawn mysql_secure_installation
expect \"Enter current password for root (enter for none):\"
send \"Passw0rd\r\"
expect\"setup VALIDATE PASSWORD plugin?\"
send \"n\r\"
expect \"Change the root password?\"
send \"n\r\"
expect \"Remove anonymous users?\"
send \"y\r\"
expect \"Disallow root login remotely?\"
send \"y\r\"
expect \"Remove test database and access to it?\"
send \"y\r\"
expect \"Reload privilege tables now?\"
send \"y\r\"
expect eof
")

echo "$SECURE_MYSQL"

aptitude -y purge expect

service mysql restart

echo "Installing xdebug"
apt-get install php-xdebug
xdebug=$(cat <<EOF
zend_extension=xdebug.so
xdebug.remote_enable=1
xdebug.remote_connect_back=1
xdebug.remote_log=/tmp/php-xdebug.log
xdebug.idekey=vagrant-xdebug
xdebug.remote_host=192.168.5.17 
xdebug.max_nesting_level=1000
EOF
)
echo "${xdebug}" > /etc/php/7.0/fpm/conf.d/20-xdebug.ini 
