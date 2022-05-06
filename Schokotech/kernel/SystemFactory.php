<?php

namespace kernel;

use src\Application\ApplicationFacadeInterface;
use src\Url\UrlFacadeInterface;

class SystemFactory
{
	public function getApplicationFacade(): ApplicationFacadeInterface
	{
		return $this->getDependencyProvider()->createApplicationFacade();
	}

	public function getUrlFacade(): UrlFacadeInterface
	{
		return $this->getDependencyProvider()->createUrlFacade();
	}

	private function getDependencyProvider(): SystemDependencyProvider
	{
		return new SystemDependencyProvider();
	}
}