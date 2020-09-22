<?php
/**
 * @link https://github.com/yiibr/yii2-br-validator
 * @license https://github.com/yiibr/yii2-br-validator/blob/master/LICENSE
 */

namespace yiibr\brvalidator;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the javascript files for client validation.
 *
 * @author Wanderson Bragança <wanderson.wbc@gmail.com>
 */
class ValidationAsset extends AssetBundle
{
    public $sourcePath = '@yiibr/brvalidator/assets';
    public $js = [
        'yiibr.validation.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
