<?php
/**
 * @link https://github.com/yiibr/yii2-br-validator
 * @license https://github.com/yiibr/yii2-br-validator/blob/master/LICENSE
 */
namespace yiibr\brvalidator;

use yii\helpers\Json;
use Yii;

/**
 * CnpjValidator checks if the attribute value is a valid CNPJ.
 *
 * @author Leandro Gehlen <leandrogehlen@gmail.com>
 */
class CnpjValidator extends DocumentValidator
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', "{attribute} is invalid.");
        }
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        $valid = true;
        $cnpj = preg_replace('/[^0-9_]/', '', $value);

        for ($x=0; $x<10; $x++) {
            if ( $cnpj == str_repeat($x, 14) ) {
                $valid = false;
            }
        }
        if ($valid) {
            if (strlen($cnpj) != 14) {
                $valid = false;
            } else  {
                for ($t = 12; $t < 14; $t ++) {
                    $d = 0;
                    $c = 0;
                    for ($m = $t - 7; $m >= 2; $m --, $c ++) {
                        $d += $cnpj[$c] * $m;
                    }
                    for ($m = 9; $m >= 2; $m --, $c ++) {
                        $d += $cnpj[$c] * $m;
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cnpj[$c] != $d) {
                        $valid = false;
                        break;
                    }
                }
            }
        }
        return ($valid) ? [] : [$this->message, []];
    }

    public function clientValidateAttribute($object, $attribute, $view)
    {
        $options = [
            'message' => Yii::$app->getI18n()->format($this->message, [
                'attribute' => $object->getAttributeLabel($attribute),
            ], Yii::$app->language)
        ];

        if ($this->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        ValidationAsset::register($view);
        return 'yiibr.validation.cnpj(value, messages, ' . Json::encode($options) . ');';
    }
}
