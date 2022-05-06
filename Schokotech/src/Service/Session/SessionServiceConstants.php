<?php

namespace src\Service\Session;

interface SessionServiceConstants
{
	public const SESSION_KEY_CART = 'cart';
	public const SESSION_KEY_MESSAGES = 'messages';
	public const SESSION_KEY_CUSTOMER = 'customer';
	public const SESSION_KEY_REACHED_CHECKOUT_STEP = 'checkoutStep';
	public const SESSION_KEY_DEFAULT_REACHED_CHECKOUT_STEP = 1;
}