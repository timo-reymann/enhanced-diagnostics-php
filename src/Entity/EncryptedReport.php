<?php

namespace TimoReymann\EnhancedDiagnostics\Entity;

use TimoReymann\EnhancedDiagnostics\Exception\DecryptException;

/**
 * Representation of encrypted report
 * @package TimoReymann\EnhancedDiagnostics
 */
class EncryptedReport
{
    /**
     * @var string[] Encrypted chunks
     */
    private $chunks;

    /**
     * Create encrypted report representation
     * @param string[] $chunks
     */
    public function __construct(array $chunks)
    {
        $this->chunks = $chunks;
    }

    /**
     * @param $input string
     * @return EncryptedReport
     */
    public static function parseFromInput($input)
    {
        return new EncryptedReport(json_decode($input));
    }

    /**
     * @return EncryptedReport
     */
    public static function parseFromPHPStdIn() {
        return self::parseFromInput(file_get_contents("php://input"));
    }

    /**
     * @param $privateKey string Private key to decrypt data
     * @return string JSON report
     * @throws DecryptException Error while decrypting
     */
    public function decryptReport($privateKey)
    {
        $decryptedChunks = [];

        // Decrypt chunks
        for ($i = 0; $i < count($this->chunks); $i++) {
            $decryptedChunks[$i] = $this->decryptChunk($this->chunks[$i], $privateKey);
        }

        // Combine decrypted chunks
        return implode("", $decryptedChunks);
    }

    /**
     * Parse report to object
     *
     * @param $privateKey
     * @return Report
     * @throws DecryptException
     */
    public function parseReport($privateKey)
    {
        $raw = $this->decryptReport($privateKey);

        $parsed = json_decode($raw, true);
        if ($parsed === null) {
            throw new DecryptException("Report is damaged, aborting processing");
        }

        return new Report(
            $this->parseDeviceInfo($parsed),
            $this->parseLog($parsed)
        );
    }

    /**
     * @param $parsed array[string] Parsed report
     * @return DeviceInfoEntry[]
     */
    private function parseDeviceInfo($parsed)
    {
        $parsedInfos = [];
        $infos = $parsed['deviceInfo'];

        for ($i = 0; $i < count($infos); $i++) {
            $info = $infos[$i];
            $parsedInfos[$i] = new DeviceInfoEntry(
                $info['key'],
                $info['value']
            );
        }

        return $parsedInfos;
    }

    /**
     * @param $parsed array[string] Parsed report
     * @return LogEntry[]
     */
    private function parseLog($parsed)
    {
        $parsedLog = [];
        $lines = $parsed['log'];

        for ($i = 0; $i < count($lines); $i++) {
            $line = $lines[$i];

            $parsedLog[$i] = new LogEntry(
                $line['level'],
                $line['message'],
                $line['payload'],
                \DateTime::createFromFormat(\DateTime::ISO8601, $line['timestamp']),
                $line['type']
            );
        }

        return $parsedLog;
    }

    /**
     * Decrypt chunk
     * @param $chunk string Chunk to decrypt
     * @param $decodedPrivateKey string decoded private key
     * @return string Decrypted chunks
     * @throws DecryptException
     */
    private function decryptChunk($chunk, $decodedPrivateKey)
    {
        $decryptedChunk = "";

        if (openssl_private_decrypt(base64_decode($chunk), $decryptedChunk, $decodedPrivateKey) === FALSE) {
            throw new DecryptException("Decrypt of a chunk failed, aborting decryption");
        }

        return $decryptedChunk;
    }
}