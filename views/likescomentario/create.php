<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Likescomentario */

$this->title = 'Create Likescomentario';
$this->params['breadcrumbs'][] = ['label' => 'Likescomentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="likescomentario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
