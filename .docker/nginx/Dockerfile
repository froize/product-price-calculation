FROM nginx:alpine
WORKDIR "/application"

RUN apk update && apk add --no-cache openssl
# Create certificates
RUN mkdir -p /etc/nginx/ssl
RUN openssl genrsa -out /etc/nginx/ssl/symfony-test.loc.key 2048
RUN openssl req -new -x509 -key /etc/nginx/ssl/symfony-test.loc.key  \
    -out /etc/nginx/ssl/symfony-test.loc.crt -days 365 -subj /CN=symfony-test.loc -verbose