<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LikesEntrada */

$this->title = 'Create Likes Entrada';
$this->params['breadcrumbs'][] = ['label' => 'Likes Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="likes-entrada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
