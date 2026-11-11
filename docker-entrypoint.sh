#!/bin/sh
set -e

# Railway geeft de poort via $PORT; Apache luistert standaard op 80
PORT="${PORT:-80}"
sed -ri "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# SMTP-config opbouwen uit environment variables
cat > /etc/msmtprc <<CONF
defaults
auth           on
tls            on
tls_starttls   on
tls_trust_file /etc/ssl/certs/ca-certificates.crt
logfile        /dev/stderr

account        default
host           ${SMTP_HOST:-smtp.combell.com}
port           ${SMTP_PORT:-587}
from           ${SMTP_FROM:-website@klimacontrol.be}
user           ${SMTP_USER}
password       ${SMTP_PASS}
CONF
chmod 600 /etc/msmtprc
chown www-data:www-data /etc/msmtprc

exec "$@"
