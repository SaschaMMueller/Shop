<?php

namespace src\Checkout\Business;

use src\Shared\TransferObjects\CustomerTransfer;
use src\Shared\TransferObjects\RequestTransfer;

class CustomerHydrator
{
	public function hydrateWithCustomerStepData(CustomerTransfer $customerTransfer, RequestTransfer $requestTransfer): CustomerTransfer
	{
		$postVariables = $requestTransfer->getPostVariables();

		return ($customerTransfer)
			->setCustomerName($postVariables['customer-step-name'])
			->setCustomerSurname($postVariables['customer-step-surname'])
			->setEmail($postVariables['customer-step-email']);
	}

	public function hydrateWithAddressStepData(RequestTransfer $requestTransfer, CustomerTransfer $customerTransfer): CustomerTransfer
	{
		$postVariables = $requestTransfer->getPostVariables();

		if(!isset($postVariables['checkboxBillingAddressSameAsShippingAddress'])) {

			return ($customerTransfer)
				->setBillingName($postVariables['address-step-billingName'])
				->setBillingSurname($postVariables['address-step-billingSurname'])
				->setBillingSalutation($postVariables['address-step-billingSalutation'])
				->setBillingStreetAddress($postVariables['address-step-billingStreetAddress'])
				->setBillingStreetNumber($postVariables['address-step-billingStreetNumber'])
				->setBillingPostalCode($postVariables['address-step-billingPostalCode'])
				->setBillingCompany($postVariables['address-step-billingCompany'])
				->setShippingName($postVariables['address-step-shippingName'])
				->setShippingSurname($postVariables['address-step-shippingSurname'])
				->setShippingSalutation($postVariables['address-step-shippingSalutation'])
				->setShippingStreetAddress($postVariables['address-step-shippingStreetAddress'])
				->setShippingStreetNumber($postVariables['address-step-shippingStreetNumber'])
				->setShippingPostalCode($postVariables['address-step-shippingPostalCode'])
				->setShippingCompany($postVariables['address-step-shippingCompany']);
		}

		return ($customerTransfer)
			->setBillingName($postVariables['address-step-billingName'])
			->setBillingSurname($postVariables['address-step-billingSurname'])
			->setBillingSalutation($postVariables['address-step-billingSalutation'])
			->setBillingStreetAddress($postVariables['address-step-billingStreetAddress'])
			->setBillingStreetNumber($postVariables['address-step-billingStreetNumber'])
			->setBillingPostalCode($postVariables['address-step-billingPostalCode'])
			->setBillingCompany($postVariables['address-step-billingCompany'])
			->setShippingName($postVariables['address-step-billingName'])
			->setShippingSurname($postVariables['address-step-billingSurname'])
			->setShippingSalutation($postVariables['address-step-billingSalutation'])
			->setShippingStreetAddress($postVariables['address-step-billingStreetAddress'])
			->setShippingStreetNumber($postVariables['address-step-billingStreetNumber'])
			->setShippingPostalCode($postVariables['address-step-billingPostalCode'])
			->setShippingCompany($postVariables['address-step-billingCompany']);
	}
}