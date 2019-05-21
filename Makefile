.DEFAULT_GOAL := help
.PHONY: help
help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[%a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

up: ## Start docker container.
	symfony local:proxy:start
	symfony serve -d
	docker start itea_mysql

stop: ## Stop docker containers.
	symfony local:proxy:stop
	symfony server:stop
	docker stop itea_mysql

fixtures: ## Loads fixtures to database.
	./bin/console doctrine:fixtures:load

migrate: ## Runs application migrations.
	./bin/console doctrine:migrations:migrate
