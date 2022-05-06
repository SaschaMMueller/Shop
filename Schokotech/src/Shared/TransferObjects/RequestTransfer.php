<?php

namespace src\Shared\TransferObjects;

use src\Url\UrlConfig;

class RequestTransfer
{
	private array $postVariables;
	private array $getVariables;
	private string $uri;
	private string $seoUrl;
	private ?string $lastUsedUrl;
	private string $languagePrefix;

	public function init():	self
	{
		$this->postVariables = $_POST;
		$this->getVariables = $_GET;
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->seoUrl = substr(substr($_SERVER['REQUEST_URI'], strlen(UrlConfig::URL_BASE)), 3);
		$this->languagePrefix = substr(substr($_SERVER['REQUEST_URI'], strlen(UrlConfig::URL_BASE)),0, 2);
		$this->lastUsedUrl = empty($_SERVER['HTTP_REFERER']) ? null : $_SERVER['HTTP_REFERER'];

		return $this;
	}

	public function getPostVariables(): array
	{
		return $this->postVariables;
	}

	public function getSeoUrl(): string
	{
		return $this->seoUrl;
	}

	public function getLastUsedUrl(): string
	{
		return $this->lastUsedUrl;
	}

	public function getLanguagePrefix(): string
	{
		return $this->languagePrefix;
	}
}