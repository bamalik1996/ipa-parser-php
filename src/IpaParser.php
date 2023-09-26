<?php

namespace Bamalik1996\IpaParserPhp;

class IPAParser {
    private $ipaFilePath;
    private $infoPlistPath;
    private $xmlPlistPath;

    public function __construct($ipaFilePath) {
        $this->ipaFilePath = $ipaFilePath;
    }

    public function extractInfoPlist() {
        $zip = new ZipArchive();

        if ($zip->open($this->ipaFilePath) === TRUE) {
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $entry = $zip->getNameIndex($i);
                if (preg_match('!Payload/[^/]+\.app/Info\.plist!', $entry)) {
                    $this->infoPlistPath = 'extracted_Info.plist';
                    $zip->extractTo('.', $this->infoPlistPath, $entry);
                    break;
                }
            }
            $zip->close();
        }

        return $this->infoPlistPath;
    }

    public function convertPlistToXml() {
        if (!$this->infoPlistPath) {
            return null;
        }

        $this->xmlPlistPath = 'converted_Info.xml';
        exec("plutil -convert xml1 -o {$this->xmlPlistPath} {$this->infoPlistPath}");
        return $this->xmlPlistPath;
    }

    public function getAppInfo() {
        if (!$this->xmlPlistPath) {
            return null;
        }

        $xml = simplexml_load_file($this->xmlPlistPath);
        $info = [];

        foreach ($xml->dict->key as $key) {
            $value = next($key->xpath('following-sibling::*[1]'));
            $info[(string)$key] = (string)$value;
        }

        return $info;
    }
}

$parser = new IPAParser('path_to_your_ipa_file.ipa');

if ($parser->extractInfoPlist()) {
    $parser->convertPlistToXml();
    $appInfo = $parser->getAppInfo();

    echo "App Name: " . $appInfo['CFBundleName'] . "\n";
    echo "Bundle Identifier: " . $appInfo['CFBundleIdentifier'] . "\n";
    echo "Version: " . $appInfo['CFBundleShortVersionString'] . "\n";
    // ... and so on for other keys you're interested in
} else {
    echo "Failed to extract Info.plist.";
}
