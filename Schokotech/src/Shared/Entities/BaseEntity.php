<?php

namespace src\Shared\Entities;

use ReflectionClass;
use ReflectionProperty;
use src\Shared\System\Application;

class BaseEntity
{
	public function save(): bool
	{
		$connection = Application::getInstance()->getConnection();
		$tableName = $this->getTableName();
		$propertyNames = $this->getPropertiesNames();
		$columnNames = $this->parsePropertyNamesToColumnNames($propertyNames);

		if($this->getParameterValue(static::COLUMN_ID_NAME))
		{
			$updateQueryString  = $this->getUpdateQueryString($tableName, $columnNames);
			$query = $connection->prepare($updateQueryString);
		}
		else
		{
			$insertQueryString  = $this->getInsertQueryString($tableName, $columnNames);
			$valueQueryString = $this->getValueQueryString($columnNames);
			$query = $connection->prepare($insertQueryString . $valueQueryString);
		}

		return $query->execute();
	}

	public function getUpdateQueryString(string $tableName, array $columnNames): string
	{
		$updatedString  = 'UPDATE ' . $tableName . ' SET ';
		$tableIdName = '';
		foreach($columnNames as $columnName)
		{
			if(substr($columnName, 0, 2) === 'id')
			{
				$tableIdName = $columnName;
				continue;
			}

			$value = $this->getParameterValue($columnName);

			if(is_bool($value))
			{
				$value = $value ? 'true' : 'false';
			}

			$updatedString = $updatedString . $columnName . ' = ' . $value . ', ';
		}

		$value = $this->getParameterValue($tableIdName);
		$updatedString = substr($updatedString, 0, -2);
		$updatedString = $updatedString . ' WHERE ' . $tableIdName . ' = ' . $value;

		return $updatedString;
	}

	private function getInsertQueryString(string $tableName, array $columnNames): string
	{
		$insertString  = "INSERT INTO $tableName(";
		$insertString = $insertString . implode(", ",$columnNames);
		$insertString = $insertString . ')';

		return $insertString;
	}

	private function getValueQueryString(array $columnNames): string
	{
		$valueString = " VALUES(";

		foreach($columnNames as $columnName)
		{
			if(substr($columnName, 0, 2) === 'id')
			{
				$valueString = $valueString . 'null';
			}

			$value = $this->getParameterValue($columnName);

			if($columnName === 'parent')
			{
				$value =  $value === 0 ? 'null' : $value;
			}

			if(is_bool($value))
			{
				$value = $value ? 'true' : 'false';
			}

			$valueString = $valueString . $value . ', ';
		}

		$valueString = substr($valueString, 0, -2);
		$valueString = $valueString . ')';

		return $valueString;
	}

	private function getTableName(): string
	{
		$tablename = get_class($this);
		$tablename = str_replace("Entity", '', $tablename);
		$tablename = preg_replace('/(?<!\ )[A-Z]/', '_$0', $tablename);
		$tablename = str_replace("src\_Shared\_Entities\_", '', $tablename);
		$tablename = strtolower($tablename);

		return $tablename;
	}

	private function getParameterValue(string $parameterName)
	{
		$getParamMethod = 'get' . str_replace("_", '', ucwords($parameterName, '_'));

		return $this->$getParamMethod();
	}

	private function getPropertiesNames(): array
	{
		$reflection = new ReflectionClass($this);
		$methodNames = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);
		$propertyNames = [];

		foreach($methodNames as $methodName)
		{
			array_push($propertyNames, $methodName->getName());
		}

		return $propertyNames;
	}

	private function parsePropertyNamesToColumnNames(array $propertyNames): array
	{
		$columnNames = [];
		foreach($propertyNames as $propertyName)
		{
			$columnNames[] = strtolower(preg_replace('/(?<!\ )[A-Z]/', '_$0', $propertyName));
		}

		return $columnNames;
	}
}