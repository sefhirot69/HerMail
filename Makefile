# VARIABLES
DOCKER_COMPOSE = docker compose
CONTAINER      = webserver-hermail
EXEC           = docker exec -t --user=root $(CONTAINER)
EXEC_PHP       = $(EXEC) php
SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC) composer
CURRENT-DIR  := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
CURRENT_UID  := $(shell id -u)

.DEFAULT_GOAL := deploy

.PHONY: deploy build deps update-deps composer-install ci composer-update cu composer-require cr composer start stop down recreate rebuild test reload clear bash style lint lint-diff static-analysis

deploy: build
	@echo "๐ฆ Build done"

build: create_env_file rebuild

# ๐ Dependencies
deps: composer-install

update-deps: composer-update

create_env_file:
	@if [ ! -f .env.local ]; then cp .env .env.local; fi
# ๐ Composer
composer-install ci: ACTION=install

composer-update cu: ACTION=update $(module)

composer-require cr: ACTION=require $(module)

composer composer-install ci composer-update composer-require cr: create_env_file
	$(COMPOSER) $(ACTION) \
			--ignore-platform-reqs \
			--no-ansi
# ๐ณ Docker Compose
start: create_env_file deps
	@echo "๐ Deploy!!!"
	@$(DOCKER_COMPOSE) up -d
stop:
	$(DOCKER_COMPOSE) stop
down:
	$(DOCKER_COMPOSE) down
recreate:
	@echo "๐ฅ Recreate container!!!"
	$(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
	make deps
rebuild:
	@echo "๐ฅ Rebuild container!!!"
	$(DOCKER_COMPOSE) build --pull --force-rm --no-cache
	make start

# ๐งช Tests
test: create_env_file
	docker exec -t $(CONTAINER) ./vendor/bin/phpunit -v

# ๐ฆ Apache
reload:
	$(EXEC) /bin/bash service apache2 restart || true

# ๐งน Clear cache
clear:
	$(SYMFONY) cache:clear

# ๐ Shell
bash:
	$(DOCKER_COMPOSE) exec -it $(CONTAINER) /bin/bash

# ๐ฆ Linter
style: lint static-analysis
lint:
	$(DOCKER_COMPOSE) exec -it $(CONTAINER) ./vendor/bin/php-cs-fixer fix --diff
	@echo "Coding Standar Fixer Executed โ"

lint-diff:
	$(DOCKER_COMPOSE) exec -it $(CONTAINER) ./vendor/bin/php-cs-fixer fix --dry-run --diff
	@echo "Coding Standar Fixer Executed โ"

static-analysis:
	$(DOCKER_COMPOSE) exec -it $(CONTAINER) ./vendor/bin/phpstan analyse -c phpstan.neon.dist