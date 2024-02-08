
FROM yiisoftware/yii2-php:8.2-apache



RUN docker-php-ext-install pdo_mysql

RUN sed -i -e 's|/app/web|/app/frontend/web|g' /etc/apache2/sites-available/000-default.conf


RUN a2enmod rewrite
RUN a2enmod auth_basic
RUN a2enmod authn_core


RUN echo '<Directory /app/frontend/web/>' > /tmp/directory_block \
    && echo '    Options Indexes FollowSymLinks' >> /tmp/directory_block \
    && echo '    AllowOverride All' >> /tmp/directory_block \
    && echo '    AuthType Basic' >> /tmp/directory_block \
    && echo '    AuthName "Restricted Access"' >> /tmp/directory_block \
    && echo '    AuthUserFile /etc/apache2/.htpasswd' >> /tmp/directory_block \
    && echo '    Require valid-user' >> /tmp/directory_block \
    && echo '    RewriteEngine on' >> /tmp/directory_block \
    && echo '    RewriteBase /' >> /tmp/directory_block \
    && echo '    RewriteCond %{REQUEST_FILENAME} !-f' >> /tmp/directory_block \
    && echo '    RewriteCond %{REQUEST_FILENAME} !-d' >> /tmp/directory_block \
    && echo '    RewriteRule . index.php' >> /tmp/directory_block \
    && echo '    Require all granted' >> /tmp/directory_block \
    && echo '</Directory>' >> /tmp/directory_block 
RUN cat /tmp/directory_block >> /etc/apache2/sites-available/000-default.conf

RUN rm /tmp/directory_block
