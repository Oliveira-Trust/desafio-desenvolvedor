<?php
/**
 * @link https://github.com/yiibr/yii2-br-validator
 * @license https://github.com/yiibr/yii2-br-validator/blob/master/LICENSE
 */
namespace yiibr\brvalidator;

use Yii;
use yii\helpers\Json;

/**
 * CpfValidator checks if the attribute value is a valid CPF.
 *
 * @author Leandro Gehlen <leandrogehlen@gmail.com>
 * @author Wanderson Bragança <wanderson.wbc@gmail.com>
 */
class CpfValidator extends DocumentValidator
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
        $cpf = preg_replace('/[^0-9]/', '', $value);

        for($x = 0; $x < 10; $x ++) {
            if ($cpf == str_repeat ( $x, 11 )) {
                $valid = false;
            }
        }
        if ($valid) {
            if (strlen ( $cpf ) != 11) {
                $valid = false;
            } else {
                for ($t = 9; $t < 11; $t ++) {
                    $d = 0;
                    for($c = 0; $c < $t; $c ++) {
                        $d += $cpf[$c] * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cpf[$c] != $d) {
                        $valid = false;
                        break;
                    }
                }
            }
        }
        return ($valid) ? [] : [$this->message, []];
    }

    /**
     * @inheritdoc
     */
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
        return 'yiibr.validation.cpf(value, messages, ' . Json::encode($options) . ');';
    }
}
