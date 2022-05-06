<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Shared\TransferObjects\UrlTransfer;
use src\Url\Business\Model\UrlParser;

class UrlParserTest extends TestCase
{
	private UrlParser $urlParser;

	protected function setUp(): void
	{
		$this->urlParser = new UrlParser();
	}

	public function testParseUrlReturnsCorrectUrlTransfer(): void
	{
		$url = "Blub/Nonsense";
		$expectedResult = (new UrlTransfer)
			->setController("Blub")
			->setAction("Nonsense");
		$result = $this->urlParser->parseUrl($url);

		$this->assertEquals($expectedResult, $result);
	}
}