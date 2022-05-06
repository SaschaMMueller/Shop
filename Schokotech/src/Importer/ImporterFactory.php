<?php

namespace src\Importer;

use src\DatabaseConnector;
use src\Importer\Business\DataPreparators\CategoryDataPreparator;
use src\Importer\Business\DataPreparators\CategoryLocalizedAttributesDataPreparator;
use src\Importer\Business\DataPreparators\PaymentMethodDataPreparator;
use src\Importer\Business\DataPreparators\ProductDataPreparator;
use src\Importer\Business\DataPreparators\CategoryUrlDataPreparator;
use src\Importer\Business\DataPreparators\ProductUrlDataPreparator;
use src\Importer\Business\DataPreparators\UrlToCategoryDataPreparator;
use src\Importer\Business\FileOpener;
use src\Importer\Business\FileParsers\CsvFileParser;
use src\Importer\Business\FileParsers\XlsFileParser;
use src\Importer\Business\FileParserSelector;
use src\Importer\Business\Importers\CategoryImporter;
use src\Importer\Business\Importers\CategoryLocalizedAttributesImporter;
use src\Importer\Business\Importers\CategoryUrlImporter;
use src\Importer\Business\Importers\ImporterInterface;
use src\Importer\Business\Importers\PaymentMethod\PaymentMethodAttributeImporter;
use src\Importer\Business\Importers\PaymentMethod\PaymentMethodLocalizedAttributeImporter;
use src\Importer\Business\Importers\PaymentMethodImporter;
use src\Importer\Business\Importers\Product\ProductAbstractImporter;
use src\Importer\Business\Importers\Product\ProductPurchasableImporter;
use src\Importer\Business\Importers\Product\ProductToCategoryImporter;
use src\Importer\Business\Importers\Product\ProductUrlImporter;
use src\Importer\Business\Importers\ProductImporter;
use src\Importer\Business\Importers\UrlToCategoryImporter;
use src\Importer\Persistence\EntityBuilders\CategoryEntityBuilder;
use src\Importer\Persistence\EntityBuilders\CategoryLocalizedAttributesEntityBuilder;
use src\Importer\Persistence\EntityBuilders\PaymentMethodEntityBuilder;
use src\Importer\Persistence\EntityBuilders\PaymentMethodLocalizedAttributeEntityBuilder;
use src\Importer\Persistence\EntityBuilders\ProductAbstractEntityBuilder;
use src\Importer\Persistence\EntityBuilders\ProductImagesEntityBuilder;
use src\Importer\Persistence\EntityBuilders\ProductLocalizedAttributesEntityBuilder;
use src\Importer\Persistence\EntityBuilders\ProductPurchasableEntityBuilder;
use src\Importer\Persistence\EntityBuilders\ProductToCategoryEntityBuilder;
use src\Importer\Persistence\EntityBuilders\UrlEntityBuilder;
use src\Importer\Persistence\EntityBuilders\UrlToCategoryEntityBuilder;
use src\Importer\Persistence\EntityBuilders\UrlToProductEntityBuilder;
use src\Importer\Persistence\ImporterQueryContainer;
use src\Importer\Persistence\ImporterReader;

class ImporterFactory
{
	public function createProductImporter(): ProductImporter
	{
		return new ProductImporter(
			$this->createImporterReader(),
			$this->createFileOpener(),
			$this->createFileParserSelector(),
			$this->createProductDataPreparator(),
			$this->createProductAbstractImporter(),
			$this->createProductPurchasableImporter()
		);
	}

	public function createCategoryImporter(): ImporterInterface
	{
		return new CategoryImporter(
			$this->createFileOpener(),
			$this->createCategoryEntityBuilder(),
			$this->createFileParserSelector(),
			$this->createCategoryDataPreparator(),
			$this->createImporterReader()
		);
	}

	public function createCategoryLocalizedAttributesImporter(): ImporterInterface
	{
		return new CategoryLocalizedAttributesImporter(
			$this->createFileOpener(),
			$this->createCategoryLocalizedAttributesEntityBuilder(),
			$this->createFileParserSelector(),
			$this->createCategoryLocalizedAttributesDataPreparator(),
			$this->createImporterReader()
		);
	}

	public function createUrlImporter(): ImporterInterface
	{
		return new CategoryUrlImporter(
			$this->createFileOpener(),
			$this->createUrlEntityBuilder(),
			$this->createFileParserSelector(),
			$this->createUrlDataPreparator(),
			$this->createImporterReader()
		);
	}

	public function createUrlToCategoryImporter(): ImporterInterface
	{
		return new UrlToCategoryImporter(
			$this->createUrlToCategoryEntityBuilder(),
			$this->createFileParserSelector(),
			$this->createUrlTocategoryDataPreparator(),
			$this->createImporterReader()
		);
	}

	public function createPaymentMethodImporter(): ImporterInterface
	{
		return new PaymentMethodImporter(
			$this->createFileOpener(),
			$this->createFileParserSelector(),
			$this->createPaymentMethodsDataPreparator(),
			$this->createPaymentMethodAttributeImporter(),
			$this->createPaymentMethodLocalizedAttributeImporter(),
			$this->createImporterReader()
		);
	}

	public function createImporterProvider(): ImporterProvider
	{
		return new ImporterProvider();
	}

	public function createPaymentMethodAttributeImporter(): PaymentMethodAttributeImporter
	{
		return new PaymentMethodAttributeImporter(
			$this->createPaymentMethodEntityBuilder(),
			$this->createPaymentMethodLocalizedAttributeImporter(),
			$this->createImporterReader(),
		);
	}

	private function createProductPurchasableImporter(): ProductPurchasableImporter
	{
		return new ProductPurchasableImporter(
			$this->createProductPurchasableEntityBuilder()
		);
	}

	private function createProductPurchasableEntityBuilder(): ProductPurchasableEntityBuilder
	{
		return new ProductPurchasableEntityBuilder();
	}

	private function createProductAbstractImporter(): ProductAbstractImporter
	{
		return new ProductAbstractImporter(
			$this->createProductAbstractEntityBuilder(),
			$this->createProductImagesEntityBuilder(),
			$this->createProductLocalizedAttributesEntityBuilder(),
			$this->createProductUrlImporter(),
			$this->createProductToCategoryImporter()
		);
	}

	private function createProductToCategoryImporter(): ProductToCategoryImporter
	{
		return new ProductToCategoryImporter(
			$this->createImporterReader(),
			$this->createProductToCategoryEntityBuilder()
		);
	}

	private function createProductToCategoryEntityBuilder(): ProductToCategoryEntityBuilder
	{
		return new ProductToCategoryEntityBuilder();
	}

	private function createProductUrlImporter(): ProductUrlImporter
	{
		return new ProductUrlImporter(
			$this->createProductUrlDataPreparator(),
			$this->createUrlEntityBuilder(),
			$this->createUrlToProductEntityBuilder()
		);
	}

	private function createUrlToProductEntityBuilder(): UrlToProductEntityBuilder
	{
		return new UrlToProductEntityBuilder();
	}

	private function createProductUrlDataPreparator(): ProductUrlDataPreparator
	{
		return new ProductUrlDataPreparator();
	}

	private function createProductLocalizedAttributesEntityBuilder(): ProductLocalizedAttributesEntityBuilder
	{
		return new ProductLocalizedAttributesEntityBuilder();
	}

	private function createProductImagesEntityBuilder(): ProductImagesEntityBuilder
	{
		return new ProductImagesEntityBuilder();
	}

	private function createProductAbstractEntityBuilder(): ProductAbstractEntityBuilder
	{
		return new ProductAbstractEntityBuilder();
	}

	private function createFileOpener(): FileOpener
	{
		return new FileOpener();
	}

	private function createProductDataPreparator(): ProductDataPreparator
	{
		return new ProductDataPreparator();
	}

	private function createPaymentMethodLocalizedAttributeImporter(): PaymentMethodLocalizedAttributeImporter
	{
		return new PaymentMethodLocalizedAttributeImporter(
			$this->createPaymentMethodLocalizedAttributeEntityBuilder(),
		);
	}

	private function createPaymentMethodEntityBuilder(): PaymentMethodEntityBuilder
	{
		return new PaymentMethodEntityBuilder();
	}

	private function createPaymentMethodLocalizedAttributeEntityBuilder(): PaymentMethodLocalizedAttributeEntityBuilder
	{
		return new PaymentMethodLocalizedAttributeEntityBuilder();
	}

	private function createPaymentMethodsDataPreparator(): PaymentMethodDataPreparator
	{
		return new PaymentMethodDataPreparator();
	}

	private function createCategoryEntityBuilder(): CategoryEntityBuilder
	{
		return new CategoryEntityBuilder();
	}

	private function createCategoryLocalizedAttributesEntityBuilder(): CategoryLocalizedAttributesEntityBuilder
	{
		return new CategoryLocalizedAttributesEntityBuilder();
	}

	private function createUrlEntityBuilder(): UrlEntityBuilder
	{
		return new UrlEntityBuilder();
	}

	private function createUrlToCategoryEntityBuilder(): UrlToCategoryEntityBuilder
	{
		return new UrlToCategoryEntityBuilder();
	}

	private function createFileParserSelector(): FileParserSelector
	{
		return new FileParserSelector($this->createImportFileParsers());
	}

	private function createImportFileParsers(): array
	{
		return [
			'csv' => $this->createCsvFileParser(),
			'xls' => $this->createXlsFileParser(),
			];
	}

	private function createCsvFileParser(): CsvFileParser
	{
		return new CsvFileParser();
	}

	private function createXlsFileParser(): XlsFileParser
	{
		return new XlsFileParser();
	}

	private function createCategoryDataPreparator(): CategoryDataPreparator
	{
		return new CategoryDataPreparator();
	}

	private function createCategoryLocalizedAttributesDataPreparator(): CategoryLocalizedAttributesDataPreparator
	{
		return new CategoryLocalizedAttributesDataPreparator($this->createImporterReader());
	}

	private function createUrlDataPreparator(): CategoryUrlDataPreparator
	{
		return new CategoryUrlDataPreparator();
	}

	private function createUrlToCategoryDataPreparator(): UrlToCategoryDataPreparator
	{
		return new UrlToCategoryDataPreparator();
	}

	private function createImporterReader(): ImporterReader
	{
		return new ImporterReader($this->createImporterQueryContainer());
	}

	private function createImporterQueryContainer(): ImporterQueryContainer
	{
		return new ImporterQueryContainer($this->createDatabaseConnector());
	}

	private function createDatabaseConnector(): DatabaseConnector
	{
		return new DatabaseConnector();
	}
}