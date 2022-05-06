<?php

namespace Tests;

use PDO;
use PHPUnit\Framework\TestCase;
use src\Importer\Business\Importers\PaymentMethod\PaymentMethodAttributeImporter;
use src\Importer\ImporterFactory;
use src\Shared\System\Application;

class AttributeImporterTest extends TestCase
{
	private const TEST_DATA = [
		[
			'attributes' => [
				'fee' => 3,
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

	private PDO $connection;
	private PaymentMethodAttributeImporter $attributeImporter;

	public function setUp(): void
	{
		$this->connection = Application::getInstance()->getConnection();
		$this->attributeImporter = (new ImporterFactory())->createPaymentMethodAttributeImporter();
	}

	public function tearDown(): void
	{
		$this->deleteTestData();
	}

	public function testImporterPersistNewData(): void
	{
		$dataFromDatabaseBeforeTest = $this->getPaymentMethodFromDatabase();
		self::assertNotEquals(self::TEST_DATA[0]['localized_attributes']['name']['de'], $dataFromDatabaseBeforeTest);

		$this->attributeImporter->import(self::TEST_DATA);

		$dataFromDatabaseAfterTest = "'" . $this->getPaymentMethodFromDatabase() . "'";
		self::assertEquals(self::TEST_DATA[0]['localized_attributes']['name']['de'], $dataFromDatabaseAfterTest);
	}

	private function getPaymentMethodFromDatabase(): string
	{
		$query = $this->connection->prepare("SELECT name FROM payment_method_localized_attribute WHERE name = 'test'");
		$query->execute();

		return $query->fetch(PDO::FETCH_COLUMN);
	}

	private function deleteTestData(): void
	{
		$idPaymentMethod = $this->getIdFromTestDataInDatabase();

		$query = $this->connection->prepare(
			'DELETE FROM payment_method_localized_attribute WHERE fk_payment_method = :fk_payment_method'
		);
		$query->execute([':fk_payment_method' => $idPaymentMethod]);

		$query = $this->connection->prepare(
			'DELETE FROM payment_method WHERE id_payment_method = :id_payment_method'
		);
		$query->execute([':id_payment_method' => $idPaymentMethod]);
	}

	private function getIdFromTestDataInDatabase(): int
	{
		$query = $this->connection->prepare("SELECT fk_payment_method FROM payment_method_localized_attribute WHERE name = 'test'");
		$query->execute();

		return $query->fetch(PDO::FETCH_COLUMN);
	}
}