<?php

namespace Tests;

use ArrayObject;
use PHPUnit\Framework\TestCase;
use src\Shared\Entities\UrlEntity;
use src\Url\Persistence\UrlEntityBuilder;

class UrlEntityBuilderTest extends TestCase
{
	private const ID_URL_ONE = 1;
	private const ID_URL_TWO = 2;
	private const TEST_URL_ONE = 'url_test_1';
	private const TEST_URL_TWO = 'url_test_2';
	private UrlEntityBuilder $urlEntityBuilder;

	protected function setUp(): void
	{
		$this->urlEntityBuilder = new UrlEntityBuilder();
	}

	public function testBuildUrlEntitiesCreatesEntitiesWithFilledProperties(): void
	{
		$urlObjects = $this->createTestUrlData();
		$expectedResult = new ArrayObject($this->createUrlEntities());
		$result = new ArrayObject();

		foreach($urlObjects as $urlObject)
		{
			$result->append($this->urlEntityBuilder->buildUrlEntity($urlObject));
		}

		$this->assertEquals($expectedResult, $result);
	}

	private function createTestUrlData(): array
	{
		return [
			(object)['id_url' => self::ID_URL_ONE, 'url_seo' => self::TEST_URL_ONE, 'url_system' => self::TEST_URL_ONE],
			(object)['id_url' => self::ID_URL_TWO, 'url_seo' => self::TEST_URL_TWO, 'url_system' => self::TEST_URL_TWO],
		];
	}

	private function createUrlEntities(): array
	{
		return [
			(new UrlEntity())
				->setIdUrl(self::ID_URL_ONE)
				->setUrlSeo(self::TEST_URL_ONE)
				->setUrlSystem(self::TEST_URL_ONE),
			(new UrlEntity())
				->setIdUrl(self::ID_URL_TWO)
				->setUrlSeo(self::TEST_URL_TWO)
				->setUrlSystem(self::TEST_URL_TWO)
		];
	}
}