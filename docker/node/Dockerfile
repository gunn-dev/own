FROM node:12-alpine3.14

# Create app directory
WORKDIR /app

# Install app dependencies
COPY package*.json ./

RUN npm install

# Copying rest of the application to app directory
COPY . /app

CMD node index.js

# Expose the port and start the application
EXPOSE 8081