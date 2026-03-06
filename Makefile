# Makefile for managing the PHP application with Docker Compose

# Variables
DC=docker-compose
APP_SERVICE=app

.PHONY: build run install stop clean status db-schema

# Build the Docker images
build:
	$(DC) build --no-cache

# Install PHP dependencies via Composer inside the application container
install:
	$(DC) run --rm $(APP_SERVICE) composer install

# Run the Docker Compose services in the background
run:
	$(DC) up -d

# Run crating db schema
db-schema:
	$(DC) exec app php bin/doctrine orm:schema-tool:create

# Add seed to db
db-seed:
	$(DC) exec app php seed.php

# Stop the Docker Compose services
stop:
	$(DC) stop

# Clean up Docker resources
clean:
	$(DC) down -v

# View service status
status:
	$(DC) ps

# Deploy project
deploy: build install run

# Config Doctrine & add seed
db: db-schema db-seed
