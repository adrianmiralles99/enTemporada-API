<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Likesentrada */

$this->title = 'Create Likesentrada';
$this->params['breadcrumbs'][] = ['label' => 'Likesentradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="likesentrada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
