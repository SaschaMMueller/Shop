<?php

namespace src\Importer\Persistence;

use PDO;

class ImporterReader
{
	private ImporterQueryContainer $importerQueryContainer;

	public function __construct(ImporterQueryContainer $importerQueryContainer)
	{
		$this->importerQueryContainer = $importerQueryContainer;
	}

	public function getRowCount(string $tableName): int
	{
		$query = $this->importerQueryContainer->getRowCountQuery($tableName);
		$query->execute();
		$rowCount = $query->fetch();

		return $rowCount[0];
	}

	public function getLanguages(): array
	{
		$query = $this->importerQueryContainer->getLanguagesQuery();
		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	public function getLanguageKey(string $languageAbbreviation): int
	{
		$query = $this->importerQueryContainer->getLanguageKeyQuery($languageAbbreviation);
		$query->execute();
		$languageKey = $query->fetch();

		return $languageKey[0];
	}

	public function getCategoryIdByCategoryKey(int $categoryKey): int
	{
		$query = $this->importerQueryContainer->getCategoryIdByCategoryKeyQuery($categoryKey);
		$query->execute();
		$categoryId = $query->fetch();

		return $categoryId[0];
	}

	public function getLocalizedCategories(int $fk_language): array
	{
		$query = $this->importerQueryContainer->getLocalizedCategoriesQuery($fk_language);
		$query->execute();

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getUrlData(int $fk_language): array
	{
		$query = $this->importerQueryContainer->getUrlDataQuery($fk_language);
		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}
}