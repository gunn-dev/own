FROM node:12-alpine3.14
COPY package.json /app
COPY . /app
WORKDIR /app
CMD node index.js
EXPOSE 8081

# FROM tecadmin/ubuntu-ssh:16.04

# RUN apt-get update \
#     && apt-get install -y apache2

# COPY index.html /var/www/html/
# WORKDIR /var/www/html
# CMD ["apachectl", "-D", "FOREGROUND"]
# EXPOSE 80
