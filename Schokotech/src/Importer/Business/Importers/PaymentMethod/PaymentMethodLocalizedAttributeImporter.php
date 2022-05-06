<?php

namespace src\Importer\Business\Importers\PaymentMethod;

use src\Importer\Persistence\EntityBuilders\PaymentMethodLocalizedAttributeEntityBuilder;

class PaymentMethodLocalizedAttributeImporter
{
	private PaymentMethodLocalizedAttributeEntityBuilder $paymentMethodLocalizedAttributeEntityBuilder;

	public function __construct(
		PaymentMethodLocalizedAttributeEntityBuilder $paymentMethodLocalizedAttributeEntityBuilder
	) {
		$this->paymentMethodLocalizedAttributeEntityBuilder = $paymentMethodLocalizedAttributeEntityBuilder;
	}

	public function import(array $paymentMethodData, int $fkPaymentMethod, array $languages): void
	{
		foreach($languages as $language)
		{
			$entity = $this->paymentMethodLocalizedAttributeEntityBuilder->buildEntity($paymentMethodData, $fkPaymentMethod, $language);
			$entity->save();
		}
	}

}