<?php

namespace src\Shared\TransferObjects;

class BreadcrumbTransfer
{
	private string $name;
	private string $url;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function setUrl(string $url): self
	{
		$this->url = $url;

		return $this;
	}
}