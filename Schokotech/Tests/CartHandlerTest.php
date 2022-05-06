<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Cart\Business\CartHandler;
use src\Cart\CartFactory;
use src\Service\Session\Business\SessionManager;
use src\Service\Session\SessionFactory;

class CartHandlerTest extends TestCase
{
	private const SKU_TEST_PRODUCT_1 = 'VM-HS-100';
	private const SKU_TEST_PRODUCT_2 = 'VM-HS-200';

	private CartHandler $cartHandler;
	private SessionManager $sessionManager;

	protected function setUp(): void
	{
		$_SESSION = null;
		$this->cartHandler = (new CartFactory())->createCartHandler();
		$this->sessionManager = (new SessionFactory())->createSessionManager();
	}

	public function testAddNewCartItemToCartIncreasesAmountOfCartItemsInCart(): void
	{
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_1);
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_1);
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_2);

		$amountOfTotalItemsInCartAfterAddToCart = $this->sessionManager->findOrCreateCartTransferInSession()->getTotalItemCount();

		self::assertEquals(3, $amountOfTotalItemsInCartAfterAddToCart);
	}

	public function testAddSameCartItemIncreasesAmountOfExistingItemAndDoesNotAddAnAdditionalItemInCart(): void
	{
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_1);
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_1);
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_2);

		$amountOfDistinctCartItemsInCartAfterAddToCart = $this->sessionManager->findOrCreateCartTransferInSession()->getCartItemTransfers()->count();

		self::assertEquals(2, $amountOfDistinctCartItemsInCartAfterAddToCart);
	}

	public function testAddNewCartItemToCartIncreasesTotalPriceInCart(): void
	{
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_1);
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_1);
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_2);

		$totalPriceInCartAfterAddToCart = $this->sessionManager->findOrCreateCartTransferInSession()->getTotalPrice();

		self::assertEquals(6.97, $totalPriceInCartAfterAddToCart);
	}

	public function testRemoveOneItemFromCartRegardlessOfAmount(): void
	{
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_1);
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_1);
		$this->cartHandler->addToCart(self::SKU_TEST_PRODUCT_2);
		$this->cartHandler->removeItemFromCart(self::SKU_TEST_PRODUCT_1);

		$amountOfTotalItemsInCartAfterRemoval = $this->sessionManager->findOrCreateCartTransferInSession()->getCartItemTransfers()->count();

		self::assertEquals(1, $amountOfTotalItemsInCartAfterRemoval);
	}
}