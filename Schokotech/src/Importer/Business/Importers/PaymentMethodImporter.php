<?php

namespace src\Importer\Business\Importers;

use src\Importer\Business\DataPreparators\PaymentMethodDataPreparator;
use src\Importer\Business\FileOpener;
use src\Importer\Business\FileParserSelector;
use src\Importer\Business\Importers\PaymentMethod\PaymentMethodAttributeImporter;
use src\Importer\Business\Importers\PaymentMethod\PaymentMethodLocalizedAttributeImporter;
use src\Importer\Persistence\ImporterReader;
use src\Shared\Entities\PaymentMethodEntity;

class PaymentMethodImporter extends BaseImporter
{
	protected const IMPORT_FILE = '/ImporterFiles/payment_methods.xls';

	private FileOpener $fileOpener;
	private FileParserSelector $fileParserSelector;
	private PaymentMethodDataPreparator $paymentMethodDataPreparator;
	private PaymentMethodAttributeImporter $attributeImporter;
	private PaymentMethodLocalizedAttributeImporter $localizedAttributeImporter;
	private ImporterReader $importerReader;

	public function __construct(
		FileOpener $fileOpener,
		FileParserSelector $fileParserSelector,
		PaymentMethodDataPreparator $paymentMethodDataPreparator,
		PaymentMethodAttributeImporter $attributeImporter,
		PaymentMethodLocalizedAttributeImporter $localizedAttributeImporter,
		ImporterReader $importerReader
	) {
		$this->fileOpener = $fileOpener;
		$this->fileParserSelector = $fileParserSelector;
		$this->paymentMethodDataPreparator = $paymentMethodDataPreparator;
		$this->attributeImporter = $attributeImporter;
		$this->localizedAttributeImporter = $localizedAttributeImporter;
		$this->importerReader = $importerReader;
	}

	public function shouldImport(): bool
	{
		$rowCount = $this->importerReader->getRowCount(PaymentMethodEntity::TABLE_NAME);

		return $rowCount === 0;
	}

	public function import(): void
	{
		$paymentMethodRawFile = $this->openFile();
		$paymentMethodJsonData = $this->parse($paymentMethodRawFile);
		$preparedData = $this->paymentMethodDataPreparator->preparePaymentMethodJsonData($paymentMethodJsonData);
		$this->persist($preparedData);
		var_dump("PAYMENT METHOD IMPORT WAS A SUCCESS!");
	}

	private function openFile()
	{
		return $this->fileOpener->openFile($this->getAbsoluteImportFilePath());
	}

	private function parse($paymentMethodRawFile): string
	{
		return $this->fileParserSelector
			->selectParser($this->getAbsoluteImportFilePath())
			->parse($paymentMethodRawFile);
	}

	private function persist(array $paymentMethodDataCollection): void
	{
		$languages = $this->importerReader->getLanguages();

		foreach($paymentMethodDataCollection as $paymentMethodData)
		{
			$idPaymentMethod = $this->attributeImporter->import($paymentMethodData['attributes']);
			$this->localizedAttributeImporter->import($paymentMethodData['localized_attributes'], $idPaymentMethod, $languages);
		}
	}
}