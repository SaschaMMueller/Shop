<?php

namespace src\Application;

use src\Application\Twig\Functions\CartItemTotalsFunction;
use src\Application\Twig\Functions\DisplayMessageFunction;
use src\Application\Twig\TwigExtensionProvider;
use src\Application\Twig\TwigExtension;
use src\Service\Notification\NotificationServiceInterface;
use src\Service\Session\SessionServiceInterface;
use src\Shared\System\Application;
use Twig\Environment;

class ApplicationFactory
{
	public function createTwigExtensionProvider(): TwigExtensionProvider
	{
		return new TwigExtensionProvider($this->createTwigExtensions(), $this->getTwig());
	}

	public function getTwig(): Environment
	{
		return Application::getInstance()->getTwig();
	}

	private function createTwigExtensions(): TwigExtension
	{
		return new TwigExtension($this->createCartItemTotalsFunction(),
								$this->createDisplayMessageFunction());
	}

	private function createCartItemTotalsFunction(): CartItemTotalsFunction
	{
		return new CartItemTotalsFunction($this->getSessionService());
	}

	private function createDisplayMessageFunction(): DisplayMessageFunction
	{
		return new DisplayMessageFunction($this->getNotificationService());
	}

	private function getSessionService(): SessionServiceInterface
	{
		return $this->getDependencyProvider()->createSessionService();
	}

	private function getNotificationService(): NotificationServiceInterface
	{
		return $this->getDependencyProvider()->createNotificationService();
	}

	private function getDependencyProvider(): ApplicationDependencyProvider
	{
		return new ApplicationDependencyProvider();
	}
}