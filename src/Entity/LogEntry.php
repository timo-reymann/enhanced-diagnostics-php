<?php


namespace TimoReymann\EnhancedDiagnostics\Entity;

/**
 * Representation of log entry
 * @package TimoReymann\EnhancedDiagnostics
 */
class LogEntry
{
    /**
     * Log level
     * @var null|string
     */
    private $level;

    /**
     * Message
     * @var null|string
     */
    private $message;

    /**
     * Raw JSON payload
     * @var null|string
     */
    private $payload;

    /**
     * Timestamp of log entry
     * @var null|\DateTime
     */
    private $timestamp;

    /**
     * Log type (e. g. network, console)
     * @var null|string
     */
    private $type;

    /**
     * Construct log entry
     * @param null|string $level Log level
     * @param null|string $message Message
     * @param null|string $payload Raw JSON payload
     * @param null|string $timestamp Timestamp of log entry
     * @param null|string $type Type
     */
    public function __construct($level = null, $message = null, $payload = null, $timestamp = null, $type = null)
    {
        $this->level = $level;
        $this->message = $message;
        $this->payload = $payload;
        $this->timestamp = $timestamp;
        $this->type = $type;
    }

    /**
     * @return null|string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param null|string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return null|string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param null|string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return \DateTime|null
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime|null $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}