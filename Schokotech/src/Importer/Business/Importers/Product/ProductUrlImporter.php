<?php

namespace src\Importer\Business\Importers\Product;

use src\Importer\Business\DataPreparators\ProductUrlDataPreparator;
use src\Importer\Persistence\EntityBuilders\UrlEntityBuilder;
use src\Importer\Persistence\EntityBuilders\UrlToProductEntityBuilder;
use src\Shared\System\Application;
use stdClass;

class ProductUrlImporter
{
	private ProductUrlDataPreparator $productUrlDataPreparator;
	private UrlEntityBuilder $urlEntityBuilder;
	private UrlToProductEntityBuilder $urlToProductEntityBuilder;

	public function __construct
	(
		ProductUrlDataPreparator $productUrlDataPreparator,
		UrlEntityBuilder $urlEntityBuilder,
		UrlToProductEntityBuilder $urlToProductEntityBuilder
	) {
		$this->productUrlDataPreparator = $productUrlDataPreparator;
		$this->urlEntityBuilder = $urlEntityBuilder;
		$this->urlToProductEntityBuilder = $urlToProductEntityBuilder;
	}

	public function import(array $productAbstractCollection, string $idProductAbstract, stdClass $language): void
	{
		$preparedData = $this->productUrlDataPreparator->prepareUrlData($productAbstractCollection, $idProductAbstract, $language);
		$entity = $this->urlEntityBuilder->buildEntity($preparedData);
		$entity->save();

		$idUrl = Application::getInstance()->getConnection()->lastInsertId();

		$preparedData = $this->productUrlDataPreparator->prepareUrlToProductData($idUrl, $idProductAbstract);
		$entity = $this->urlToProductEntityBuilder->buildEntity($preparedData);
		$entity->save();
	}
}