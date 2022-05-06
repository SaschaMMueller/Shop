<?php

namespace src\Importer\Business\DataPreparators;

use src\Importer\Persistence\ImporterReader;
use stdClass;

class CategoryLocalizedAttributesDataPreparator
{
	private ImporterReader $importerReader;

	public function __construct(ImporterReader $importerReader)
	{
		$this->importerReader = $importerReader;
	}

	public function prepareData(string $categoryLocalizedAttributesRawJson, array $languages): array
	{
		$entityCollection = [];
		$categoriesLocalizedAttributes = json_decode($categoryLocalizedAttributesRawJson);

		foreach($languages as $language)
		{
			$localizedName = 'name_' . $language->name;
			$localizedDescription = 'description_' . $language->name;

			foreach($categoriesLocalizedAttributes as $categoryLocalizedAttributes)
			{
				$preparedEntityData = new stdClass();
				$preparedEntityData->name = "'" . $categoryLocalizedAttributes->$localizedName . "'";
				$preparedEntityData->fk_category = $this->importerReader->getCategoryIdByCategoryKey($categoryLocalizedAttributes->category_key);
				$preparedEntityData->description = "'" . $categoryLocalizedAttributes->$localizedDescription . "'";
				$preparedEntityData->fk_language = $language->id_language;
				$entityCollection[] = $preparedEntityData;
			}
		}

		return $entityCollection;
	}
}