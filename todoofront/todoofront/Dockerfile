# base image
FROM node:12.16.1

WORKDIR /var/www/html

COPY package.json .
RUN npm install
RUN npm install -g @angular/cli

COPY . .

EXPOSE 4200

# start app
CMD ng serve --host 0.0.0.0
