<?php

namespace src\Importer\Business\Importers;

use src\Importer\Business\DataPreparators\CategoryLocalizedAttributesDataPreparator;
use src\Importer\Business\FileOpener;
use src\Importer\Business\FileParserSelector;
use src\Importer\Persistence\EntityBuilders\CategoryLocalizedAttributesEntityBuilder;
use src\Importer\Persistence\ImporterReader;
use src\Shared\Entities\CategoryLocalizedAttributesEntity;

class CategoryLocalizedAttributesImporter extends BaseImporter
{
	protected const IMPORT_FILE = '/ImporterFiles/categories.csv';

	private FileOpener $fileOpener;
	private CategoryLocalizedAttributesEntityBuilder $categoryLocalizedAttributesEntityBuilder;
	private FileParserSelector $fileParserSelector;
	private CategoryLocalizedAttributesDataPreparator $categoryLocalizedAttributesDataPreparator;
	private ImporterReader $importerReader;

	public function __construct(
		FileOpener $fileOpener,
		CategoryLocalizedAttributesEntityBuilder $categoryLocalizedAttributesEntityBuilder,
		FileParserSelector $fileParserSelector,
		CategoryLocalizedAttributesDataPreparator $categoryLocalizedAttributesDataPreparator,
		ImporterReader $importerReader
	) {
		$this->fileOpener = $fileOpener;
		$this->categoryLocalizedAttributesEntityBuilder = $categoryLocalizedAttributesEntityBuilder;
		$this->fileParserSelector = $fileParserSelector;
		$this->categoryLocalizedAttributesDataPreparator = $categoryLocalizedAttributesDataPreparator;
		$this->importerReader = $importerReader;
	}

	public function shouldImport(): bool
	{
		$rowCount = $this->importerReader->getRowCount(CategoryLocalizedAttributesEntity::TABLE_NAME);

		return $rowCount === 0;
	}

	public function import(): void
	{
		$categoryFile = $this->openFile();
		$categoryLocalizedAttributesRawJson = $this->parse($categoryFile);
		$languages = $this->importerReader->getLanguages();
		$categoryLocalizedAttributes = $this->categoryLocalizedAttributesDataPreparator->prepareData($categoryLocalizedAttributesRawJson, $languages);
		$this->persist($categoryLocalizedAttributes);
		fclose($categoryFile);
		var_dump("CATEGORY LOCALIZED ATTRIBUTES IMPORT WAS A SUCCESS!");
	}

	private function openFile()
	{
		return $this->fileOpener->openFile($this->getAbsoluteImportFilePath());
	}

	private function persist(array $categoryData): void
	{
		foreach($categoryData as $data)
		{
			if($data->name === 'schokoladen')
			{
				continue;
			}

			$categoryLocalizedAttributesEnity = $this->categoryLocalizedAttributesEntityBuilder->buildEntity($data);
			$categoryLocalizedAttributesEnity->save();
		}
	}

	private function parse($categoryFile): string
	{
		return $this->fileParserSelector
			->selectParser($this->getAbsoluteImportFilePath())
			->parse($categoryFile);
	}
}