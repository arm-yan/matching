# Matching System

[![Latest Stable Version](https://poser.pugx.org/arm-yan/matching/v)](//packagist.org/packages/arm-yan/matching)
[![License](https://poser.pugx.org/arm-yan/matching/license)](//packagist.org/packages/arm-yan/matching)
[![Total Downloads](https://poser.pugx.org/arm-yan/matching/downloads)](//packagist.org/packages/arm-yan/matching)

## Structure
```
src/
```


## Install

Via Composer

``` bash
$ composer require arm-yan/matching
```

## Usage

``` php
$service = new Matching();
$parser = new Parser();
$csvArray = $parser->convertCsvToArray($request->file('csv')->path());
$data = $parser->parseCsvArray($csvArray);

$set = $service->getHighestAverageSet($data);

//Adding requirement, $requirement Requirement interfeace implementation
$service->addRequirement($requirement);
```
## Security

If you discover any security related issues, please email arm.karapetyan@outlook.com instead of using the issue tracker.

## Credits

- Arman Karapetyan
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/:vendor/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/:vendor/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/:vendor/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/:vendor/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/:vendor/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/:vendor/:package_name
[link-travis]: https://travis-ci.org/:vendor/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/:vendor/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/:vendor/:package_name
[link-downloads]: https://packagist.org/packages/:vendor/:package_name
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors