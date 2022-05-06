<?php

namespace src\Category\Persistence;

use PDO;
use PDOStatement;
use src\DatabaseConnector;

class CategoryQueryContainer
{
	private DatabaseConnector $databaseConnector;
	private PDO $connection;

	public function __construct(DatabaseConnector $databaseConnector)
	{
		$this->databaseConnector = $databaseConnector;
		$this->connection = $this->databaseConnector->createConnectionToServer();
	}

	public function findMainCategoriesQuery(): PDOStatement
	{
		return $this->connection->prepare("SELECT * FROM category WHERE parent IN 
                                       				(SELECT id_category FROM category WHERE parent IS NULL)");
	}

	public function findSubCategoriesByIdCategoryQuery(int $idCategory): PDOStatement
	{
		$query = $this->connection->prepare("SELECT * FROM category WHERE parent = :idCategory");
		$query->bindParam(':idCategory', $idCategory);

		return $query;
	}

	public function getCategoriesLocalizedAttributesQuery(): PDOStatement
	{
		return $this->connection->prepare("SELECT * FROM category_localized_attributes");
	}
}