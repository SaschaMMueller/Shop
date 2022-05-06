<?php

namespace SetUp\DatabaseManagers;

use Config;
use PDO;
use PDOException;

class DatabaseCreator
{
	public function createDatabase(): void
	{
		$dbCredentialsProvider = new DatabaseCredentialsProvider();
		$connectionString = sprintf(
			"mysql:host=%s",
			$dbCredentialsProvider->dbHost
		);

		try
		{
			$connection = new PDO($connectionString, $dbCredentialsProvider->dbUserName, $dbCredentialsProvider->dbPassword);

			$databaseQueryString = $connection->prepare("CREATE DATABASE IF NOT EXISTS " . $dbCredentialsProvider->dbName);
			$databaseQueryString->execute();

			$connection->query("use " . $dbCredentialsProvider->dbName);

			$versionControlString = "CREATE TABLE IF NOT EXISTS database_migration_version(
													database_migration_version_id int(100) auto_increment primary key, 
													version varchar(300)
													);";
			$connection->exec($versionControlString);
		}
		catch(PDOException $e)
		{
			echo "creator error: " . $e . " ";
			//echo "table version control" . "<br>" . $e->getMessage();
			die;
		}
	}
}
