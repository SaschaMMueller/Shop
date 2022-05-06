<?php

namespace src\Importer\Persistence;

use PDO;
use PDOStatement;
use src\DatabaseConnector;

class ImporterQueryContainer
{
	private DatabaseConnector $databaseConnector;
	private PDO $connection;

	public function __construct(DatabaseConnector $databaseConnector)
	{
		$this->databaseConnector = $databaseConnector;
		$this->connection = $this->databaseConnector->createConnectionToServer();
	}

	public function getRowCountQuery(string $tableName): PDOStatement
	{
		return $this->connection->prepare('SELECT COUNT(*) FROM ' . $tableName);
	}

	public function getLanguageKeyQuery(string $languageAbbreviation): PDOStatement
	{
		$query = $this->connection->prepare('SELECT id_language FROM language WHERE name =:languageAbbreviation;');
		$query->bindParam(':languageAbbreviation', $languageAbbreviation);

		return $query;
	}

	public function getLanguagesQuery(): PDOStatement
	{
		return $this->connection->prepare("SELECT * FROM language");
	}

	public function getCategoryIdByCategoryKeyQuery(int $categoryKey): PDOStatement
	{
		$query = $this->connection->prepare('SELECT id_category FROM category WHERE category_key =:categoryKey;');
		$query->bindParam(':categoryKey', $categoryKey);

		return $query;
	}

	public function getLocalizedCategoriesQuery(int $fk_language): PDOStatement
	{
		$query = $this->connection->prepare(
			'SELECT name, fk_category 
			FROM category_localized_attributes 
			WHERE fk_language =:fk_language;');
		$query->bindParam(':fk_language', $fk_language);

		return $query;
	}

	public function getUrlDataQuery(int $fk_language): PDOStatement
	{
		$query = $this->connection->prepare(
			'SELECT id_url, url_system
			FROM url
			WHERE fk_language =:fk_language;');
		$query->bindParam(':fk_language', $fk_language);

		return $query;
	}
}