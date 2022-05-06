<?php

namespace src\CmsPage\Persistence;

use PDO;
use PDOStatement;
use src\DatabaseConnector;

class CmsPageQueryContainer
{
	private DatabaseConnector $databaseConnector;
	private PDO $connection;

	public function __construct(DatabaseConnector $databaseConnector)
	{
		$this->databaseConnector = $databaseConnector;
		$this->connection = $this->databaseConnector->createConnectionToServer();
	}

	public function findContactsQuery(): PDOStatement
	{
		return $this->connection->prepare("SELECT * FROM cms_page");
	}
}
