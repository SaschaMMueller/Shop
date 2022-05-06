<?php

namespace src\Shared\TransferObjects;

class CmsPageTransfer
{
	private string $name;
	private string $street;
	private string $house_number;
	private string $postal_code;
	private string $city;
	private string $telephone_number;
	private string $email;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getStreet(): string
	{
		return $this->street;
	}

	public function setStreet(string $street): self
	{
		$this->street = $street;

		return $this;
	}

	public function getHouseNumber(): string
	{
		return $this->house_number;
	}

	public function setHouseNumber(string $house_number): self
	{
		$this->house_number = $house_number;

		return $this;
	}

	public function getPostalCode(): string
	{
		return $this->postal_code;
	}

	public function setPostalCode(string $postal_code): self
	{
		$this->postal_code = $postal_code;

		return $this;
	}

	public function getCity(): string
	{
		return $this->city;
	}

	public function setCity(string $city): self
	{
		$this->city = $city;

		return $this;
	}

	public function getTelephoneNumber(): string
	{
		return $this->telephone_number;
	}

	public function setTelephoneNumber(string $telephone_number): self
	{
		$this->telephone_number = $telephone_number;

		return $this;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}
}