<?php

namespace src\Importer\Business\Importers\Product;

use src\Importer\Persistence\EntityBuilders\ProductToCategoryEntityBuilder;
use src\Importer\Persistence\ImporterReader;
use stdClass;

class ProductToCategoryImporter
{
	private ImporterReader $importerReader;
	private ProductToCategoryEntityBuilder $productToCategoryEntityBuilder;

	public function __construct
	(
		ImporterReader $importerReader,
		ProductToCategoryEntityBuilder $productToCategoryEntityBuilder
	) {
		$this->importerReader = $importerReader;
		$this->productToCategoryEntityBuilder = $productToCategoryEntityBuilder;
	}

	public function import(array $productAbstractCollection, int $fkProductAbstract): void
	{
		$idCategory = $this->importerReader->getCategoryIdByCategoryKey($productAbstractCollection['attributes']['fkCategory']);
		$preparedData = $this->prepareProductToCategoryData($idCategory, $fkProductAbstract);

		$entity = $this->productToCategoryEntityBuilder->buildEntity($preparedData);
		$entity->save();
	}

	private function prepareProductToCategoryData(int $fkCategory, int $fkProductAbstract): stdClass
	{
		$preparedData = new stdClass();

		$preparedData->fk_category = $fkCategory;
		$preparedData->fk_product_abstract = $fkProductAbstract;

		return $preparedData;
	}
}