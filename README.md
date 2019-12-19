# Rector for nette-api

## Installation
After downloading this repository follow these instructions:

cd nette-api-app
composer install

cd ../rector
composer install

## Executing rector
vendor/bin/rector process ../nette-api-app/app/ --autoload-file ../nette-api-app/app/bootstrap.php --dry-run
