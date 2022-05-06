<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Importer\Business\DataPreparators\ProductDataPreparator;

class ProductDataPreparatorTest extends TestCase
{
	private const INPUT_TEST_DATA_FILE_PATH = 'Tests/TestFiles/ProductImporterJsonInputTestData.json';
	private const OUTPUT_TEST_DATA = [
		[
			'abstract' => [
				'attributes' => [
					'sku' => "'test_sku'",
					'imagePath' => "'test_image_path'",
					'fkCategory' => 0,
					],
				'localized_attributes' => [
					'name' => [
						'de' => "'test_name_de'",
						'en' => "'test_name_en'",
					],
					'description' => [
						'de' => "'test_blub_de'",
						'en' => "'test_blub_en'",
					],
					'attributes' => [
						'de' => "'[\"Inhaltsstoffe:\",\"test_attributes_de\"]'",
						'en' => "'[\"ingredients:\",\"test_attributes_en\"]'",
					],
				],
			],
			'purchasable' => [
				'0' => [
						'sku' => "'test_sku_buy'",
						'size' => 100,
						'price' => 10,
						'stock' => 10,
				],
			],
		]
	];

	private ProductDataPreparator $productDataPreparator;

	public function setUp(): void
	{
		$this->productDataPreparator = new ProductDataPreparator();
	}

	public function testPrepareProductJsonDataReturnsInputDataInCorrectStructure(): void
	{
		$productDataRaw = $this->getProductTestInputData();

		self::assertNotEquals(self::OUTPUT_TEST_DATA, $productDataRaw);

		$preparedData = $this->productDataPreparator->prepareProductJsonData($productDataRaw);

		self::assertEquals(self::OUTPUT_TEST_DATA, $preparedData);
	}

	private function getProductTestInputData(): array
	{
		$productDataFile = fopen(self::INPUT_TEST_DATA_FILE_PATH, 'r');
		$productDataRaw = fread($productDataFile, filesize(self::INPUT_TEST_DATA_FILE_PATH));
		fclose($productDataFile);

		return json_decode($productDataRaw, true);
	}
}