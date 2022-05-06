<?php

namespace src\Importer\Business\Importers;

use src\Importer\Business\DataPreparators\CategoryDataPreparator;
use src\Importer\Business\FileOpener;
use src\Importer\Business\FileParserSelector;
use src\Importer\Persistence\EntityBuilders\CategoryEntityBuilder;
use src\Importer\Persistence\ImporterReader;
use src\Shared\Entities\CategoryEntity;

class CategoryImporter extends BaseImporter
{
	protected const IMPORT_FILE = '/ImporterFiles/categories.csv';

	private FileOpener $fileOpener;
	private CategoryEntityBuilder $categoryEntityBuilder;
	private FileParserSelector $fileParserSelector;
	private CategoryDataPreparator $categoryDataPreparator;
	private ImporterReader $importerReader;

	public function __construct(
		FileOpener $fileOpener,
		CategoryEntityBuilder $categoryEntityBuilder,
		FileParserSelector $fileParserSelector,
		CategoryDataPreparator $categoryDataPreparator,
		ImporterReader $importerReader
	) {
		$this->fileOpener = $fileOpener;
		$this->categoryEntityBuilder = $categoryEntityBuilder;
		$this->fileParserSelector = $fileParserSelector;
		$this->categoryDataPreparator = $categoryDataPreparator;
		$this->importerReader = $importerReader;
	}

	public function shouldImport(): bool
	{
		$rowCount = $this->importerReader->getRowCount(CategoryEntity::TABLE_NAME);

		return $rowCount === 0;
	}

	public function import(): void
	{
		$categoryFile = $this->openFile();
		$categoryData = $this->parse($categoryFile);
		$categoryData = $this->categoryDataPreparator->prepareData($categoryData);
		$this->persist($categoryData);
		fclose($categoryFile);
		var_dump("CATEGORY IMPORT WAS A SUCCESS!");
	}

	private function openFile()
	{
		return $this->fileOpener->openFile($this->getAbsoluteImportFilePath());
	}

	private function persist(array $categoryData): void
	{
		foreach($categoryData as $data)
		{
			$categoryEntity = $this->categoryEntityBuilder->buildEntity($data);
			$categoryEntity->save();
		}
	}

	private function parse($categoryFile): string
	{
		return $this->fileParserSelector
			->selectParser($this->getAbsoluteImportFilePath())
			->parse($categoryFile);
	}
}