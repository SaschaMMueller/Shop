<?php

namespace SetUp\DatabaseManagers;

use PDO;

class VersionControl
{
    public function __construct(DatabaseMigrator $databaseMigrator)
    {
        $this->databaseMigrator = $databaseMigrator;
    }

    private DatabaseMigrator $databaseMigrator;

    public function migrateNewDatabaseSchemaChanges(PDO $connection): void
    {
        $counter = 0;

        foreach (glob("DatabaseMigrations/*.php") as $fileLocation)
        {
        	$row = $connection->prepare("SELECT * FROM database_migration_version");
        	$row->execute();
			$migrationVersionLocal = $row->rowCount();

            if ($migrationVersionLocal == $counter)
            {
				$row = $connection->prepare("INSERT INTO database_migration_version(version) VALUES (substr('$fileLocation', -17))");
				$row->execute();
                $this->databaseMigrator->migrateDatabase($connection, $fileLocation);
            }
            $counter++;
        }
    }
}