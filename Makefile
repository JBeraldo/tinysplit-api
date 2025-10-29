ENV = .env.dev.local
dev:
	docker run --rm -itv $(shell pwd):/app -w /app composer:2.7.2 composer install --no-scripts --ignore-platform-reqs
#	docker compose exec app php bin/console lexik:jwt:generate-keypair
	docker compose up -d
stop:
	docker compose down
refresh: stop dev
analyze:
	docker compose --env-file $(ENV) exec app vendor/bin/phpstan analyse -l 6 src
migrate:
	docker compose --env-file $(ENV) exec app php bin/console make:migration
migrate-up:
	docker compose --env-file $(ENV) exec app php bin/console doctrine:migrations:migrate