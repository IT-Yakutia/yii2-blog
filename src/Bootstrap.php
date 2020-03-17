<?php


namespace ityakutia\blog;


use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $app->setModule('blog', 'ityakutia\blog\Module');
//        $app->getUrlManager()->addRules([
//           [
//               'class' => '\ityakutia\blog\PageUrlRule'
//           ]
//        ], false);
    }
}