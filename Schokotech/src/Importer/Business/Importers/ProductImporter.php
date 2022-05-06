<?php

namespace src\Importer\Business\Importers;

use src\Importer\Business\DataPreparators\ProductDataPreparator;
use src\Importer\Business\FileOpener;
use src\Importer\Business\FileParserSelector;
use src\Importer\Business\Importers\Product\ProductAbstractImporter;
use src\Importer\Business\Importers\Product\ProductPurchasableImporter;
use src\Importer\Persistence\ImporterReader;

class ProductImporter extends BaseImporter
{
	protected const IMPORT_FILES = [
		'/ImporterFiles/product_attributes.xlsx',
		'/ImporterFiles/product_attributes_localized.csv',
		'/ImporterFiles/product_stock.csv',
	];

	private ImporterReader $importerReader;
	private FileOpener $fileOpener;
	private FileParserSelector $fileParserSelector;
	private ProductDataPreparator $productDataPreparator;
	private ProductAbstractImporter $productAbstractImporter;
	private ProductPurchasableImporter $productPurchasableImporter;

	public function __construct(
		ImporterReader $importerReader,
		FileOpener $fileOpener,
		FileParserSelector $fileParserSelector,
		ProductDataPreparator $productDataPreparator,
		ProductAbstractImporter $productAbstractImporter,
		ProductPurchasableImporter $productPurchasableImporter
	) {
		$this->importerReader = $importerReader;
		$this->fileOpener = $fileOpener;
		$this->fileParserSelector = $fileParserSelector;
		$this->productDataPreparator = $productDataPreparator;
		$this->productAbstractImporter = $productAbstractImporter;
		$this->productPurchasableImporter = $productPurchasableImporter;
	}

	public function shouldImport(): bool
	{
		return true;
	}

	public function import(): void
	{
		$productRawFile = $this->openFile();
		$productJsonArray = $this->parse($productRawFile);

		$preparedData = $this->productDataPreparator->prepareProductJsonData($productJsonArray);
		$this->persist($preparedData);

		var_dump("PRODUCT IMPORT WAS A SUCCESS!");
	}

	private function openFile(): array
	{
		$filePaths = $this->getAbsoluteImportFilePaths();
		$rawFiles = [];

		foreach($filePaths as $filePath)
		{
			$rawFiles[substr(strrchr($filePath, "/"), 1)] = $this->fileOpener->openFile($filePath);
		}

		return $rawFiles;
	}

	private function parse(array $rawFiles): array
	{
		$jsonArray = [];

		foreach($rawFiles as $rawFile)
		{
			$arrayKey = array_search($rawFile, $rawFiles);

			$jsonArray[$arrayKey] = $this->fileParserSelector
				->selectParser($arrayKey)
				->parse($rawFile);
		}

		return $jsonArray;
	}

	private function persist(array $productDataCollection): void
	{
		$languages = $this->importerReader->getLanguages();

		foreach($productDataCollection as $productData)
		{
			$idProductAbstract = $this->productAbstractImporter->import($productData['abstract'], $languages);
			$this->productPurchasableImporter->import($productData['purchasable'], $idProductAbstract);
		}
	}
}
