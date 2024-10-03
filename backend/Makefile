SHELL:=/bin/bash
ARGS = $(filter-out $@,$(MAKECMDGOALS))
MAKEFLAGS += --silent
BASE_PATH=${PWD}
PYTHON_EXEC=python
DOCKER_COMPOSE_FILE=$(shell echo -f docker-compose.yml)
VENV_PATH=~/venv/oliveira-trust

ifeq ($(OS),Windows_NT)
    OSFLAG=WIN32
    ifeq ($(PROCESSOR_ARCHITEW6432),AMD64)
        OSFLAG=AMD64
    else
        ifeq ($(PROCESSOR_ARCHITECTURE),AMD64)
            OSFLAG=AMD64
        endif
        ifeq ($(PROCESSOR_ARCHITECTURE),x86)
            OSFLAG=IA32
        endif
    endif
else
    UNAME_S := $(shell uname -s | tr A-Z a-z)
    ifeq ($(UNAME_S),linux)
        OSFLAG=LINUX
    endif
    ifeq ($(UNAME_S),darwin)
        OSFLAG=OSX
    endif
    UNAME_P := $(shell uname -p)
    ifeq ($(UNAME_P),x86_64)
        OSFLAG=AMD64
    endif
    ifneq ($(filter %86,$(UNAME_P)),)
        OSFLAG=IA32
    endif
    ifneq ($(filter arm%,$(UNAME_P)),)
        OSFLAG=ARM
    endif
endif

include .env
include .env
export $(shell sed 's/=.*//' .env)

show_env:
	# Show wich DOCKER_COMPOSE_FILE and ENV the recipes will user
	# It should be referenced by all other recipes you want it to show.
	# It's only printed once even when more than a recipe executed uses it
	#sh -c "if [ \"${ENV_PRINTED:-0}\" != \"1\" ]; \
	#then \
	#	echo DOCKER_COMPOSE_FILE = \"${DOCKER_COMPOSE_FILE}\"; \
	#	echo OSFLAG = \"${OSFLAG}\"; \
	#fi; \
	#ENV_PRINTED=1;"

list: show_env
	sh -c "echo; $(MAKE) -p no_targets__ | awk -F':' '/^[a-zA-Z0-9][^\$$#\/\\t=]*:([^=]|$$)/ {split(\$$1,A,/ /);for(i in A)print A[i]}' | grep -v '__\$$' | grep -v 'Makefile'| sort"

#############################
# Docker machine states
#############################

_cp_env_file: show_env
	cp -f .env.sample .env
	echo "" >> .env
	cat .env.sample >> .env
	echo "" >> .env
	echo "DOCKER_USER=`whoami`" >> .env
	echo "DOCKER_USER_ID=`id -u \"${DOCKER_USER}\"`" >> .env
	if [ "${OSFLAG}" = OSX ]; then \
		echo "DOCKER_GROUP=staff" >> .env; \
	else	\
		echo "DOCKER_GROUP=`whoami`" >> .env; \
	fi
	echo "DOCKER_GROUP_ID=`id -g \"${DOCKER_GROUP}\"`" >> .env; \
	cp -f .env.sample .env

_rebuild: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} down
	docker-compose ${DOCKER_COMPOSE_FILE} build --no-cache --force-rm

rebuild: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} down
	docker-compose ${DOCKER_COMPOSE_FILE} build

flake8:
	echo "verify pep8 ..."
	docker-compose ${DOCKER_COMPOSE_FILE} exec web flake8
	docker-compose ${DOCKER_COMPOSE_FILE} exec web isort .

up: show_env
	sudo docker-compose ${DOCKER_COMPOSE_FILE} up -d --remove-orphans

up_debug: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} stop web
	docker-compose ${DOCKER_COMPOSE_FILE} -f docker-compose.override.debug.yml up -d --remove-orphans

build: show_env stopall
	docker-compose ${DOCKER_COMPOSE_FILE} up -d --remove-orphans --build

restart_celery: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} stop celery
	docker-compose ${DOCKER_COMPOSE_FILE} start celery

stopall: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} stop

start: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} start "${ARGS}"

restart: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} restart "${ARGS}"

stop: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} stop "${ARGS}"

down: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} down --remove-orphans

logs: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} logs --tail 200 -f "${ARGS}"

log: show_env
	sudo docker-compose ${DOCKER_COMPOSE_FILE} logs --tail 200 -f web

install: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec web pip install "${ARGS}"

pip_install: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec web pip install -r requirements.txt

uninstall: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec web pip uninstall "${ARGS}"

dj: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec web ${PYTHON_EXEC} ./manage.py ${ARGS}

test: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec web py.test "${ARGS}"

_drop_db: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} stop db
	docker-compose ${DOCKER_COMPOSE_FILE} rm db
	rm -rf pgdata

_create_db: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} up -d db

recreate_db: show_env _drop_db _create_db migrate

createsu: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec web ${PYTHON_EXEC} ./manage.py shell -c "from django.contrib.auth.models import User; User.objects.create_superuser('OliveiraTrust', 'admin@oliveiratrust.com', '123'); print('Superuser created: admin@oliveiratrust.com:123')"

init : _cp_env_file show_env build migrate createsu up log

migrate:
	docker-compose ${DOCKER_COMPOSE_FILE} exec web ${PYTHON_EXEC} ./manage.py migrate

makemigrations: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec web ${PYTHON_EXEC} ./manage.py makemigrations
	docker-compose ${DOCKER_COMPOSE_FILE} exec web ${PYTHON_EXEC} ./manage.py migrate

makemigrations_merge: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec web ${PYTHON_EXEC} ./manage.py makemigrations --merge


backup_database: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec db pg_dump ${POSTGRES_DB} -U ${POSTGRES_USER} > ./bkp.sql

restore_database_alias: show_env
	docker-compose ${DOCKER_COMPOSE_FILE} exec -T db psql -d ${POSTGRES_DB} -U ${POSTGRES_USER} -c "drop schema public cascade; create schema public;"
	docker-compose ${DOCKER_COMPOSE_FILE} exec -T db psql -d ${POSTGRES_DB} -U ${POSTGRES_USER} < dumps/backup.sql

restore_database: show_env restore_database_alias migrate

create_venv: show_env
	sudo apt-get install python3-dev python3-wheel python3-dev gcc libpq-dev python3-venv -y
	python3 -m venv ${VENV_PATH}
	${VENV_PATH}/bin/python -m pip install --upgrade pip setuptools wheel
	${VENV_PATH}/bin/pip install -r requirements.txt


restore_dblocal : show_env restore_database_alias migrate createsu

docker_prune_containers: show_env
	docker container prune

docker_prune_images: show_env
	docker image prune

docker_stop_all_containers: show_env
	docker container stop `docker container ls -q` || echo "There isn't container to stop!"

docker_prune: show_env docker_stop_all_containers docker_prune_containers docker_prune_images

#############################
# Argument fix workaround
#############################
%:
	@:
