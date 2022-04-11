<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FavoritosEntrada */

$this->title = 'Create Favoritos Entrada';
$this->params['breadcrumbs'][] = ['label' => 'Favoritos Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favoritos-entrada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
