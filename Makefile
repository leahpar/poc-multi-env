
PHP				= php
PHP_MAX			= php -d memory_limit=1024M
SYMFONY         = $(PHP) bin/console
SYMFONY_BIN     = symfony
COMPOSER        = composer
YARN            = yarn
NPM             = npm
GIT             = git
ENCORE			= ./node_modules/.bin/encore
TARGET_PHP		= 7.3

include .env.local





.DEFAULT_GOAL=help
help: ## Show this help
	@awk 'BEGIN {FS = ":.*##"; } /^[a-zA-Z_-]+:.*?##/ { printf "$(PRIMARY_COLOR)%-10s$(NO_COLOR) %s\n", $$1, $$2 }' $(MAKEFILE_LIST) | sort


env: ## création nouvel environnement $APP_ENV
	echo .env.${APP_ENV}.local



