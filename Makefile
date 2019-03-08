build:
	rm -rf ./web/uploads && mkdir web/uploads && chmod -R o+w web/uploads/
	rm -rf ./db && mkdir db && chmod -R o+w db/
	rm -rf ./var && mkdir var && chmod -R o+w var/
	composer install
	yarn install
	php bin/console doctrine:schema:update --force
	php bin/console doctrine:migrations:migrate
run:
	docker-compose up