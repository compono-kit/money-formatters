FROM php:8.3-alpine
ARG GITHUB_TOKEN

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer config --global github-oauth.github.com ${GITHUB_TOKEN}
RUN composer self-update

RUN apk add --update --no-cache icu-dev icu-data-full $PHPIZE_DEPS
RUN docker-php-ext-install bcmath intl

ENTRYPOINT ["composer"]
