<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\DatabaseConnector;
use src\Url\Business\Model\ControllerActionUrlMapper;
use src\Url\Business\Model\UrlParser;
use src\Url\Business\Model\UrlResolver;
use src\Url\Persistence\UrlEntityBuilder;
use src\Url\Persistence\UrlQueryContainer;
use src\Url\Persistence\UrlReader;

class UrlResolverTest extends TestCase
{
	const NON_EXISTING_SEO_URL = 'non-existing-seo-url';

	public function testResolveUrlThrowsANoUrlFoundExceptionOnNonExistingRequestedSeoUrl(): void
	{
		$urlMapperMock = $this->createUrlMapperMock(self::NON_EXISTING_SEO_URL);
		$urlResolver = $this->createUrlResolver($urlMapperMock);

		$this->expectException('src\Url\Exception\NoUrlFoundException');
		$urlResolver->resolveUrlForApplicationStart();
	}

	private function createUrlResolver(ControllerActionUrlMapper $urlMapper): UrlResolver
	{
		return new UrlResolver(
			$urlMapper,
			new UrlParser(),
			new UrlReader(
				new UrlQueryContainer(new DatabaseConnector()),
				new UrlEntityBuilder()
			)
		);
	}

	private function createUrlMapperMock(string $seoUrl): ControllerActionUrlMapper
	{
		$urlMapperMock = $this->createMock(ControllerActionUrlMapper::class);

		$urlMapperMock
			->method('getSeoUrl')
			->willReturn($seoUrl);

		return $urlMapperMock;
	}
}