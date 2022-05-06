<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Importer\Business\DataPreparators\PaymentMethodDataPreparator;

class PaymentMethodDataPreparatorTest extends TestCase
{
	private const DATA_BEFORE_TEST = [
		[
			'name_de' => "test",
			'name_en' => "test",
			'text_de' => "test",
			'text_en' => "test",
			'fee' => 2,
		],
	];

	private const DATA_AFTER_TEST = [
		[
			'attributes' => [
				'fee' => 2,
			],
			'localized_attributes' => [
				'name' => [
					'de' => "'test'",
					'en' => "'test'",
				],
				'description' => [
					'de' => "'test'",
					'en' => "'test'",
				],
			]
		],
	];

	private PaymentMethodDataPreparator $paymentMethodDataPreparator;

	public function setUp(): void
	{
		$this->paymentMethodDataPreparator = new PaymentMethodDataPreparator();
	}

	public function testPrepareJsonDataToCorrectStructure(): void
	{
		self::assertNotEquals(self::DATA_AFTER_TEST, self::DATA_BEFORE_TEST);

		$dataAfterTest = $this->paymentMethodDataPreparator->preparePaymentMethodJsonData(json_encode(self::DATA_BEFORE_TEST));

		self::assertEquals(self::DATA_AFTER_TEST, $dataAfterTest);
	}
}