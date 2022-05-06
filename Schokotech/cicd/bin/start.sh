#!/usr/bin/env sh
set -eux
#Intention der zeilen hinzufügen/durch ersetzen
#started den mysql container
docker-compose up --detach mysql
#führt composer install aus
docker-compose run --no-deps --rm --user="$(id -u):$(id -g)" php composer install --no-interaction
#erstellt und befüllt die Datenbank und die Tabellen
docker-compose run --no-deps --rm --user="$(id -u):$(id -g)" php bash SetUp/SetUp.sh --no-interaction
#startet alle container
docker-compose up --detach
