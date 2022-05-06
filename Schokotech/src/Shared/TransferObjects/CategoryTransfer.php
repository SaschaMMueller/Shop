<?php

namespace src\Shared\TransferObjects;

use ArrayObject;

class CategoryTransfer
{
    private string $name;
    private string $seoUrl;
	private bool $isActive;
	private ArrayObject $subCategories;

    public function getName(): string
    {
        return $this->name;
    }

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getSubCategories(): ArrayObject
    {
        return $this->subCategories;
    }

	public function setSubCategories(ArrayObject $subCategories): self
	{
		$this->subCategories = $subCategories;

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

	public function getIsActive(): bool
	{
		return $this->isActive;
	}

	public function setIsActive(bool $isActive): self
	{
		$this->isActive = $isActive;

		return $this;
	}
}