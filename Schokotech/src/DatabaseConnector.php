<?php

namespace src;

use Config;
use PDO;
use PDOException;
use SetUp\DatabaseManagers\DatabaseCredentialsProvider;

class DatabaseConnector
{
	public function createConnectionToServer(): PDO
	{
		$dbCredentialsProvider = new DatabaseCredentialsProvider();
		$connectionString = sprintf(
			"mysql:host=%s;dbname=%s;",
			$dbCredentialsProvider->dbHost,
			$dbCredentialsProvider->dbName
		);

		try
		{
			$connection = new PDO($connectionString, $dbCredentialsProvider->dbUserName, $dbCredentialsProvider->dbPassword);
		}
		catch(PDOException $e)
		{
			echo 'Connector error ';
			//var_dump($e);
			die;
		}

		return $connection;
	}
}
