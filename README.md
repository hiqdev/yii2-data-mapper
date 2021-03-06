# Yii2 Data Mapper

**Data Mapper for Yii2**

[![Latest Stable Version](https://poser.pugx.org/hiqdev/yii2-data-mapper/v/stable)](https://packagist.org/packages/hiqdev/yii2-data-mapper)
[![Total Downloads](https://poser.pugx.org/hiqdev/yii2-data-mapper/downloads)](https://packagist.org/packages/hiqdev/yii2-data-mapper)
[![Build Status](https://img.shields.io/travis/hiqdev/yii2-data-mapper.svg)](https://travis-ci.org/hiqdev/yii2-data-mapper)
[![Scrutinizer Code Coverage](https://img.shields.io/scrutinizer/coverage/g/hiqdev/yii2-data-mapper.svg)](https://scrutinizer-ci.com/g/hiqdev/yii2-data-mapper/)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/hiqdev/yii2-data-mapper.svg)](https://scrutinizer-ci.com/g/hiqdev/yii2-data-mapper/)
[![Dependency Status](https://www.versioneye.com/php/hiqdev:yii2-data-mapper/dev-master/badge.svg)](https://www.versioneye.com/php/hiqdev:yii2-data-mapper/dev-master)

[Data Mapper] based on Yii2 data base abstraction.

Deliberately simple (no implicit behavior) library aimed to separate data persistence logics from data own logics.

## Idea

 Abstraction | Implementation              | Examples
-------------|-----------------------------|--------------------------------------
Domain Layer | Entity, RepositoryInterface | Customer, CustomerRepositoryInterface
Data Mapper  | Repository, Specification   | CustomerRepostory
Data Access  | Query, QueryBuilder         | PDO, ActiveRecord, HiArt
DATA         | Storage                     | DB, API, Queue, File System

[Data Mapper]: https://en.wikipedia.org/wiki/Data_mapper_pattern

## Installation

The preferred way to install this yii2-extension is through [composer](http://getcomposer.org/download/).

Either run

```sh
php composer.phar require "hiqdev/yii2-data-mapper"
```

or add

```json
"hiqdev/yii2-data-mapper": "*"
```

to the require section of your composer.json.

## License

This project is released under the terms of the BSD-3-Clause [license](LICENSE).
Read more [here](http://choosealicense.com/licenses/bsd-3-clause).

Copyright © 2017-2018, HiQDev (http://hiqdev.com/)
