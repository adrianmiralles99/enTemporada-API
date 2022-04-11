<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LikesSubcomentario */

$this->title = 'Create Likes Subcomentario';
$this->params['breadcrumbs'][] = ['label' => 'Likes Subcomentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="likes-subcomentario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
