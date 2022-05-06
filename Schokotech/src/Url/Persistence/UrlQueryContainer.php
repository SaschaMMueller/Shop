<?php

namespace src\Url\Persistence;

use PDO;
use PDOStatement;
use src\DatabaseConnector;

class UrlQueryContainer
{
	private DatabaseConnector $databaseConnector;
	private PDO $connection;

	public function __construct(DatabaseConnector $databaseConnector)
	{
		$this->databaseConnector = $databaseConnector;
		$this->connection = $this->databaseConnector->createConnectionToServer();
	}

	public function findSystemUrlBySeoUrlQuery(string $seoUrl): PDOStatement
	{
		$query = $this->connection->prepare("SELECT * FROM url WHERE url_seo = :seoUrl");
		$query->bindParam(':seoUrl', $seoUrl);

		return $query;
	}

	public function getUrlForCategoryQuery(int $idCategory): PDOStatement
	{
		$query = $this->connection->prepare(
			"SELECT * FROM url
						INNER JOIN url_to_category
							ON url.id_url = url_to_category.fk_url
							AND url_to_category.fk_category = :id_category");
		$query->bindParam(':id_category', $idCategory);

		return $query;
	}

	public function getUrlForProductQuery(int $idProductAbstract): PDOStatement
	{
		$query = $this->connection->prepare(
			"SELECT * FROM url
						INNER JOIN url_to_product
							ON url.id_url = url_to_product.fk_url
							AND url_to_product.fk_product_abstract = :id_product_abstract");
		$query->bindParam(':id_product_abstract', $idProductAbstract);

		return $query;
	}

	public function getLanguagesQuery(): PDOStatement
	{
		return $this->connection->prepare("SELECT name FROM language");
	}

}