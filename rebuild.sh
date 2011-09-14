#!/bin/sh

# Rebuild doctrine fixtures
php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console doctrine:fixtures:load

# Rebuild doctrine odm fixtures
php app/console doctrine:mongodb:schema:drop
php app/console doctrine:mongodb:schema:create
php app/console doctrine:mongodb:fixtures:load

# Rebuild propel
php app/console propel:build
php app/console propel:insert-sql --force
php app/console propel:fixtures:load --dir=src/Admingenerator/PropelDemoBundle/Resources/fixtures
