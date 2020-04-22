#!/bin/bash

start() { 
  echo "Starting server"
  docker-compose up -d && docker-compose exec web bash
}

access() { 
  echo "Accessing server"
  docker-compose exec web bash
}

build() {
  echo "Starting server building"
  docker-compose up -d --build && docker-compose exec web bash
}

stop() {
  echo "Stopping server"
  docker-compose down
}

restart() {
  echo "Restarting server"
  stop
  start
}

list() {
  echo "Listing containers"
  docker-compose ps
}

help() {
  echo "Usage:"
  echo "./init.sh [options]"
  echo "-u start server"
  echo "-d down server"
  echo "-a access server"
  echo "-l list server"
  echo "-r restart server"
  echo "-b build server"    
}

main() {

  if [ "$1" = "-u" ]; 
    then
    start
  elif [ "$1" = "-d" ];
    then
    stop
  elif [ "$1" = "-a" ];
    then
    access
  elif [ "$1" = "-l" ];
    then
    list
  elif [ "$1" = "-r" ];
    then
    restart
  elif [ "$1" = "-b" ];
    then
    build
  else
    help
  fi

}

main $@