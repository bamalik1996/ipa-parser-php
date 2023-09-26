# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bamalik1996/ipa-parser-php.svg?style=flat-square)](https://packagist.org/packages/bamalik1996/ipa-parser-php)
[![Total Downloads](https://img.shields.io/packagist/dt/bamalik1996/ipa-parser-php.svg?style=flat-square)](https://packagist.org/packages/bamalik1996/ipa-parser-php)
![GitHub Actions](https://github.com/bamalik1996/ipa-parser-php/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Description

The PHP IPA ISO Parser is a robust tool tailored for extracting and interpreting data from IPA (iOS App Store Package) builds. Seamlessly dive into the core details of any IPA file, retrieve essential metadata, and streamline your iOS app analysis and deployment processes with this efficient package.


## Installation

You can install the package via composer:

```bash
composer require bamalik1996/ipa-parser-php
```

## Usage

```php
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

```



### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.



## Credits

-   [Bilal Ahmed Malik](https://github.com/bamalik1996)

