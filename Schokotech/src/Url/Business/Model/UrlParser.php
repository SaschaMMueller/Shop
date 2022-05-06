<?php

namespace src\Url\Business\Model;

use src\Shared\TransferObjects\UrlTransfer;
use src\Url\UrlConfig;

class UrlParser
{
	public function parseUrl(UrlTransfer $urlTransfer): UrlTransfer
	{
		$urlPartsArray = explode('/', $urlTransfer->getSystemUrl());

		$urlObject = ($urlTransfer)
			->setController($urlPartsArray[UrlConfig::URL_KEY_CONTROLLER])
			->setAction($urlPartsArray[UrlConfig::URL_KEY_ACTION]);

		if(count($urlPartsArray) == UrlConfig::THREE)
		{
			$urlObject->setParameter($urlPartsArray[UrlConfig::URL_KEY_PARAMETER]);
		}

		return $urlObject;
	}
}