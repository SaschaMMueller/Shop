<?php

namespace SetUp\DatabaseManagers;

class DatabaseCredentialsProvider
{
	public string $dbName;
	public string $dbHost;
	public string $dbUserName;
	public string $dbPassword;

	public function __construct()
	{
		$this->dbName = getenv('MYSQL_DATABASE', true);
		$this->dbHost = getenv('MYSQL_HOST', true);
		$this->dbUserName = getenv('MYSQL_USER', true);
		$this->dbPassword = getenv('MYSQL_PASSWORD', true);
	}
}
