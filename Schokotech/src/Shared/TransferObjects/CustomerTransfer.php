<?php

namespace src\Shared\TransferObjects;

class CustomerTransfer
{
	private string $customerName;
	private string $customerSurname;
	private string $email;
	private string $billingName;
	private string $billingSurname;
	private string $billingSalutation;
	private string $billingStreetAddress;
	private string $billingStreetNumber;
	private string $billingPostalCode;
	private string $billingCompany;
	private string $shippingName;
	private string $shippingSurname;
	private string $shippingSalutation;
	private string $shippingStreetAddress;
	private string $shippingStreetNumber;
	private string $shippingPostalCode;
	private string $shippingCompany;
	private string $chkBox;

	public function getCustomerName(): string
	{
		return $this->customerName;
	}

	public function setCustomerName(string $customerName): self
	{
		$this->customerName = $customerName;

		return $this;
	}

	public function getCustomerSurname(): string
	{
		return $this->customerSurname;
	}

	public function setCustomerSurname(string $customerSurname): self
	{
		$this->customerSurname = $customerSurname;

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

	public function getBillingName(): string
	{
		return $this->billingName;
	}

	public function setBillingName(string $billingName): self
	{
		$this->billingName = $billingName;

		return $this;
	}

	public function getBillingSurname(): string
	{
		return $this->billingSurname;
	}

	public function setBillingSurname(string $billingSurname): self
	{
		$this->billingSurname = $billingSurname;

		return $this;
	}

	public function getBillingSalutation(): string
	{
		return $this->billingSalutation;
	}

	public function setBillingSalutation(string $billingSalutation): self
	{
		$this->billingSalutation = $billingSalutation;

		return $this;
	}

	public function getBillingStreetAddress(): string
	{
		return $this->billingStreetAddress;
	}

	public function setBillingStreetAddress(string $billingStreetAddress): self
	{
		$this->billingStreetAddress = $billingStreetAddress;

		return $this;
	}

	public function getBillingStreetNumber(): string
	{
		return $this->billingStreetNumber;
	}

	public function setBillingStreetNumber(string $billingStreetNumber): self
	{
		$this->billingStreetNumber = $billingStreetNumber;

		return $this;
	}

	public function getBillingPostalCode(): string
	{
		return $this->billingPostalCode;
	}

	public function setBillingPostalCode(string $billingPostalCode): self
	{
		$this->billingPostalCode = $billingPostalCode;

		return $this;
	}

	public function getBillingCompany(): string
	{
		return $this->billingCompany;
	}

	public function setBillingCompany(string $billingCompany): self
	{
		$this->billingCompany = $billingCompany;

		return $this;
	}

	public function getShippingName(): string
	{
		return $this->shippingName;
	}

	public function setShippingName(string $shippingName): self
	{
		$this->shippingName = $shippingName;

		return $this;
	}

	public function getShippingSurname(): string
	{
		return $this->shippingSurname;
	}

	public function setShippingSurname(string $shippingSurname): self
	{
		$this->shippingSurname = $shippingSurname;

		return $this;
	}

	public function getShippingSalutation(): string
	{
		return $this->shippingSalutation;
	}

	public function setShippingSalutation(string $shippingSalutation): self
	{
		$this->shippingSalutation = $shippingSalutation;

		return $this;
	}

	public function getShippingStreetAddress(): string
	{
		return $this->shippingStreetAddress;
	}

	public function setShippingStreetAddress(string $shippingStreetAddress): self
	{
		$this->shippingStreetAddress = $shippingStreetAddress;

		return $this;
	}

	public function getShippingStreetNumber(): string
	{
		return $this->shippingStreetNumber;
	}

	public function setShippingStreetNumber(string $shippingStreetNumber): self
	{
		$this->shippingStreetNumber = $shippingStreetNumber;

		return $this;
	}

	public function getShippingPostalCode(): string
	{
		return $this->shippingPostalCode;
	}

	public function setShippingPostalCode(string $shippingPostalCode): self
	{
		$this->shippingPostalCode = $shippingPostalCode;

		return $this;
	}

	public function getShippingCompany(): string
	{
		return $this->shippingCompany;
	}

	public function setShippingCompany(string $shippingCompany): self
	{
		$this->shippingCompany = $shippingCompany;

		return $this;
	}

	public function getChkBox(): string
	{
		return $this->chkBox;
	}

	public function setChkBox(string $chkBox): self
	{
		$this->chkBox = $chkBox;

		return $this;
	}
}