<?php

namespace src\Importer\Business\Importers;

use ArrayObject;
use src\Importer\Business\DataPreparators\CategoryUrlDataPreparator;
use src\Importer\Business\FileOpener;
use src\Importer\Business\FileParserSelector;
use src\Importer\Persistence\EntityBuilders\UrlEntityBuilder;
use src\Importer\Persistence\ImporterReader;
use src\Shared\Entities\UrlToCategoryEntity;

class CategoryUrlImporter extends BaseImporter
{
	protected const IMPORT_FILE = '/ImporterFiles/categories.csv';

	private FileOpener $fileOpener;
	private UrlEntityBuilder $urlEntityBuilder;
	private FileParserSelector $fileParserSelector;
	private CategoryUrlDataPreparator $urlDataPreparator;
	private ImporterReader $importerReader;

	public function __construct(
		FileOpener $fileOpener,
		UrlEntityBuilder $urlEntityBuilder,
		FileParserSelector $fileParserSelector,
		CategoryUrlDataPreparator $urlDataPreparator,
		ImporterReader $importerReader
	) {
		$this->fileOpener = $fileOpener;
		$this->urlEntityBuilder = $urlEntityBuilder;
		$this->fileParserSelector = $fileParserSelector;
		$this->urlDataPreparator = $urlDataPreparator;
		$this->importerReader = $importerReader;
	}

	public function shouldImport(): bool
	{
		$rowCount = $this->importerReader->getRowCount(UrlToCategoryEntity::TABLE_NAME);

		return $rowCount === 0;
	}

	public function import(): void
	{
		$categoryFile = $this->openFile();
		$urlData = $this->parse($categoryFile);
		$LanguageKeys = $this->getLanguageKeys();
		$urlEntities = [];
		foreach($LanguageKeys as $languageKey)
		{
			$localizedCategories = $this->importerReader->getLocalizedCategories($languageKey);
			$urlEntities = $this->urlDataPreparator->prepareData($urlData, $languageKey, $localizedCategories);
			$this->persist($urlEntities);
		}

		fclose($categoryFile);
		var_dump("URL IMPORT WAS A SUCCESS!");
	}

	private function openFile()
	{
		return $this->fileOpener->openFile($this->getAbsoluteImportFilePath());
	}

	private function persist(array $categoryData): void
	{
		foreach($categoryData as $data)
		{
			$categoryLocalizedAttributesEnity = $this->urlEntityBuilder->buildEntity($data);
			$categoryLocalizedAttributesEnity->save();
		}
	}

	private function parse($categoryFile): string
	{
		return $this->fileParserSelector
			->selectParser($this->getAbsoluteImportFilePath())
			->parse($categoryFile);
	}

	private function getLanguageKeys()
	{
		$languageKeys = new ArrayObject();
		$languages = $this->importerReader->getLanguages();

		foreach($languages as $language)
		{
			$key = $language->id_language;
			$languageKeys->append($key);
		}

		return $languageKeys;
	}
}
