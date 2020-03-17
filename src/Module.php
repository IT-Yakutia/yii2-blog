<?php


namespace ityakutia\blog;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'ityakutia\blog\controllers';
    public $defaultRoute = 'blog/index';
}