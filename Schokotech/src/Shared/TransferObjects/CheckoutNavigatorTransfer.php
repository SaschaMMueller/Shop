<?php

namespace src\Shared\TransferObjects;

class CheckoutNavigatorTransfer
{
	private string $stepSeoUrl;
	private string $stepName;
	private int $stepNumber;

	public function getStepSeoUrl(): string
	{
		return $this->stepSeoUrl;
	}

	public function setStepSeoUrl(string $stepSeoUrl): self
	{
		$this->stepSeoUrl = $stepSeoUrl;

		return $this;
	}

	public function getStepName(): string
	{
		return $this->stepName;
	}

	public function setStepName(string $stepName): self
	{
		$this->stepName = $stepName;

		return $this;
	}

	public function getStepNumber(): int
	{
		return $this->stepNumber;
	}

	public function setStepNumber(int $stepNumber): self
	{
		$this->stepNumber = $stepNumber;

		return $this;
	}
}