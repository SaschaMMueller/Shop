<?php

namespace src\Importer\Business\Importers;

use src\Importer\Business\DataPreparators\UrlToCategoryDataPreparator;
use src\Importer\Business\FileParserSelector;
use src\Importer\Persistence\EntityBuilders\UrlToCategoryEntityBuilder;
use src\Importer\Persistence\ImporterReader;
use src\Shared\Entities\UrlToCategoryEntity;

class UrlToCategoryImporter extends BaseImporter
{
	protected const IMPORT_FILE = '/ImporterFiles/categories.csv';

	private UrlToCategoryEntityBuilder $urlToCategoryEntityBuilder;
	private FileParserSelector $fileParserSelector;
	private UrlToCategoryDataPreparator $urlToCategoryDataPreparator;
	private ImporterReader $importerReader;

	public function __construct(
		UrlToCategoryEntityBuilder $urlToCategoryEntityBuilder,
		FileParserSelector $fileParserSelector,
		UrlToCategoryDataPreparator $urlToCategoryDataPreparator,
		ImporterReader $importerReader
	) {
		$this->urlToCategoryEntityBuilder = $urlToCategoryEntityBuilder;
		$this->fileParserSelector = $fileParserSelector;
		$this->urlToCategoryDataPreparator = $urlToCategoryDataPreparator;
		$this->importerReader = $importerReader;
	}

	public function shouldImport(): bool
	{
		$rowCount = $this->importerReader->getRowCount(UrlToCategoryEntity::TABLE_NAME);

		return $rowCount === 0;
	}

	public function import(): void
	{
		$languageKey = $this->importerReader->getLanguageKey('de');
		$localizedUrlsData = $this->importerReader->getUrlData($languageKey);
		$urlEnities = $this->urlToCategoryDataPreparator->prepareData($localizedUrlsData);
		$this->persist($urlEnities);
		var_dump("URL TO CATEGORY IMPORT WAS A SUCCESS!");
	}

	private function persist(array $categoryData): void
	{
		foreach($categoryData as $data)
		{
			$categoryLocalizedAttributesEntity = $this->urlToCategoryEntityBuilder->buildEntity($data);
			$categoryLocalizedAttributesEntity->save();
		}
	}

	private function parse($categoryFile): string
	{
		return $this->fileParserSelector
			->selectParser($this->getAbsoluteImportFilePath())
			->parse($categoryFile);
	}
}