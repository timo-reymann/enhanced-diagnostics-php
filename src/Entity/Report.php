<?php

namespace TimoReymann\EnhancedDiagnostics\Entity;

/**
 * Representation for decrypted report
 * @package TimoReymann\EnhancedDiagnostics
 */
class Report
{
    /**
     * @var DeviceInfoEntry[]
     */
    private $deviceInfo;

    /**
     * @var LogEntry[]
     */
    private $log;

    /**
     * Create decrypted report representation
     * @param DeviceInfoEntry[] $deviceInfo Device info
     * @param LogEntry[] $log Log entries
     */
    public function __construct($deviceInfo = [], $log = [])
    {
        $this->deviceInfo = $deviceInfo;
        $this->log = $log;
    }

    /**
     * @return DeviceInfoEntry[]
     */
    public function getDeviceInfo()
    {
        return $this->deviceInfo;
    }

    /**
     * @param DeviceInfoEntry[] $deviceInfo
     */
    public function setDeviceInfo($deviceInfo)
    {
        $this->deviceInfo = $deviceInfo;
    }

    /**
     * @return LogEntry[]
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param LogEntry[] $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }


}