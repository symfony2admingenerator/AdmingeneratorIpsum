#!/bin/sh

# Rebuild doctrine fixtures
php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console doctrine:fixtures:load

# Rebuild doctrine odm fixtures
php app/console doctrine:mongodb:schema:drop --force
php app/console doctrine:mongodb:schema:create
php app/console doctrine:mongodb:fixtures:load
