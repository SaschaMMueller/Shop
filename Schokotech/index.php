<?php

use kernel\System\System;
use SetUp\DatabaseManagers\DatabaseCreator;

require_once 'Config.php';
require_once 'vendor/autoload.php';

$databaseCreator = new DatabaseCreator();
$databaseCreator->createDatabase();

$application = new System();
$application->start();
