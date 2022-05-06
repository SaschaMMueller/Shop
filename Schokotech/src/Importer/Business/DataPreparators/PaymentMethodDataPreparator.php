<?php

namespace src\Importer\Business\DataPreparators;

use stdClass;

class PaymentMethodDataPreparator
{
	public function preparePaymentMethodJsonData(string $jsonData): array
	{
		$paymentMethods = [];
		$paymentMethodDataCollection = json_decode($jsonData);

		foreach($paymentMethodDataCollection as $paymentMethodData)
		{
			$paymentMethods[] = [
				'attributes' => $this->preparePaymentMethodAttributesData($paymentMethodData),
				'localized_attributes' => $this->preparePaymentMethodLocalizedAttributesData($paymentMethodData),
			];
		}

		return $paymentMethods;
	}

	private function preparePaymentMethodAttributesData(stdClass $paymentMethodData): array
	{
		return [
			'fee' => $paymentMethodData->fee,
		];
	}

	private function preparePaymentMethodLocalizedAttributesData(stdClass $paymentMethodData): array
	{
		return [
			'name' => [
				'de' => "'" . $paymentMethodData->name_de . "'",
				'en' => "'" . $paymentMethodData->name_en . "'",
			],
			'description' => [
				'de' => "'" . $paymentMethodData->text_de . "'",
				'en' => "'" . $paymentMethodData->text_en . "'",
			],
		];
	}
}