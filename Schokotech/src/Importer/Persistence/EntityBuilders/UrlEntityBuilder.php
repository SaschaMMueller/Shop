<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\UrlEntity;
use stdClass;

class UrlEntityBuilder
{
	public function buildEntity(stdClass $entityData): UrlEntity
	{
		return (new UrlEntity())
			->setIdUrl(null)
			->setUrlSeo($entityData->url_seo)
			->setUrlSystem($entityData->url_system)
			->setFkLanguage($entityData->fk_language);
	}
}