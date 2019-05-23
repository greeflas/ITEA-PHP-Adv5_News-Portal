.DEFAULT_GOAL := help
.PHONY: help
help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[%a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

up: ## Start docker container.
	docker-compose start

stop: ## Stop docker containers.
	docker-compose stop

fixtures: ## Loads fixtures to database.
	docker-compose exec php-fpm ./bin/console doctrine:fixtures:load

migrate: ## Runs application migrations.
	docker-compose exec php-fpm ./bin/console doctrine:migrations:migrate
