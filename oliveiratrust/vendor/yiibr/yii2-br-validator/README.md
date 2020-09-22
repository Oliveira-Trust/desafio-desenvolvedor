Yii2 Brazilian Validators
=========================

Yii2 Extension that provide validators and features for brazilian localization

* CPF: Cadastro de pessoa física (like a Security Social Numeber in USA)
* CNPJ: Cadastro nacional de pessoa jurídica
* CEI: Cadastro específico no INSS (número de matrícula)

[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)
[![Latest Stable Version](https://poser.pugx.org/yiibr/yii2-br-validator/v/stable.png)](https://packagist.org/packages/yiibr/yii2-br-validator)
[![Build Status](https://travis-ci.org/yiibr/yii2-br-validator.svg?branch=master)](https://travis-ci.org/yiibr/yii2-br-validator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiibr/yii2-br-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiibr/yii2-br-validator/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/yiibr/yii2-br-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yiibr/yii2-br-validator/?branch=master)
[![Total Downloads](https://poser.pugx.org/yiibr/yii2-br-validator/downloads.png)](https://packagist.org/packages/yiibr/yii2-br-validator)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiibr/yii2-br-validator "*"
```

or add

```
"yiibr/yii2-br-validator": "*"
```

to the require section of your `composer.json` file.

Usage
-----
Add the rules as the following example


```php

use Yii;
use yii\base\Model;
use yiibr\brvalidator\CpfValidator;
use yiibr\brvalidator\CnpjValidator;
use yiibr\brvalidator\CeiValidator;

class PersonForm extends Model
{
	public $name;
	public $cpf;
	public $cnpj;
	public $cei;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// name is required
			['name', 'required'],
			// cpf validator
			['cpf', CpfValidator::className()],
			// cnpj validator
			['cnpj', CnpjValidator::className()],
			// cei validator
			['cei', CeiValidator::className()]
		];
	}
}
```
