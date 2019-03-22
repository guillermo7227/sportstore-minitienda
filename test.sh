#!/bin/bash
#php artisan config:cache --env=testing
if [ $# -eq 1 ] 
then
	vendor/bin/phpunit --filter $1
else
	vendor/bin/phpunit
fi
#php artisan config:cache

