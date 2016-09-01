<?php

/**
 * @link https://github.com/humanized/yii2-access-token
 * @copyright Copyright (c) 2016 Humanized BV Comm V
 * @license https://github.com/humanized/yii2-access-token/LICENSE
 */

namespace humanized\user;

/**
 * Yii2 Advanced Application Template User Module
 * 
 * Yii2 module wrapping the user management related functionality provided by the yii2-advanced-template
 * 
 * 
 * @name Yii2 Advanced Application Template User Module
 * @version 0.1
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-advanced-application-template-user
 * 
 */
class Module extends \yii\base\Module
{

    public function init()
    {
        if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'humanized\user\commands';
        }
        parent::init();
    }

}
