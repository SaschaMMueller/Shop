<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\ProductLocalizedAttributesEntity;
use stdClass;

class ProductLocalizedAttributesEntityBuilder
{
	public function buildEntity(
		array $productAbstract,
		int $fkProductAbstract,
		stdClass $language): ProductLocalizedAttributesEntity
	{
		return (new ProductLocalizedAttributesEntity())
			->setIdProductLocalizedAttributes(null)
			->setFkProductAbstract($fkProductAbstract)
			->setFkLanguage($language->id_language)
			->setName($productAbstract['localized_attributes']['name'][$language->name])
			->setDescription($productAbstract['localized_attributes']['description'][$language->name])
			->setAttributes($productAbstract['localized_attributes']['attributes'][$language->name]);
	}
}