<?php

namespace src\Product\Persistence;

use PDO;
use PDOStatement;
use src\DatabaseConnector;

class ProductQueryContainer
{
	private DatabaseConnector $databaseConnector;
	private PDO $connection;

	public function __construct(DatabaseConnector $databaseConnector)
	{
		$this->databaseConnector = $databaseConnector;
		$this->connection = $this->databaseConnector->createConnectionToServer();
	}

	public function findProductAbstractsQuery(): PDOStatement
	{
		return $this->connection->prepare("SELECT * FROM product_abstract");
	}

	public function findProductAbstractsByIdCategoryQuery(int $idCategory): PDOStatement
	{
		$query = $this->connection->prepare(
			"SELECT * FROM product_abstract pa
                		JOIN product_to_category ptc on pa.id_product_abstract = ptc.fk_product_abstract
                		WHERE ptc.fk_category = :fk_category;");
		$query->bindParam('fk_category', $idCategory);

		return $query;
	}

	public function findProductLocalizedAttributesByFkProductAbstractQuery(int $fkProductAbstract): PDOStatement
	{
		$query = $this->connection->prepare("SELECT * FROM product_localized_attributes WHERE fk_product_abstract = :fk_product_abstract");
		$query->bindParam(':fk_product_abstract', $fkProductAbstract);

		return $query;
	}

	public function findProductsPurchasableByIdProductAbstractQuery(int $fkProductAbstract): PDOStatement
	{
		$query = $this->connection->prepare("SELECT * FROM product_purchasable WHERE fk_product_abstract = :fk_product_abstract ORDER BY size");
		$query->bindParam(':fk_product_abstract', $fkProductAbstract);

		return $query;
	}

	public function findGeneralProductDataByIdProductAbstractQuery(int $fkProductAbstract): PDOStatement
	{
		$query = $this->connection->prepare(
			"SELECT product_abstract.id_product_abstract, product_images.image_path, product_to_category.fk_category
							FROM product_abstract
								INNER JOIN product_images
									ON product_abstract.id_product_abstract = product_images.fk_product_abstract
									and product_abstract.id_product_abstract = :fk_product_abstract
								INNER JOIN product_to_category
									ON product_abstract.id_product_abstract = product_to_category.fk_product_abstract
									and product_abstract.id_product_abstract = :fk_product_abstract;");
		$query->bindParam(':fk_product_abstract', $fkProductAbstract);

		return $query;
	}

	public function findCategoriesByFkCategoryQuery(): PDOStatement
	{
		return $this->connection->prepare(
			"SELECT category.id_category, category.parent, category_localized_attributes.name, url.url_seo
							FROM category
								 INNER JOIN category_localized_attributes
											ON category.id_category = category_localized_attributes.fk_category
								 INNER JOIN url_to_category
											ON category.id_category = url_to_category.fk_category
								 INNER JOIN url
											ON url_to_category.fk_url = url.id_url;");
	}
}