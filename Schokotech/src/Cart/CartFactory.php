<?php

namespace src\Cart;

use src\Cart\Business\CartHandler;
use src\Service\Notification\NotificationServiceInterface;
use src\Cart\Business\Model\CartItemTransferBuilder;
use src\Cart\Persistence\CartQueryContainer;
use src\Cart\Persistence\CartReader;
use src\DatabaseConnector;
use src\Service\Session\SessionServiceInterface;
use src\Shared\System\Application;
use Twig\Environment;

class CartFactory
{
	public function createCartHandler(): CartHandler
	{
		return new CartHandler($this->getSessionService(),
							   $this->createCartReader(),
							   $this->getNotificationService());
	}

	public function getSessionService(): SessionServiceInterface
	{
		return $this->getDependencyProvider()->createSessionService();
	}

	public function getTwig(): Environment
	{
		return Application::getInstance()->getTwig();
	}

	private function createCartReader(): CartReader
	{
		return new CartReader($this->createCartQueryContainer(), $this->createCartItemTransfersBuilder());
	}

	private function createCartQueryContainer(): CartQueryContainer
	{
		return new CartQueryContainer($this->createDatabaseConnector());
	}

	private function createCartItemTransfersBuilder(): CartItemTransferBuilder
	{
		return new CartItemTransferBuilder();
	}

	private function getNotificationService(): NotificationServiceInterface
	{
		return $this->getDependencyProvider()->createNotificationService();
	}

	private function getDependencyProvider(): CartDependencyProvider
	{
		return new CartDependencyProvider();
	}

	private function createDatabaseConnector(): DatabaseConnector
	{
		return new DatabaseConnector();
	}
}