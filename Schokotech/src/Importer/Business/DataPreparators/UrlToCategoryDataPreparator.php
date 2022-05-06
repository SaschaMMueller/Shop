<?php

namespace src\Importer\Business\DataPreparators;

use stdClass;

class UrlToCategoryDataPreparator
{
	public function prepareData(array $localizedUrlsData): array
	{
		$entityCollection = [];

		foreach($localizedUrlsData as $urlData)
		{
			if(substr($urlData->url_system, 0, 8) !== 'Category')
			{
				continue;
			}

			$preparedEntityData = new stdClass();
			$preparedEntityData->fk_category = $urlData->url_system === 'Category/list' ? 1 : substr($urlData->url_system,  -1);
			$preparedEntityData->fk_url = $urlData->id_url;
			$entityCollection[] = $preparedEntityData;
		}

		return $entityCollection;
	}
}