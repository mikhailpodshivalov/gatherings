FROM nginx:1.26-alpine

ADD ./build/nginx/config.conf /etc/nginx/conf.d/default.conf

COPY ./src/public /var/www/public
