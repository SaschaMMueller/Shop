<?php

namespace src\Checkout;

use src\Checkout\Business\CheckoutNavigatorTransferBuilder;
use src\Checkout\Business\Steps\AddressStep;
use src\Checkout\Business\CustomerHydrator;
use src\Checkout\Business\Steps\CustomerStep;
use src\Service\Session\SessionServiceInterface;
use src\Shared\System\Application;
use Twig\Environment;

class CheckoutFactory
{
	public function getTwig(): Environment
	{
		return Application::getInstance()->getTwig();
	}

	public function getSessionService(): SessionServiceInterface
	{
		return $this->getCheckoutDependencyProvider()->createSessionService();
	}

	public function createCustomerStep(): CustomerStep
	{
		return new CustomerStep(
			$this->getSessionService(),
			$this->getTwig(),
			$this->createCustomerHydrator(),
			$this->createCheckoutNavigatorTransferBuilder());
	}

	public function createCustomerHydrator(): CustomerHydrator
	{
		return new CustomerHydrator();
	}

	public function createCheckoutNavigatorTransferBuilder(): CheckoutNavigatorTransferBuilder
	{
		return new CheckoutNavigatorTransferBuilder();
	}

	public function createAddressStep(): AddressStep
	{
		return new AddressStep(
			$this->getSessionService(),
			$this->getTwig(),
			$this->createCustomerHydrator(),
			$this->createCheckoutNavigatorTransferBuilder());
	}

	private function getCheckoutDependencyProvider(): CheckoutDependencyProvider
	{
		return new CheckoutDependencyProvider();
	}
}