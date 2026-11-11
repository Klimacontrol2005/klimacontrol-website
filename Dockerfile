FROM php:8.3-apache

# msmtp als sendmail-vervanger (Railway heeft geen lokale MTA)
RUN apt-get update \
 && apt-get install -y --no-install-recommends msmtp ca-certificates \
 && rm -rf /var/lib/apt/lists/*

RUN echo "sendmail_path = /usr/bin/msmtp -t" > /usr/local/etc/php/conf.d/mail.ini

RUN a2dismod mpm_event mpm_worker 2>/dev/null || true; \
    a2enmod mpm_prefork rewrite headers expires

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

COPY . /var/www/html/
RUN rm -f /var/www/html/Dockerfile /var/www/html/docker-entrypoint.sh \
          /var/www/html/README.md /var/www/html/.env.example

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
