.PHONY: help deploy up down restart logs bash migrate

help: ## Print help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

deploy: ## One command to deploy: build, run, install deps, and migrate
	@echo "Starting deployment..."
	docker compose up -d --build
	@echo "Installing Composer dependencies..."
	docker compose exec -T app composer install --no-interaction --prefer-dist --optimize-autoloader
	@echo "Setting up environment..."
	docker compose exec -T app cp -n .env.example .env || true
	docker compose exec -T app php artisan key:generate
	@echo "Waiting for database to be ready..."
	sleep 15
	@echo "Running migrations..."
	docker compose exec -T app php artisan migrate --force
	@echo "------------------------------------------------------"
	@echo "Deployment finished! 🚀"
	@echo "Access the application at: http://localhost:8000"
	@echo "------------------------------------------------------"

up: ## Start the containers
	docker compose up -d

down: ## Stop the containers
	docker compose down

restart: ## Restart the containers
	docker compose restart

logs: ## View container logs
	docker compose logs -f

bash: ## Enter the app container shell
	docker compose exec app bash

migrate: ## Run database migrations
	docker compose exec app php artisan migrate

fresh: ## Run fresh database migrations (drops all tables)
	docker compose exec app php artisan migrate:fresh --seed
