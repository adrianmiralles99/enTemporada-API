<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Favoritosentrada */

$this->title = 'Create Favoritosentrada';
$this->params['breadcrumbs'][] = ['label' => 'Favoritosentradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favoritosentrada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
