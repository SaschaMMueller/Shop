<?php

namespace src\Url;

use src\DatabaseConnector;
use src\Url\Business\Model\ControllerActionUrlMapper;
use src\Url\Business\Model\UrlParser;
use src\Url\Business\Model\UrlResolver;
use src\Url\Persistence\UrlQueryContainer;
use src\Url\Persistence\UrlReader;

class UrlFactory
{
	public function createUrlResolver(): UrlResolver
	{
		return new UrlResolver(
			$this->createUrlParser(),
			$this->createUrlReader()
		);
	}

	public function createUrlReader(): UrlReader
	{
		return new UrlReader(
			$this->createUrlQueryContainer(),
			$this->createControllerProviderMapper()
		);
	}

	private function createUrlParser(): UrlParser
	{
		return new UrlParser();
	}

	private function createControllerProviderMapper(): ControllerActionUrlMapper
	{
		return new ControllerActionUrlMapper($this->getDependencyProvider());
	}

	private function getDependencyProvider(): UrlDependencyProvider
	{
		return new UrlDependencyProvider();
	}

	private function createUrlQueryContainer(): UrlQueryContainer
	{
		return new UrlQueryContainer($this->createDatabaseConnector());
	}

	private function createDatabaseConnector(): DatabaseConnector
	{
		return new DatabaseConnector();
	}
}