<?php

namespace src\Cart\Persistence;

use PDO;
use PDOStatement;
use src\DatabaseConnector;

class CartQueryContainer
{
	private DatabaseConnector $databaseConnector;
	private PDO $connection;

	public function __construct(DatabaseConnector $databaseConnector)
	{
		$this->databaseConnector = $databaseConnector;
		$this->connection = $this->databaseConnector->createConnectionToServer();
	}

	public function findCartItemDataBySkuQuery(string $skuPurchasable): PDOStatement
	{
		$query = $this->connection->prepare(
			"SELECT product_localized_attributes.name, product_images.image_path, product_purchasable.size, product_purchasable.price, product_purchasable.sku, url.url_seo
							FROM product_abstract
									 INNER JOIN product_images
												ON product_abstract.id_product_abstract = product_images.fk_product_abstract
									 INNER JOIN product_localized_attributes
												ON product_abstract.id_product_abstract = product_localized_attributes.fk_product_abstract
									 INNER JOIN product_purchasable
												ON product_abstract.id_product_abstract = product_purchasable.fk_product_abstract
													and product_purchasable.sku = :sku_purchasable
									 INNER JOIN url_to_product
												ON product_abstract.id_product_abstract = url_to_product.fk_product_abstract
									 INNER JOIN url
												ON url.id_url = url_to_product.fk_url;");
		$query->bindParam(':sku_purchasable', $skuPurchasable);

		return $query;
	}
}