SHELL = /bin/bash

UPLOADS_DIR = ./web/uploads
DB_DIR = ./db
VAR_DIR = ./var
SESSIONS_DIR = ./var/sessions
LOGS_DIR = ./var/logs
CACHE_DIR = ./var/cache

build:
	if [ -d ${VAR_DIR} ]; then                                    \
			chmod -R o+w ${VAR_DIR};                              \
	else                                                          \
			mkdir ${VAR_DIR} && chmod -R o+w ${VAR_DIR};          \
	fi;
	if [ -d ${LOGS_DIR} ]; then                                   \
			chmod -R o+w ${LOGS_DIR};                             \
	else                                                          \
			mkdir ${LOGS_DIR} && chmod -R o+w ${LOGS_DIR};        \
	fi;
	if [ -d ${CACHE_DIR} ]; then                                  \
			chmod -R o+w ${CACHE_DIR};                            \
	else                                                          \
			mkdir ${CACHE_DIR} && chmod -R o+w ${CACHE_DIR};      \
	fi;
	if [ -d ${SESSIONS_DIR} ]; then                               \
			chmod -R o+w ${SESSIONS_DIR};                         \
	else                                                          \
			mkdir ${SESSIONS_DIR} && chmod -R o+w ${SESSIONS_DIR};\
	fi;

	if [ -d ${DB_DIR} ]; then                                     \
			chmod -R o+w ${DB_DIR};                               \
	else                                                          \
			mkdir ${DB_DIR} && chmod -R o+w ${DB_DIR};            \
	fi;

	if [ -d ${UPLOADS_DIR} ]; then                                \
			chmod -R o+w ${UPLOADS_DIR};                          \
	else                                                          \
			mkdir ${UPLOADS_DIR} && chmod -R o+w ${UPLOADS_DIR};  \
	fi;
	composer install
	yarn install
	php bin/console --no-interaction doctrine:migrations:migrate
	chmod o+w ./db/lillydoo.db
run:
	yarn encore production
	docker-compose up
stop:
	docker-compose down