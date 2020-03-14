<?php

use uraankhayayaal\page\models\PageMenu;
use yii\helpers\Html;

?>

<?php if(count($model->pageMenuItems) > 0) { ?>
    <?php
    $page_menu_id = $model->pageMenuItems[0]->page_menu_id;
    $page_menu = PageMenu::findOne($page_menu_id);
    ?>
    <ul class="languages d-flex flex-wrap justify-content-center list-unstyled">
        <?php foreach ($page_menu->pageMenuItems as $key => $menuItem) { ?>
            <?php if(isset($menuItem->page_id) && $menuItem->page->is_publish == true && $menuItem->is_publish == true) { ?>
                <li><?= Html::a('<span>'.$menuItem->name.'</span>', ['/page/front/view', 'slug' => $menuItem->page->slug], ['class' => "m-2"]); ?></li>
            <?php }elseif(empty($menuItem->page) && !empty($menuItem->url) && $menuItem->is_publish == true){ ?>
                <li><?= Html::a('<span>'.$menuItem->name.'</span>', $menuItem->url, ['class' => "m-2", 'target' => '_blank']); ?></li>
            <?php } ?>
        <?php } ?>
    </ul>
<?php } ?>
