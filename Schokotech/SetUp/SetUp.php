<?php

use SetUp\DatabaseManagers\DatabaseCreator;
use SetUp\DatabaseManagers\DatabaseMigrator;
use SetUp\DatabaseManagers\VersionControl;
use src\DatabaseConnector;

require_once '/var/www/html/Shop/Schokotech/Config.php';
require_once '/var/www/html/Shop/Schokotech/vendor/autoload.php';

$databaseCreator = new DatabaseCreator();
$databaseCreator->createDatabase();
$databaseConnector = new DatabaseConnector();
$connection = $databaseConnector->createConnectionToServer();
$versionController = new VersionControl(new DatabaseMigrator);
$versionController->migrateNewDatabaseSchemaChanges($connection);
