FROM node:16.14

WORKDIR /app/frontend

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

RUN yarn install

CMD yarn install && yarn start


# vim:ts=2:sw=2:et:syn=dockerfile:
