<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LikesEntrada */

$this->title = 'Update Likes Entrada: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Likes Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="likes-entrada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
