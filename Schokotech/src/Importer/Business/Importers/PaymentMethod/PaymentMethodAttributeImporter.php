<?php

namespace src\Importer\Business\Importers\PaymentMethod;

use src\Importer\Persistence\EntityBuilders\PaymentMethodEntityBuilder;
use src\Importer\Persistence\ImporterReader;
use src\Shared\System\Application;

class PaymentMethodAttributeImporter
{
	private PaymentMethodEntityBuilder $paymentMethodEntityBuilder;
	private PaymentMethodLocalizedAttributeImporter $localizedAttributeImporter;
	private ImporterReader $importerReader;

	public function __construct(
		PaymentMethodEntityBuilder $paymentMethodEntityBuilder,
		PaymentMethodLocalizedAttributeImporter $localizedAttributeImporter,
		ImporterReader $importerReader
	) {
		$this->paymentMethodEntityBuilder = $paymentMethodEntityBuilder;
		$this->localizedAttributeImporter = $localizedAttributeImporter;
		$this->importerReader = $importerReader;
	}

	public function import(array $paymentMethodData): int
	{
		$entity = $this->paymentMethodEntityBuilder->buildEntity($paymentMethodData);
		$entity->save();

		return Application::getInstance()->getConnection()->lastInsertId();
	}
}