<?php

namespace src\Url\Business\Model;

use src\Url\UrlDependencyProvider;

class ControllerActionUrlMapper
{
	private UrlDependencyProvider $urlDependencyProvider;

	public function __construct(UrlDependencyProvider $urlDependencyProvider)
	{
		$this->urlDependencyProvider = $urlDependencyProvider;
	}

	public function findActionUrlBySeoUrl(string $seoUrl): ?string
	{
		$controllerProviders = $this->urlDependencyProvider->getControllerProviders();

		foreach($controllerProviders as $controllerProvider)
		{
			$actionToSeoUrlMappings = $controllerProvider->getActionToSeoUrlMappings();

			if(isset($actionToSeoUrlMappings[$seoUrl]))
			{
				return $actionToSeoUrlMappings[$seoUrl];
			}
		}

		return null;
	}
}