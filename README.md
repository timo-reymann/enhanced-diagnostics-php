enhanced-diagnostics-php
===

## What is this?
PHP library with batteries included for [enhanced-diagnostics](https://github.com/timo-reymann/enhanced-diagnostics) npm package

## Usage
### Installation
Install using composer: ``composer require timo-reymann/enhanced-diagnostics-php``

## Coding
Parse from json string
`````php
$encrypted = EncryptedReport::parseFromInput($jsonString);
`````

Parse from php array
````php 
$encrypted = new EncryptedReport($parsedArray);
````

Parse from php://input
````php 
$encrypted = EncryptedReport::parseFromPHPStdIn();
````

To get the values use the getter/setter

````php 
// Get device info
$infoList = $encrypted->getDeviceInfo();

// Get log lines
$logLines = $encrypted->getLog();

// Get message of first log line
$line = $encrypted->getLog()[0]->getMessage();

// and so on ...
````