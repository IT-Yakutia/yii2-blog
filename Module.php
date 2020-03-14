<?php


namespace common\modules\blog;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'blog\controllers';
    public $defaultRoute = 'blog/index';
}