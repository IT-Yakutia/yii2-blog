<?php

use yii\helpers\Url;

?>

<div class="card">
	<a href="<?= Url::to(['view', 'id' => $model->id]); ?>" class="card-ref d-block">
		<div class="overflow">
			<img class="card-img-top" src="<?= $model->photo; ?>" alt="<?= $model->title ?>">
		</div>
		<div class="card-body d-flex fdc justify-content-between pb-2">
			<p class="card-title mb-3"><?= $model->title ?></p>
			<p class="card-text mb-4"><?= Yii::$app->formatter->asDate($model->created_at); ?></p>
		</div>
	</a>

	<?= ''/*\frontend\widgets\social\Share::widget(['id' => $model->id, 'url' => Url::toRoute(['/blog/front/view', 'id' => $model->id], true), 'text' => $model->title])*/?>
</div>

