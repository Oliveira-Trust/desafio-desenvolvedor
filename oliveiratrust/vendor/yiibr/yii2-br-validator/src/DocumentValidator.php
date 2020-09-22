<?php

/**
 * @link https://github.com/yiibr/yii2-br-validator
 * @license https://github.com/yiibr/yii2-br-validator/blob/master/LICENSE
 */

namespace yiibr\brvalidator;

use yii\validators\Validator;

class DocumentValidator extends Validator {

    /**
     * @var bool whether the attribute value can removed non digits characteres. Defaults to false.
     */
    public $digitsOnly = false;

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        if ($this->digitsOnly) {
            $model->$attribute = preg_replace('/\D+/', '', $model->$attribute);
        }
        parent::validateAttribute($model, $attribute);
    }

}
