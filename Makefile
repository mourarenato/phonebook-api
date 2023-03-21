fileMode: ##@Configuration Sets git fileMode to false
	@echo "Configuring git fileMode to false"
	git config core.fileMode false

files: ##@Copy files and set permissions
	sudo chmod 777 -R *
	sudo cp .env.example .env
	sudo cp docker-compose.example.yml docker-compose.yml

start: ###Up containers
	docker-compose up -d

install: ##Install dependencies
	@echo "Installing dependencies"
	docker-compose up -d
	sudo chmod 777 -R vendor/
	make files

migrate: ##Run migrations
	@echo "Running migrations"
	docker exec -it php-phonebook-api bash -c "php artisan migrate"

migrate-reset: ##Reset migrations
	@echo "Reverting migrations"
	docker exec -it php-phonebook-api bash -c "php artisan migrate:reset"

seed-db: ##Feed database
	@echo "Feeding database"
	docker exec -it php-phonebook-api bash -c "php artisan db:seed --class=UserSeeder;php artisan db:seed --class=PhonebookSeeder"

restart: ##Restart server
	docker-compose down;docker-compose up -d

