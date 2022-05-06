<?php

namespace src\Url\Business\Model;

use kernel\Presentation\BaseController;
use src\Shared\TransferObjects\RequestTransfer;
use src\Shared\TransferObjects\UrlTransfer;
use src\Url\Persistence\UrlReader;
use src\Url\UrlConfig;

class UrlResolver
{
	private const ACTION_NAME_WITH_REQUIRED_INPUT = [
		'showAction'
	];

	private UrlParser $urlParser;
	private UrlReader $urlReader;

	public function __construct(UrlParser $urlParser, UrlReader $urlReader)
	{
		$this->urlParser = $urlParser;
		$this->urlReader = $urlReader;
	}

	public function resolveUrlForApplicationStart(RequestTransfer $request): void
	{
		$urlTransfer = $this->urlParser->parseUrl(
			$this->urlReader->getSystemUrlBySeoUrl($this->checkForSelectedLanguage($request)));

		$controller = $this->buildRequestedController($urlTransfer->getController());
		$this->executeRequestedAction($controller, $urlTransfer, $request);
	}

	private function buildRequestedController(string $controllerName): BaseController
	{
		$controller = sprintf(
			'src\\%s\\Presentation\\%sController',
			$controllerName,
			$controllerName
		);

		return new $controller;
	}

	private function checkForSelectedLanguage(RequestTransfer $request): string
	{
		$languages = $this->urlReader->getLanguages();

		if(in_array($request->getLanguagePrefix(), $languages))
		{
			return $request->getSeoUrl();
		}

		return header('Location: ' . UrlConfig::URL_DEFAULT_HOME_PAGE);
	}

	private function executeRequestedAction(BaseController $controller, UrlTransfer $urlTransfer, RequestTransfer $request): void
	{
		$actionName = $urlTransfer->getAction();

		if(in_array($actionName, self::ACTION_NAME_WITH_REQUIRED_INPUT))
		{
			$controller->$actionName($urlTransfer->getParameter(), $request);

			return;
		}

		$controller->$actionName($request);
	}

}