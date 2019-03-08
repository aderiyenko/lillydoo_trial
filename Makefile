build:
	mkdir web/uploads && chmod -R o+w web/uploads/
	mkdir db && chmod -R o+w db/
	mkdir var && chmod -R o+w var/
	composer install
	yarn install
	php bin/console doctrine:schema:update --force
	php bin/console doctrine:migrations:migrate
run:
	docker-compose up