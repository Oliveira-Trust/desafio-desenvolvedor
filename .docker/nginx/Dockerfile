FROM nginx:1.21.6-alpine
RUN apk update && apk add bash

RUN rm /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/conf.d
