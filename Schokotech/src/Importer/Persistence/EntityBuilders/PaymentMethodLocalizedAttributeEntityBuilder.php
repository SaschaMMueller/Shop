<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\PaymentMethodLocalizedAttributeEntity;
use stdClass;

class PaymentMethodLocalizedAttributeEntityBuilder
{
	public function buildEntity(
		array $paymentMethodLocalizedAttribute,
		int $fkPaymentMethod,
		stdClass $language
	): PaymentMethodLocalizedAttributeEntity
	{
		return (new PaymentMethodLocalizedAttributeEntity())
			->setIdPaymentMethodLocalizedAttribute(null)
			->setFkPaymentMethod($fkPaymentMethod)
			->setName($paymentMethodLocalizedAttribute['name'][$language->name])
			->setDescription($paymentMethodLocalizedAttribute['description'][$language->name])
			->setFkLanguage($language->id_language);
	}
}