<?php

namespace src\Checkout\Presentation;

use kernel\Presentation\BaseController;
use src\Checkout\CheckoutFactory;
use src\Shared\TransferObjects\RequestTransfer;

class CheckoutController extends BaseController
{
	public function customerStepAction(RequestTransfer $request): void
	{
		$this->getFactory()->createCustomerStep()->renderCustomerStep($request);
	}

	public function customerStepSaveAction(RequestTransfer $request): void
	{
		$this->getFactory()->createCustomerStep()->customerStepSave($request);
	}

	public function addressStepAction(RequestTransfer $request): void
	{
		$this->getFactory()->createAddressStep()->renderAddressStep($request);
	}

	public function addressStepSaveAction(RequestTransfer $request): void
	{
		$this->getFactory()->createAddressStep()->addressStepSave($request);
	}

	private function getFactory(): CheckoutFactory
	{
		return new CheckoutFactory;
	}
}