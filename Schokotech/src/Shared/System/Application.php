<?php

namespace src\Shared\System;

use Config;
use PDO;
use src\DatabaseConnector;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Application
{
	private static Application $application;
	private Environment $twig;
	private PDO $connection;

	public static function getInstance(): self
	{
		if(empty(self::$application))
		{
			self::$application = new self();
		}

		return self::$application;
	}

	public function getTwig(): Environment
	{
		if(!isset($this->twig))
		{
			$this->twig = new Environment(new FilesystemLoader(Config::TWIG_PATH));
		}

		return $this->twig;
	}

	public function getConnection(): PDO
	{
		if(!isset($this->connection))
		{
			$this->connection = (new DatabaseConnector())->createConnectionToServer();
		}

		return $this->connection;
	}
}