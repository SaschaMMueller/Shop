<?php

namespace SetUp\DatabaseManagers;

use PDO;

class DatabaseMigrator
{
    public function migrateDatabase(PDO $connection, string $fileLocation): void
    {
        clearstatcache();
        $migrationFile = fopen($fileLocation, 'r');
        $migrationString = fread($migrationFile, filesize($fileLocation));
        $queryStrings = explode(';', $migrationString);

        foreach ($queryStrings as $value)
        {
			$row = $connection->prepare(sprintf('%s', $value));
			$row->execute();
        }
        fclose($migrationFile);
    }
}