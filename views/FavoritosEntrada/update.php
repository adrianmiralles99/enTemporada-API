<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Favoritosentrada */

$this->title = 'Update Favoritosentrada: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Favoritosentradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="favoritosentrada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
