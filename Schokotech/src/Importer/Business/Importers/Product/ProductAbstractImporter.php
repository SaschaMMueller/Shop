<?php

namespace src\Importer\Business\Importers\Product;

use src\Importer\Persistence\EntityBuilders\ProductAbstractEntityBuilder;
use src\Importer\Persistence\EntityBuilders\ProductImagesEntityBuilder;
use src\Importer\Persistence\EntityBuilders\ProductLocalizedAttributesEntityBuilder;
use src\Shared\System\Application;

class ProductAbstractImporter
{
	private ProductAbstractEntityBuilder $productAbstractEntityBuilder;
	private ProductImagesEntityBuilder $productImagesEntityBuilder;
	private ProductLocalizedAttributesEntityBuilder $productLocalizedAttributesEntityBuilder;
	private ProductUrlImporter $productUrlImporter;
	private ProductToCategoryImporter $productToCategoryImporter;

	public function __construct
	(
		ProductAbstractEntityBuilder $productAbstractEntityBuilder,
		ProductImagesEntityBuilder $productImagesEntityBuilder,
		ProductLocalizedAttributesEntityBuilder $productLocalizedAttributesEntityBuilder,
		ProductUrlImporter $productUrlImporter,
		ProductToCategoryImporter $productToCategoryImporter
	) {
		$this->productAbstractEntityBuilder = $productAbstractEntityBuilder;
		$this->productImagesEntityBuilder = $productImagesEntityBuilder;
		$this->productLocalizedAttributesEntityBuilder = $productLocalizedAttributesEntityBuilder;
		$this->productUrlImporter = $productUrlImporter;
		$this->productToCategoryImporter = $productToCategoryImporter;
	}

	public function import(array $productAbstractCollection, array $languages): int
	{
		$productAbstractEntity = $this->productAbstractEntityBuilder->buildEntity($productAbstractCollection);
		$productAbstractEntity->save();

		$idProductAbstract = Application::getInstance()->getConnection()->lastInsertId();

		$productImageEntity = $this->productImagesEntityBuilder->buildEntity($productAbstractCollection, $idProductAbstract);
		$productImageEntity->save();

		foreach($languages as $language)
		{
			$productLocalizedAttributesEntity = $this->productLocalizedAttributesEntityBuilder->buildEntity($productAbstractCollection, $idProductAbstract, $language);
			$productLocalizedAttributesEntity->save();

			$this->productUrlImporter->import($productAbstractCollection, $idProductAbstract, $language);
		}

		$this->productToCategoryImporter->import($productAbstractCollection, $idProductAbstract);

		return $idProductAbstract;
	}
}