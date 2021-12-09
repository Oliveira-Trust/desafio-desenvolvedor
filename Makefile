# Makefile for Docker Nginx PHP Composer MySQL

include .env

# MySQL
MYSQL_DUMPS_DIR=data/db/dumps

help:
	@echo ""
	@echo "Uso: make Commands"
	@echo ""
	@echo "Commands:"
	@echo "  phpdoc              Gerador de documentação de API"
	@echo "  code-sniff          Rodar o Code Sniffer no código PHP (PSR2)"
	@echo "  clean               Limpar os diretórios necessários para reiniciar os containers"
	@echo "  composer-up         Atualizar as dependências do PHP utilizando o composer"
	@echo "  start               Iniciar todos os serviços"
	@echo "  start-with-db       Iniciar o projeto com a base de dados do desafio de busca"
	@echo "  stop                Parar todos os serviços"
	@echo "  logs                Visualizar os logs dos serviços"
	@echo "  mysql-dump-all      Criar backup de todos os bancos de dados"
	@echo "  mysql-restore-all   Restaurar o backup de todos os bancos de dados"
	@echo "  mysql-dump-db       Criar backup de um banco de dados especifico (mysql-dump-db DATABASE='DATABASE_NAME')"
	@echo "  mysql-restore-db    Restaurar o backup e um banco de dados especifico (mysql-restore-db DATABASE='DATABASE_NAME')"
	@echo "  phpmd               Rodar o PHP Mess Detector no código PHP"
	@echo "  test                Rodar os testes da aplicação"

phpdoc:
	@docker run --rm -v $(shell pwd):/data phpdoc/phpdoc -i=vendor/ -d /data/web/app/src -t /data/web/app/doc
	@make resetOwner

clean:
	@rm -Rf data/db/mysql/*
	@rm -Rf web/app/vendor
	@rm -Rf web/app/composer.lock
	@rm -Rf web/app/doc
	@rm -Rf web/app/report
	@rm -Rf web/app/.env
	@rm -Rf etc/ssl/*

code-sniff:
	@echo "Verificando o padrão de código..."
	@docker-compose exec -T php ./app/vendor/bin/phpcs -v --standard=PSR2 app/src

composer-up:
	@docker run --rm -v $(shell pwd)/web/app:/app composer update

start:
	docker-compose up -d

start-with-db: start
	@echo "Iniciando o projeto com a base de dados do desafio de busca..."
	@make mysql-restore-db DATABASE='selene'

stop:
	@docker-compose down -v
	@make clean

logs:
	@docker-compose logs -f

mysql-dump-all:
	@echo "Fazendo backup de todas as bases de dados..."
	@mkdir -p $(MYSQL_DUMPS_DIR)
	@docker exec $(shell docker-compose ps -q mysqldb) mysqldump --all-databases -u"$(MYSQL_ROOT_USER)" -p"$(MYSQL_ROOT_PASSWORD)" > $(MYSQL_DUMPS_DIR)/db.sql 2>/dev/null
	@make resetOwner

mysql-restore-all:
	@echo "Restaurando todas as bases de dados..."
	@docker exec -i $(shell docker-compose ps -q mysqldb) mysql -u"$(MYSQL_ROOT_USER)" -p"$(MYSQL_ROOT_PASSWORD)" < $(MYSQL_DUMPS_DIR)/db.sql 2>/dev/null

mysql-dump-db:
	@echo "Fazendo backup da base de dados $$DATABASE..."
	@mkdir -p $(MYSQL_DUMPS_DIR)
	@docker exec $(shell docker-compose ps -q mysqldb) mysqldump --all-databases -u"$(MYSQL_ROOT_USER)" -p"$(MYSQL_ROOT_PASSWORD)" > $(MYSQL_DUMPS_DIR)/$$DATABASE.sql 2>/dev/null
	@make resetOwner

mysql-restore-db:
	@echo "Restaurando a base de dados $$DATABASE..."
	@docker exec -i $(shell docker-compose ps -q mysqldb) mysql -u"$(MYSQL_ROOT_USER)" -p"$(MYSQL_ROOT_PASSWORD)" < $(MYSQL_DUMPS_DIR)/$$DATABASE.sql 2>/dev/null

phpmd:
	@docker-compose exec -T php \
	./app/vendor/bin/phpmd \
	./app/src text cleancode,codesize,controversial,design,naming,unusedcode

test:
	@docker-compose exec -T php ./app/vendor/bin/phpunit --colors=always --configuration ./app/
	@make resetOwner

resetOwner:
	@$(shell chown -Rf $(SUDO_USER):$(shell id -g -n $(SUDO_USER)) $(MYSQL_DUMPS_DIR) "$(shell pwd)/etc/ssl" "$(shell pwd)/web/app" 2> /dev/null)

.PHONY: clean test code-sniff