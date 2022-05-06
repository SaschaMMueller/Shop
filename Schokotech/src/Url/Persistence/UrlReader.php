<?php

namespace src\Url\Persistence;

use PDO;
use src\Shared\TransferObjects\UrlTransfer;
use src\Url\Business\Model\ControllerActionUrlMapper;
use src\Url\Exception\NoUrlFoundException;

class UrlReader
{
	private UrlQueryContainer $urlQueryContainer;
	private ControllerActionUrlMapper $controllerActionUrlMapper;

	public function __construct(UrlQueryContainer $urlQueryContainer, ControllerActionUrlMapper $controllerActionUrlMapper)
	{
		$this->urlQueryContainer = $urlQueryContainer;
		$this->controllerActionUrlMapper = $controllerActionUrlMapper;
	}

	public function getSystemUrlBySeoUrl(string $seoUrl): UrlTransfer
	{
		$url = $this->controllerActionUrlMapper->findActionUrlBySeoUrl($seoUrl);

		if(empty($url))
		{
			$url = $this->findSystemUrlBySeoUrl($seoUrl);
		}

		if(empty($url))
		{
			throw new NoUrlFoundException(
				sprintf("No system url found for requested seo url '%s'", $seoUrl)
			);
		}

		return (new UrlTransfer())
			->setSystemUrl($url);
	}

	public function findUrlByIdProductAbstract(int $idProductAbstract): ?UrlTransfer
	{
		$query = $this->urlQueryContainer->getUrlForProductQuery($idProductAbstract);
		$query->execute();
		$url = $query->fetch(PDO::FETCH_OBJ);

		if(empty($url))
		{
			return null;
		}

		return (new UrlTransfer())
			->setSeoUrl($url->url_seo)
			->setSystemUrl($url->url_system);
	}

	public function findUrlByIdCategory(int $idCategory): ?UrlTransfer
	{
		$query = $this->urlQueryContainer->getUrlForCategoryQuery($idCategory);
		$query->execute();
		$url = $query->fetch(PDO::FETCH_OBJ);

		if(empty($url))
		{
			return null;
		}

		return (new UrlTransfer())
			->setSeoUrl($url->url_seo)
			->setSystemUrl($url->url_system);
	}

	public function getLanguages(): array
	{
		$query = $this->urlQueryContainer->getLanguagesQuery();
		$query->execute();
		$languages = $query->fetchAll(PDO::FETCH_COLUMN);

		return $languages;
	}

	private function findSystemUrlBySeoUrl(string $seoUrl): ?string
	{
		$query = $this->urlQueryContainer->findSystemUrlBySeoUrlQuery($seoUrl);
		$query->execute();
		$url = $query->fetch(PDO::FETCH_OBJ);
		$url = $url->url_system;

		return $url;
	}
}