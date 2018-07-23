<?php

namespace TimoReymann\EnhancedDiagnostics\Test;


use TimoReymann\EnhancedDiagnostics\Entity\DeviceInfoEntry;
use TimoReymann\EnhancedDiagnostics\Entity\EncryptedReport;
use TimoReymann\EnhancedDiagnostics\Entity\LogEntry;

class EncryptedReportTest extends \PHPUnit_Framework_TestCase
{
    protected $privateKey;
    protected $encryptedReport;

    protected function setUp()
    {
        parent::setUp();
        $this->privateKey = file_get_contents("resources/private.key");
        $this->encryptedReport = file_get_contents("resources/report.json");
    }

    public function testDecryptionFromParsedArray()
    {
        $encrypted = new EncryptedReport(json_decode($this->encryptedReport));
        $decrypted = $encrypted->parseReport($this->privateKey);

        $this->assertTrue($decrypted->getDeviceInfo() > 0, "Device info is parsed properly");
        $this->assertTrue($decrypted->getLog() > 0,"Log is parsed properly");

        $this->assertTrue($decrypted->getLog()[0] instanceof LogEntry, "Log entries are objects");
        $this->assertTrue($decrypted->getDeviceInfo()[0] instanceof DeviceInfoEntry, "Device info entries are objects");
    }

    public function testDecryptionFromInput() {
        $encrypted = EncryptedReport::parseFromInput($this->encryptedReport);
        $decrypted = $encrypted->parseReport($this->privateKey);

        $this->assertTrue($decrypted->getDeviceInfo() > 0, "Device info is parsed properly");
        $this->assertTrue($decrypted->getLog() > 0,"Log is parsed properly");

        $this->assertTrue($decrypted->getLog()[0] instanceof LogEntry, "Log entries are objects");
        $this->assertTrue($decrypted->getDeviceInfo()[0] instanceof DeviceInfoEntry, "Device info entries are objects");
    }
}