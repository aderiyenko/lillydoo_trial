build:
	rm -rf ./web/uploads && mkdir web/uploads && chmod -R o+w web/uploads/
	rm -rf ./db && mkdir db && chmod -R o+w db/
	rm -rf ./var && mkdir var && chmod -R o+w var/
	rm -rf ./var/sessions && chmod -R o+w ./var/sessions
	composer install
	yarn install
	php bin/console --no-interaction doctrine:migrations:migrate
run:
	docker-compose up