<?php

namespace TimoReymann\EnhancedDiagnostics\Entity;

/**
 * Representation for device information
 * @package TimoReymann\EnhancedDiagnostics
 */
class DeviceInfoEntry
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string|null
     */
    private $value;

    /**
     * Create new device info entry
     * @param string $key Key
     * @param null|string $value Value
     */
    public function __construct($key, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return null|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}