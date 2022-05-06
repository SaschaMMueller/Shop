<?php

namespace src\Shared\Entities;

class UrlEntity extends BaseEntity
{
	public const TABLE_NAME = 'url';
	public const COLUMN_ID_NAME = 'id_url';

	private ?int $idUrl;
	private string $urlSeo;
	private string $urlSystem;
	private ?int $fk_language;

	public function getFkLanguage(): ?int
	{
		return $this->fk_language;
	}

	public function setFkLanguage(?int $fk_language): self
	{
		$this->fk_language = $fk_language;

		return $this;
	}

	public function getIdUrl(): ?int
	{
		return $this->idUrl;
	}

	public function setIdUrl(?int $idUrl): self
	{
		$this->idUrl = $idUrl;

		return $this;
	}

	public function getUrlSeo(): string
	{
		return $this->urlSeo;
	}

	public function setUrlSeo(string $urlSeo): self
	{
		$this->urlSeo = $urlSeo;

		return $this;
	}

	public function getUrlSystem(): string
	{
		return $this->urlSystem;
	}

	public function setUrlSystem(string $urlSystem): self
	{
		$this->urlSystem = $urlSystem;

		return $this;
	}
}