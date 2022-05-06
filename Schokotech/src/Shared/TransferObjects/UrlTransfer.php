<?php

namespace src\Shared\TransferObjects;

class UrlTransfer
{
	private string $controller;
	private string $action;
	private string $parameter;
	private string $seoUrl;
	private ?string $systemUrl;

	public function getController(): string
	{
		return $this->controller;
	}

	public function setController(string $controller): self
	{
		$this->controller = $controller;

		return $this;
	}

	public function getAction(): string
	{
		return $this->action;
	}

	public function setAction(string $action): self
	{
		$this->action = $action . "Action";

		return $this;
	}

	public function getParameter(): string
	{
		return $this->parameter;
	}

	public function setParameter(string $parameter): self
	{
		$this->parameter = $parameter;

		return $this;
	}

	public function getSeoUrl(): string
	{
		return $this->seoUrl;
	}

	public function setSeoUrl(string $seoUrl): self
	{
		$this->seoUrl = $seoUrl;

		return $this;
	}

	public function getSystemUrl(): ?string
	{
		return $this->systemUrl;
	}

	public function setSystemUrl(?string $systemUrl): self
	{
		$this->systemUrl = $systemUrl;

		return $this;
	}
}