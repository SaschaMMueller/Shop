<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Shared\TransferObjects\RequestTransfer;

class RequestTransferTest extends TestCase
{
	private const TEST_REQUEST_URI = '/Shop/Schokotech/category';
	private const TEST_REQUEST_HTTP_REFER = 'http://localhost/Shop/Schokotech/';
	private const TEST_REQUEST_SEOURL = 'category';

	public function testInitRequestObject(): void
	{
		$_SERVER['REQUEST_URI'] = self::TEST_REQUEST_URI;
		$_SERVER['HTTP_REFERER'] = self::TEST_REQUEST_HTTP_REFER;
		$request = (new RequestTransfer())->init();

		$this->assertEquals(self::TEST_REQUEST_SEOURL, $request->getSeoUrl());
		$this->assertEquals(self::TEST_REQUEST_HTTP_REFER, $request->getLastUsedUrl());
	}
}